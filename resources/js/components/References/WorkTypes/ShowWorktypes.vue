<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <strong> Work Types List </strong>
          </div>
          <div class="card-body">
            <b-button v-b-modal.createModal variant="info" ref="btnShow"
              >Create Worktype</b-button
            >

            <b-button v-b-modal.importModal variant="warning" ref="btnShow"
              >Import Work Type</b-button
            >

            <b-button @click="downloadFile" variant="dark" ref="btnShow"
              >Export Work Type</b-button
            >

            <input
              type="text"
              placeholder="Filter the table"
              v-model="search"
            />

            <b-modal id="createModal" hide-footer size="lg">
              <create-data @exit="closeModal"> </create-data>
            </b-modal>
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">Code</th>
                  <th scope="col">Start</th>
                  <th scope="col">End</th>
                  <th scope="col">Hours</th>
                  <th scope="col">In24</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) in apiData.data" :key="index">
                <tr>
                  <td>{{ data.code }}</td>
                  <td>{{ data.start }}</td>
                  <td>{{ data.end }}</td>
                  <td>{{ data.hours }}</td>
                  <td>
                    <div v-if="data.in24hours == 1">YES</div>
                    <div v-else>No</div>
                  </td>

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
import CreateComponent from "./CreateWorktypes.vue";
import EditComponent from "./EditWorktypes.vue";
import ImportComponent from "./ImportWorktypes.vue";
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
      this.$bvModal.hide("importModal");
      this.runAxiosGet();
    },

    downloadFile() {
      window.open("/api/export/worktype");
    },

    runAxiosGet(page = 1) {
      axios
        .get("api/references/worktypes", {
          params: {
            page,
            searchFromWorktype: this.search,
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
        .delete("api/references/worktypes/" + id)
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
