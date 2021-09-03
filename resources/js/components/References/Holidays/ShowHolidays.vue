<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <strong> Holiday List </strong>
          </div>
          <div class="card-body">
            <b-button v-b-modal.createModal variant="info" ref="btnShow"
              >Create Holidays</b-button
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
                  <th scope="col">Holiday Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody v-for="(data, index) in filteredAbsence" :key="index">
                <tr>
                  <td>{{ data.holiday_name }}</td>
                   <td>{{ data.date }}</td>
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
import CreateComponent from "./CreateHolidays.vue";
import EditComponent from "./EditHolidays.vue";

export default {
  components: {
    createData: CreateComponent,
    editData: EditComponent,
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
          return data.holiday_name.toLowerCase().includes(this.filterText.toLowerCase()) ||
           data.date.toLowerCase().includes(this.filterText.toLowerCase())

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
          .get("api/references/holidays")
          .then((res) => {
            this.apiData = res.data.data;
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error);
          })
          .finally(() => {});
      },

      runAxiosDelete(id) {
        axios
          .delete("api/references/holidays/" + id)
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
