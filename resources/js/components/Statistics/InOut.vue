<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong> In /Out </strong>
                    </div>

                    <div class="card-body">
                        <b-button
                            @click="runRefresh()"
                            variant="info"
                            ref="btnShow"
                            size="sm"
                            id="refresh"
                        >Refresh Attenance
                        </b-button
                        >

                        <b-button
                            @click.prevent="runGenerate()"
                            variant="info"
                            ref="btnShow"
                            size="sm"
                            id="refresh"
                        >Calculate Hours
                        </b-button
                        >

                        <!-- <b-button
                          v-b-modal.importModal
                          variant="warning"
                          ref="btnShow"
                          size="sm"
                          >Import Personnel</b-button
                        > -->

                        <b-button
                            @click="downloadFile"
                            variant="dark"
                            ref="btnShow"
                            size="sm"
                        >Export Attenance
                        </b-button
                        >

                        <input
                            type="text"
                            placeholder="Filter the table"
                            v-model="search"
                        />
                        <br/>
                        <hr/>
                        <br/>
                        <div>
                            <input id="calendar" name="calendar" type="date" v-model="search">
                            &nbsp;
                            <select
                                class="form-select"
                                v-model="row"
                                aria-label=".form-select-sm example"
                            >

                                <option selected>Select Row N</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                                <option value="80">80</option>
                                <option value="100">100</option>
                            </select>
                            &nbsp;

                        </div>



                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th width="17%" scope="col">Name</th>
                                <th width="11%" scope="col">Date</th>
                                <th scope="col">In</th>
                                <th scope="col">Break</th>
                                <th scope="col">Resume</th>
                                <th scope="col">Out</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Honor. Min</th>
                                <th scope="col">Early In</th>
                                <th scope="col">Delay</th>
                                <th scope="col">Early Out</th>
                                <th scope="col">Late Out</th>
                            </tr>
                            </thead>
                            <tbody v-for="(data, index) in apiInout.data" :key="index">
                            <tr>
                                <td>{{ data.userid }}</td>
                                <td>{{ data.first_name[0] }} {{ data.last_name [0] }}</td>
                                <td>{{ data.date }}</td>
                                <td>{{ data.att_in }}</td>
                                <td>{{ data.att_break }}</td>
                                <td>{{ data.att_resume }}</td>
                                <td>{{ data.att_out }}</td>
                                <td>{{ data.start[0] }}</td>
                                <td>{{ data.end[0] }}</td>
                                <td>{{ data.honorminutes[0] }}</td>
                                <td>{{ data.earlyIn[0] }}</td>
                                <td>{{ data.delayIn[0] }}</td>
                                <td>{{ data.earlyOut[0] }}</td>
                                <td>{{ data.lateOut [0] }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <pagination
                            :data="apiInout"
                            @pagination-change-page="runAxiosGet"
                            :limit="5"
                        >
                            <span slot="prev-nav">&lt; Previous</span>
                            <span slot="next-nav">Next &gt;</span>
                        </pagination>

                        <!-- <pagination
                          :data="filteredAbsence"
                          @pagination-change-page="runAxiosGet"
                        ></pagination> -->

                        <b-modal id="createModal" hide-footer size="lg">
                            <create-data @exit="closeModal"></create-data>
                        </b-modal>

                        <b-modal id="editModal" size="lg" hide-footer>
                            <edit-data @exit="closeModal" :editing="editing"></edit-data>
                        </b-modal>

                        <b-modal id="showModal" size="xl" hide-footer>
                            <show-data @exit="closeModal" :showing="showing"></show-data>
                        </b-modal>

                        <b-modal id="importModal" size="lg" hide-footer>
                            <import-data @exit="closeModal"></import-data>
                        </b-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import pagination from "laravel-vue-pagination";

export default {
    components: {
        pagination: pagination,
    },

    data() {
        return {
            showing: "",
            editing: null,
            apiInout: {},
            filterText: null,
            search: "",
            row: 31,
        };
    },

    computed: {},

    watch: {
        search(after, before) {
            this.runAxiosGet();
        },

        row(after, before) {
            this.runAxiosGet();
        },

    },

    mounted() {
        this.runAxiosGet();
    },

    methods: {
        closeModal() {
            this.$bvModal.hide("createModal");
            this.$bvModal.hide("editModal");
            this.$bvModal.hide("showModal");
            this.$bvModal.hide("importModal");
            this.runAxiosGet();
        },

        downloadFile() {
            window.open("/api/export/personnel");
        },

        runAxiosGet(page = 1) {
            axios
                .get("api/inout/index", {
                    params: {
                        page,
                        search: this.search,
                        row: this.row,
                    },
                })
                .then((res) => {
                    this.apiInout = res.data;
                    console.log(res.data);
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        runRefresh() {
            axios
                .get("api/inout/refresh")
                .then((res) => {
                    console.log("OK");
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        runGenerate() {
            axios
                .get("api/inout/generate")
                .then((res) => {
                    console.log("OK");
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                });
        },

        // downloadFile() {
        //   axios
        //     .get("api/export/personnel", { responseType: "arraybuffer" })
        //     .then((response) => {
        //       var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        //       var fileLink = document.createElement("a");
        //       fileLink.href = fileURL;
        //       fileLink.setAttribute("download", "personnel_list.xlsx");
        //       document.body.appendChild(fileLink);
        //       fileLink.click();
        //     });
        // },

        editData(data) {
            this.editing = data;
        },

        showingData(data) {
            this.showing = data;
            console.log(data);
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
    font-size: 10px;
}

th {
    border: 1px solid black;
    text-align: center;
    padding: 3px;
    font-size: 13px;
}

tr:nth-child(even) {
    background-color: #00cf45;
}

h1 {
    color: green;
}

/* table {
  margin-left: auto;
  margin-right: auto;
  font-size: 10px;
  height: 100%;
  table-layout: fixed;
} */

/* td {
  border: 1px solid black;
  text-align: center;
  padding: 1px;
  font-size: 12px;
}

th {
  border: 1px solid black;
  text-align: center;
  padding: 1px;
  font-size: 14px;
}

tr:nth-child(even) {
  background-color: #00cf45;
}

h1 {
  color: green;
}

/* #createModal {
  border: none;
  padding: 8px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
} */
</style> */
