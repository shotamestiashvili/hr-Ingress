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
                                        <label>Personnel</label>
                                        <select v-model="form.selectedPersonnel">
                                            <option
                                                v-for="personnel in personnels"
                                                v-bind:key="personnel.id"
                                                v-bind:value="personnel.userid"
                                            >
                                                {{ personnel.first_name }} - {{ personnel.last_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">

                                    </div>
                                </div>
                                <br>
                                <br>

                                <div class="row">

                                    <label for="start"> Start </label>
                                    <div class="col-sm-3 form-group" id="start">
                                        <vue-timepicker v-model="form.starttime"></vue-timepicker>
                                    </div>

                                    <label for="break"> Break </label>
                                    <div class="col-sm-3 form-group" id="break">
                                        <vue-timepicker v-model="form.breaktime"></vue-timepicker>
                                    </div>
                                    <label for="end"> End </label>
                                    <div class="col-sm-3 form-group" id="end">
                                        <vue-timepicker v-model="form.endtime"></vue-timepicker>
                                    </div>
                                </div>


                                <div class="row">
                                    <label for="startdate"> Start Date </label>
                                    <div class="col-sm-6 form-group">
                                        <date-picker mode="date" v-model="form.startdate">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input class="px-3 py-1 border rounded" :value="inputValue"
                                                       v-on="inputEvents"/>
                                            </template>
                                        </date-picker>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label for="enddate"> End Date </label>
                                        <date-picker mode="date" v-model="form.enddate">
                                            <template #default="{ inputValue, inputEvents }">
                                                <input class="px-3 py-1 border rounded" :value="inputValue"
                                                       v-on="inputEvents"/>
                                            </template>
                                        </date-picker>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label>Position</label>
                                        <br>

                                        <select v-model="form.selectedPosition">
                                            <option
                                                v-for="position in positions"
                                                v-bind:key="position.id"
                                                v-bind:value="position.id">
                                                {{ position.position_name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Type</label>
                                        <br>
                                        <input type="radio" v-model="form.type" value="1" checked> &nbsp; MSO
                                        <br>
                                        <input type="radio" v-model="form.type" value="2"> &nbsp; Overtime
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label> Description</label>
                                            <input
                                                type="text"
                                                placeholder="Description"
                                                class="form-control"
                                                v-model="form.description"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <br>

                            <button type="submit" @click.prevent="submitForm" class="btn btn-lg btn-info">
                                Submit
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ form }}
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
            date: new Date(),
            personnels: [],
            positions: [],
            form: {
                selectedPersonnel: "",
                selectedPosition: "",
                starttime: {HH: '00', mm: '00'},
                breaktime: {HH: '01', mm: '00'},
                endtime: {HH: '00', mm: '00'},
                type: "",
                description: "",
                startdate: "",
                enddate: "",
            },
        };
    },

    mounted() {
        this.Personnel();
        this.Position();
    },

    watch: {
        form: function () {
            this.form.startdate = moment(this.form.startdate, "MM-DD-YYYY");
            this.form.enddate = moment(this.form.enddate, "MM-DD-YYYY");

        },
    },

    computed: {},

    methods: {

        Personnel() {
            axios
                .get("api/mso/personnel/index")
                .then((res) => {
                    console.log(res.data.data);
                    this.personnels = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        Position() {
            axios
                .get("api/references/positions",)
                .then((res) => {
                    this.positions = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        submitForm() {
            axios
                .post("api/mso/personnel/store", this.form)
                .then((res) => {
                    this.form.selectedPersonnel = '';
                    this.form.selectedPosition = '';
                    this.form.starttime =  {HH: '00', mm: '00'};
                    this.form.breaktime = {HH: '01', mm: '00'};
                    this.form.endtime =  {HH: '00', mm: '00'};
                    this.form.type = '';
                    this.form.description = '';
                    this.form.startdate = '';
                    this.form.enddate = '';
                    this.$swal.fire({icon: 'success', title: 'Created Successfully'});
                    console.log(res);
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

