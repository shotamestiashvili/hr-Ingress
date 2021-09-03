<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <strong> Personnel List </strong>
          </div>
          <div class="card-body">
            <b-button
              v-b-modal.createModal
              variant="info"
              ref="btnShow"
              size="sm"
              id="createModal"
              >Create Personnel</b-button
            >

            <b-button
              v-b-modal.importModal
              variant="warning"
              ref="btnShow"
              size="sm"
              >Import Personnel</b-button
            >

            <b-button
              @click="downloadFile"
              variant="dark"
              ref="btnShow"
              size="sm"
              >Export Personnel</b-button
            >

            <input
              type="text"
              placeholder="Filter the table"
              v-model="search"
            />
            <br>
            <hr>
            <br>

            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">UserID</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Position</th>
                  <th scope="col">Department</th>
                  <th scope="col">Mobile Number</th>
                  <th scope="col">Email</th>
                  <th scope="col">Show</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) in apiData.data" :key="index">
                <tr>
                  <td>{{ data.userid }}</td>
                  <td>{{ data.first_name }}</td>
                  <td>{{ data.last_name }}</td>
                  <td>{{ data.position }}</td>
                  <td>{{ data.department }}</td>
                  <td>{{ data.phone }}</td>
                  <td>{{ data.email }}</td>

                  <td>
                    <b-button
                      v-b-modal.showModal
                      variant="success"
                      @click="showingData(data)"
                      size="sm"
                      >Show</b-button
                    >
                  </td>
                  <td>
                    <b-button
                      v-b-modal.editModal
                      variant="warning"
                      @click="editData(data)"
                      size="sm"
                      >Edit</b-button
                    >
                  </td>
                  <td>
                    <b-button
                      v-b-modal.deleteModal
                      variant="danger"
                      @click="runAxiosDelete(data.id)"
                      size="sm"
                      >Delete</b-button
                    >
                  </td>
                </tr>
              </tbody>
            </table>

            <pagination
              :data="apiData"
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
              <create-data @exit="closeModal"> </create-data>
            </b-modal>

            <b-modal id="editModal" size="lg" hide-footer>
              <edit-data @exit="closeModal" :editing="editing"> </edit-data>
            </b-modal>

            <b-modal id="showModal" size="xl" hide-footer>
              <show-data @exit="closeModal" :showing="showing"> </show-data>
            </b-modal>

            <b-modal id="importModal" size="lg" hide-footer>
              <import-data @exit="closeModal"> </import-data>
            </b-modal>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CreateComponent from "./CreatePersonnel.vue";
import EditComponent from "./EditPersonnel.vue";
import ShowComponent from "./ShowButton.vue";
import ImportComponent from "./ImportPersonnel.vue";
import pagination from "laravel-vue-pagination";

export default {
  components: {
    createData: CreateComponent,
    editData: EditComponent,
    showData: ShowComponent,
    importData: ImportComponent,
    pagination: pagination,
  },

  data() {
    return {
      showing: "",
      editing: null,
      apiData: [],
      filterText: null,
      search: "",
    };
  },

  computed: {},

  watch: {
    search(after, before) {
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
        .get("api/personnel/personnellist/", {
          params: {
            page,
            search: this.search,
          },
        })
        .then((res) => {
          this.apiData = res.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    runAxiosDelete(id) {
      axios
        .delete("api/personnel/personnellist/" + id)
        .then((res) => {
          this.runAxiosGet();
        })
        .catch((error) => {
          console.log("not working");
        })
        .finally(() => {});
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
/* table {
  margin-left: auto;
  margin-right: auto;
  font-size: 10px;
  height: 100%;
  table-layout: fixed;
} */

td {
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
</style>
