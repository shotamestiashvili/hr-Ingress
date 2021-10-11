<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="col-lg-12 well">
                        <div class="row">
                            <form v-on:submit.prevent="submitForm">
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
                                        <div class="col-sm-2 form-group">
                                            <input id="calendar" name="calendar" type="date" v-model="form.startdate">
                                        </div>
                                        &nbsp;
                                        <div class="col-sm-2 form-group">
                                            <vue-timepicker v-model="form.starttime" format="HH:mm"></vue-timepicker>
                                        </div>
                                        <div class="col-sm-2 form-group">

                                            <input
                                                type="text"
                                                placeholder="Userid"
                                                class="form-control"
                                                v-model="form.breaktime"
                                            />
                                        </div>

                                        <div class="col-sm-2 form-group">
                                            <input id="calendar" name="calendar" type="date" v-model="form.enddate">
                                        </div>
                                        &nbsp;
                                        <div class="col-sm-2 form-group">

                                            <vue-timepicker  v-model="form.endtime" format="HH:mm"></vue-timepicker>
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

                                <button type="submit" class="btn btn-lg btn-info">
                                    Submit
                                </button>

                            </form>
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

// CSS
import 'vue2-timepicker/dist/VueTimepicker.css'

export default {

    components: {
        swal: Swal,
        VueTimepicker: VueTimepicker,
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

