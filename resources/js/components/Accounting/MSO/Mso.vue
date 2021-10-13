<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong>MSO List </strong>
                    </div>
                    <div class="card-body">

                        <select
                            class="form-select"
                            v-model="row"
                            aria-label=".form-select-sm example"
                        >
                            <option selected>Select Year</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                        </select>
                        &nbsp;
                        <b-button
                            @click="exportMso"
                            variant="dark"
                            ref="btnShow"
                            size="sm"
                        >Export MSO
                        </b-button
                        >
                        &nbsp;
                        <input
                            type="text"
                            placeholder="Search ..."
                            v-model="search"
                        />
                        <hr>
                        <br>

                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th width="17%">Name</th>
                                <th width="15%">Position</th>
                                <th width="7%">Jan 21</th>
                                <th width="7%">Feb 21</th>
                                <th width="7%">Mar 21</th>
                                <th width="7%">Apr 21</th>
                                <th width="7%">May 21</th>
                                <th width="7%">Jun 21</th>
                                <th width="7%">Jul 21</th>
                                <th width="7%">Aug 21</th>
                                <th width="7%">Sep 21</th>
                                <th width="7%">Oct 21</th>
                                <th width="7%">Nov 21</th>
                                <th width="7%">Dec 21</th>
                                <th width="7%">Total 2021</th>
                            </tr>
                            </thead>
                            <tbody v-for="(data, index) in msoApi.data" :key="index">
                            <tr>
                                <td>{{data.name}}</td>
                                <td>{{data.position}}</td>
                                <td>{{data.jan}}</td>
                                <td>{{data.feb}}</td>
                                <td>{{data.mar}}</td>
                                <td>{{data.apr}}</td>
                                <td>{{data.may}}</td>
                                <td>{{data.jun}}</td>
                                <td>{{data.jul}}</td>
                                <td>{{data.aug}}</td>
                                <td>{{data.sep}}</td>
                                <td>{{data.oct}}</td>
                                <td>{{data.nov}}</td>
                                <td>{{data.dec}}</td>
                                <td>Total</td>
                            </tr>
                            </tbody>
                        </table>

                        <pagination
                            :data="msoApi"
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
            search: "",
            msoApi : "",
            row: 30,
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

        exportMso() {
            window.open('/api/export/mso');
        },

        runAxiosGet(page = 1) {
            axios
                .get("api/mso/show/", {
                    params: {
                        page,
                        search: this.search,
                        row:    this.row
                    },
                })
                .then((res) => {
                    this.msoApi = res.data;
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
    font-size: 9px;
    height: 100%;
    table-layout: fixed;
}

td {
    /*border: 0.5px solid black;*/
    text-align: center;
    padding: 1px;
}

th {
    /*border: 1px solid black;*/
    text-align: center;
    padding: 3px;
    font-size: 10px;
}

tr:nth-child(even) {
    background-color: #00cf45;
}

h1 {
    color: green;
}
</style>

