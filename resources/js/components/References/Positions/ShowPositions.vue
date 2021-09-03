<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <strong> Position List </strong>
          </div>
          <div class="card-body">
            <b-button v-b-modal.createModal variant="info" ref="btnShow"
              >Create Position</b-button
            >
            <input
              type="text"
              placeholder="Filter the table"
              v-model="search"
            />

            <b-button v-b-modal.importModal variant="warning" ref="btnShow"
              >Import Position</b-button
            >

            <b-button @click="downloadFile" variant="dark" ref="btnShow"
              >Export Position</b-button
            >

            <b-modal id="createModal" hide-footer size="lg">
              <create-data @exit="closeModal"> </create-data>
            </b-modal>
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">Position Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Code</th>
                  <th scope="col">Salary</th>
                  <th scope="col">Job Description</th>
                  <th scope="col">Experiance</th>
                  <th scope="col">Note</th>
                  <th scope="col">Cost Center</th>
                  <th scope="col">Confirmation</th>
                  <th scope="col">No Confirmation</th>
                  <th scope="col">EPL Count</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) in apiData.data" :key="index">
                <tr>
                  <td>{{ data.position_name }}</td>
                  <td>{{ data.description }}</td>
                  <td>{{ data.code }}</td>
                  <td>{{ data.salary }}</td>
                  <td>{{ data.job_description }}</td>
                  <td>{{ data.experiance }}</td>
                  <td>{{ data.note }}</td>
                  <td>{{ data.cost_center }}</td>
                  <td>{{ data.confirmation }}</td>
                  <td>{{ data.no_confirmation }}</td>
                  <td>{{ data.epl_count }}</td>

                  <td>
                    <b-button
                      v-b-modal.editModal
                      variant="warning"
                      @click="editData(data)"
                      >Edit</b-button
                    >
                    <b-button
                      v-b-modal.deleteModal
                      variant="danger"
                      @click="runAxiosDelete(data.id)"
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

            <b-modal id="editModal" size="lg" hide-footer>
              <edit-data @exit="closeModal" :editing="editing"> </edit-data>
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
import CreateComponent from "./CreatePositions.vue";
import EditComponent from "./EditPositions.vue";
import ImportComponent from "./ImportPositions.vue";
import pagination from "laravel-vue-pagination";

export default {
  components: {
    createData: CreateComponent,
    editData: EditComponent,
    importData: ImportComponent,
    pagination: pagination,
  },

  data() {
    return {
      editing: null,
      apiData: [],
      filterText: null,
      search: "",
    };
  },

  watch: {
    search(after, before) {
      this.runAxiosGet();
    },
  },

  computed: {
    filteredAbsence() {},
  },

  mounted() {
    this.runAxiosGet();
  },

  methods: {
    closeModal() {
      this.$bvModal.hide("createModal");
      this.$bvModal.hide("editModal");
      this.$bvModal.hide("importModal");
      this.runAxiosGet();
    },

    downloadFile() {
      window.open("/api/export/position");
    },

    runAxiosGet(page = 1) {
      axios
        .get("api/references/positions", {
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
        .delete("api/references/positions/" + id)
        .then((res) => {
          this.runAxiosGet();
        })
        .catch((error) => {
          console.log("not working");
        })
        .finally(() => {});
    },

    editData(data) {
      this.editing = data;
    },
  },
};
</script>
