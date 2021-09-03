<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <strong> Contract List </strong>
          </div>
          <div class="card-body">
            <b-button v-b-modal.createModal variant="info" ref="btnShow"
              >Create Contract</b-button
            >

            <input
              type="text"
              placeholder="Filter the table"
              v-model="filterText"
            />

            <b-modal id="createModal" hide-footer size="lg">
              <create-data @exit="closeModal"> </create-data>
            </b-modal>
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">Contract Type</th>
                  <th scope="col">End Date is Mandatory</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) in filteredAbsence" :key="index">
                <tr>
                  <td>{{ data.contract_type }}</td>
                  <td>{{ data.end_date_is_mandatory }}</td>
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
            <b-modal id="editModal" size="lg" hide-footer>
              <edit-data @exit="closeModal" :editing="editing">
              </edit-data>
            </b-modal>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import CreateContracts from "./CreateContracts.vue";
import EditContracts from "./EditContracts.vue";

export default {
  components: {
    createData: CreateContracts,
    editData: EditContracts,
  },

  data() {
    return {
      editing: null,
      apiData: [],
      filterText: null,
    };
  },

  computed: {
    filteredAbsence() {
      if (!this.filterText == '') {
        return this.apiData.filter((data) => {
          return data.contract_type.toLowerCase().includes(this.filterText.toLowerCase()) ||
                 data.end_date_is_mandatory.toLowerCase().includes(this.filterText.toLowerCase());

        });
      } else {
        return this.apiData;
      }
    },
  },

    mounted() {
      this.runAxiosGet();
    },

    methods: {
      closeModal() {
        this.$bvModal.hide("createModal");
        this.$bvModal.hide("editModal");
        this.runAxiosGet();
      },

      runAxiosGet() {
        axios
          .get("api/references/contracts")
          .then((res) => {
            this.apiData = res.data.data;
            console.log(response.data);
          })
          .catch((error) => {
            console.log("not working");
          })
          .finally(() => {});
      },

      runAxiosDelete(id) {
        axios
          .delete("api/references/contracts/" + id)
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
  }
</script>
