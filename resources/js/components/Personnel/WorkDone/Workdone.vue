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
                                        <date-picker class="inline-block h-full" v-model="form.startdate">
                                            <template v-slot="{ inputValue, togglePopover }">
                                                <div class="flex items-center">
                                                    <button
                                                        class="p-2 bg-blue-100 border border-blue-200 hover:bg-blue-200 text-blue-600 rounded-l focus:bg-blue-500 focus:text-white focus:border-blue-500 focus:outline-none"
                                                        @click="togglePopover()"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            class="w-4 h-4 fill-current"
                                                        >
                                                            <path
                                                                d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        :value="inputValue"
                                                        class="bg-white text-gray-700 w-full py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
                                                        readonly
                                                    />
                                                </div>
                                            </template>
                                        </date-picker>
                                        &nbsp;
                                        <div>
                                            <vue-timepicker v-model="form.starttime"></vue-timepicker>
                                        </div>

                                        <div class="col-sm-2 form-group">

                                            <input
                                                type="text"
                                                placeholder="Userid"
                                                class="form-control"
                                                v-model="form.breaktime"
                                            />
                                        </div>

                                        <date-picker class="inline-block h-full" v-model="form.enddate">
                                            <template v-slot="{ inputValue, togglePopover }">
                                                <div class="flex items-center">
                                                    <button
                                                        class="p-2 bg-blue-100 border border-blue-200 hover:bg-blue-200 text-blue-600 rounded-l focus:bg-blue-500 focus:text-white focus:border-blue-500 focus:outline-none"
                                                        @click="togglePopover()"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            class="w-4 h-4 fill-current"
                                                        >
                                                            <path
                                                                d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                    <input

                                                        :value="form.enddate"
                                                        class="bg-white text-gray-700 w-full py-1 px-2 appearance-none border rounded-r focus:outline-none focus:border-blue-500"
                                                        readonly
                                                    />
                                                </div>
                                            </template>
                                        </date-picker>
                                        &nbsp;
                                        <div>
                                            <vue-timepicker  v-model="form.endtime"></vue-timepicker>
                                        </div>



                                    </div>
                                    <br/>
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
                            {{startdate}}  - {{enddate}}
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
//

export default {

    components: {
        swal: Swal,
        VueTimepicker: VueTimepicker,
        // 'calendar': Calendar,
        'date-picker': DatePicker,
        vcalendar: VCalendar,
    },

    data() {
        return {
            personnels: "",
            positions: "",
            form: {
                selectedPersonnel: [],
                selectedPosition: [],
                position: "",
                starttime: "",
                breaktime: "1:00",
                endtime: "",
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

    watch: {},

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
                    this.form = {};
                    this.form.breaktime = "1:00";
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

