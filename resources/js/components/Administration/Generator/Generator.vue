<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="col-lg-12 well">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="row">

                                    <div class="col-sm-6 form-group">
                                        <button type="button" @click="monthlyGrid">Monthly Grid</button>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <button type="button" @click="monthlyInout">Monthly Inout</button>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <button type="button" @click="dailyInout"> Daily Inout</button>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-6 form-group">
                                        <label for="attendanceDateStart"> Attendance Date Range </label>
                                        <div class="col-sm-6 form-group" id="attendanceDateStart">
                                            <label for="attendanceDateStart"> Start Date </label>
                                            <date-picker mode="date" v-model="attendanceRangeStart">
                                                <template #default="{ inputValue, inputEvents }">
                                                    <input class="px-3 py-1 border rounded" :value="inputValue"
                                                           v-on="inputEvents"/>
                                                </template>
                                            </date-picker>
                                        </div>

                                        <div class="col-sm-6 form-group" id="attendanceDateEnd">
                                            <label for="attendanceDateEnd"> End Date </label>
                                            <date-picker mode="date" v-model="attendanceRangeEnd">
                                                <template #default="{ inputValue, inputEvents }">
                                                    <input class="px-3 py-1 border rounded" :value="inputValue"
                                                           v-on="inputEvents"/>
                                                </template>
                                            </date-picker>
                                        </div>

                                        <button type="button" @click="attendanceMonthly"> Attendance Submit</button>
                                    </div>
                                </div>
                                <br>
                                <br>

                                <div class="row">
                                    <div class="col-sm-6 form-group" id="customStatistic">

                                        <date-picker mode="date" v-model="customStatistic">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input class="px-3 py-1 border rounded" :value="inputValue"
                                                       v-on="inputEvents"/>
                                            </template>
                                        </date-picker>
                                        <button type="button" @click="customStatisticMethod"> Custom Date Statistic
                                        </button>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <button type="button" @click="dailyStatistic"> Daily Statistic</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import axios from "axios";
import Swal from 'sweetalert2';
// Main JS (in UMD format)
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'
import VCalendar from 'v-calendar';
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import moment from 'vue-moment';
import VueMoment from "vue-moment";
//

export default {

    components: {
        swal: Swal,
        VueTimepicker: VueTimepicker,
        // 'calendar': Calendar,
        'date-picker': DatePicker,
        vcalendar: VCalendar,
        moment: moment,
    },

    data() {
        return {
            attendanceRangeStart: "",
            attendanceRangeEnd: "",
            customStatistic: "",

        };
    },

    mounted() {

    },

    watch: {
        attendanceRangeStart: function () {
            this.attendanceRangeStart = moment(this.attendanceRangeStart, "YYYY-MM-DD");
        },

        attendanceRangeEnd: function () {
            this.attendanceRangeEnd = moment(this.attendanceRangeEnd, "YYYY-MM-DD");
        },

        customStatistic: function () {
            this.customStatistic = moment(this.customStatistic, "YYYY-MM-DD");
        },
    },


    methods: {

        monthlyGrid() {
            axios
                .get("monthlygrid")
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});

                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
                    console.log(error);
                })
                .finally(() => {
                });
        },

        monthlyInout() {
            axios
                .get("monthlyinout")
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
                    console.log(error);
                })
                .finally(() => {
                });
        },

        dailyInout() {
            axios
                .get("dailyinout")
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
                    console.log(error);
                })
                .finally(() => {
                });
        },

        attendanceMonthly() {
            axios
                .get("attendances", {
                    params: {
                        start: this.attendanceRangeStart,
                        end: this.attendanceRangeEnd
                    },
                })
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
                    console.log(error);
                })
                .finally(() => {
                });
        },

        customStatisticMethod() {
            axios
                .get("monthlystatistic", {
                    params: {
                        date: this.customStatistic,
                    },
                })
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
                    console.log(error);
                })
                .finally(() => {
                });
        },

        dailyStatistic() {
            axios
                .get("attendance")
                .then((res) => {
                    console.log(res.data.data);
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                })
                .catch((error) => {
                    this.$swal({icon: 'error', title: error});
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

