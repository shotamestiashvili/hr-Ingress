<template>
    <div class="container">
        <div class="row">
            <div class="col" width="20px">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <br/>
                            <div>
                                <select
                                    class="form-select"
                                    v-model="row"
                                    aria-label=".form-select-sm example"
                                >
                                    <option selected>Select Row N</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="65">65</option>
                                </select>
                            </div>
                            <hr>
                            <b-button
                                v-b-modal.importModal
                                variant="warning"
                                ref="btnShow"
                                size="sm"
                            >Import Schedule
                            </b-button
                            >

                            <input
                                type="text"
                                placeholder="Filter the table"
                                v-model="search"
                            />

                            <select
                                class="form-select"
                                v-model="selectedYear"
                                aria-label=".form-select-sm example"
                            >
                                <option selected>Select Year</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>

                            <select
                                class="form-select"
                                v-model="selectedMonth"
                                aria-label=".form-select-sm example"
                            >
                                <option selected>Select Month</option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>

                            <table class="table table-sm fixed table-bordered">
                                <thead>
                                <tr>
                                    <th width="17%">UserName</th>
                                    <th
                                        width="4%"
                                        v-for="(days, index) in monthDays"
                                        :key="index"
                                    >
                                        <div
                                            v-if="days.includes('Sun') || days.includes('Sat')"
                                            v-bind:style="styles"
                                        >
                                            {{ days }}
                                        </div>
                                        <div v-else>
                                            {{ days }}
                                        </div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody v-for="(data, index) in apiData.data" :key="index">
                                <tr>
                                    <td>{{ data.first_name.concat(" ", data.last_name) }}</td>
                                    <td
                                        v-for="(days, i) in monthDays"
                                        :key="i"
                                        @dblclick="dbclickTd(i + 1, data)"
                                    >
                                        {{data.selectedWorktype[i]}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <b-modal id="selectModal" size="lg" hide-footer>
                                <select-schedule
                                    @exit="closeModal"
                                    :schedule="schedule"
                                    :selectedYear="selectedYear"
                                    :selectedMonth="selectedMonth"
                                    :apiData="apiData"
                                    :updateKey="1"
                                >
                                </select-schedule>
                            </b-modal>

                            <b-modal id="importModal" size="lg" hide-footer>
                                <import-data @exit="closeModal"></import-data>
                            </b-modal>


                            <pagination
                                :data="apiData"
                                @pagination-change-page="runAxiosGet"
                                :limit="5"
                            >
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
import SelectSchedule from "./SelectSchedule.vue";
import Datepicker from "vuejs-datepicker";
import moment from "moment";
import VueMonthlyPicker from "vue-monthly-picker";
import ImportComponent from "./ImportSchedule.vue";

export default {
    components: {
        pagination: pagination,
        selectSchedule: SelectSchedule,
        Datepicker,
        VueMonthlyPicker,
        moment,
        importData: ImportComponent,
    },

    data() {
        return {
            scheduledData: {},
            apiData: {},
            search: "",
            monthDays: [],
            schedule: {
                index: "",
                data: "",
            },
            selectedYear: "2021",
            selectedMonth: "",
            updateKey: 0,
            row: 31,
        };
    },

    mounted() {
        this.runAxiosGet();
        this.setActualMonth();
        this.showSchedule();
    },

    watch: {
        selectedMonth() {
            this.getDayNames();
            this.showSchedule();
            this.runAxiosGet();
        },

        search(after, before) {
            this.runAxiosGet();
        },

        row(after, before) {
            this.runAxiosGet();
        },

        updateKey() {
            this.runAxiosGet();
            this.setActualMonth();
            this.showSchedule();
        },
    },

    computed: {
        styles: function () {
            return {
                "background-color": "grey",
            };
        },

    },

    methods: {
        update() {
            this.$forceUpdate();
        },

        cells(i, userid) {
            var cells = [];
            cells[userid] = this.scheduledData
                .filter((x) => x.userid == userid)
                .filter((x) => x.selectedYear == this.selectedYear)
                .filter((x) => x.selectedMonth == this.selectedMonth)
                .filter((x) => x.selectedDay == i)
                .map((x) => x.selectedWorktype);

            return cells[userid][0];
        },


        closeModal() {
            this.$bvModal.hide("selectModal");
            this.updateKey = this.updateKey + 1;
            this.$bvModal.hide("importModal");
        },

        setActualMonth() {
            var d = new Date();
            this.selectedMonth = d.getMonth() + 1;
        },

        getDayNames() {
            var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            this.monthDays = [];
            var daysInMonth = new Date(
                this.selectedYear,
                this.selectedMonth,
                0
            ).getDate();
            for (let i = 1; i <= daysInMonth; i++) {
                var d = new Date(this.selectedYear, this.selectedMonth - 1, i);
                var dayName = days[d.getDay()];
                this.monthDays.push(i + " " + dayName);
            }
        },

        dbclickTd(index, data) {
            this.schedule.index = index;
            this.schedule.data = data;
            this.$bvModal.show("selectModal");
        },

        runAxiosGet(page = 1) {
            axios
                .get("api/personnel/personnellist/", {
                    params: {
                        page,
                        search: this.search,
                        row:    this.row,
                        year:   this.selectedYear,
                        month:  this.selectedMonth,
                    },
                })
                .then((res) => {
                    console.log(res.data);
                    this.apiData = res.data;

                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        showSchedule() {
            axios
                .get("api/personnel/schedules", {
                    params: {
                        selectedYear: this.selectedYear,
                        selectedMonth: this.selectedMonth,
                    },
                })
                .then((res) => {
                    this.$emit("exit", true);
                    this.scheduledData = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },
    },
};
</script>

<style scoped>
table {
    margin-left: auto;
    margin-right: auto;
    font-size: 8px;
    height: 100%;
    table-layout: fixed;
}

td {
    border: 1px solid black;
    text-align: center;
    padding: 3px;
}

th {
    border: 1px solid black;
    text-align: center;
    padding: 3px;
    font-size: 7px;
}

tr:nth-child(even) {
    background-color: #00cf45;
}

h1 {
    color: green;
}
</style>

