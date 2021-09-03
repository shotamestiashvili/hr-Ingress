<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->

          <div class="form-outline mb-4">
            <label class="form-label" for="position_name">Position Name</label>
            <input
              type="text"
              id="position_name"
              class="form-control"
              v-model="form.position_name"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="description">Description</label>
            <input
              type="string"
              id="description"
              class="form-control"
              v-model="form.description"
            />
          </div>

          <div class="form-outline mb-4">
            <label class="form-label" for="code">Code </label>
            <input
              type="text"
              id="code"
              class="form-control"
              v-model="form.code"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="holiday_name">Salary</label>
            <input
              type="string"
              id="salary"
              class="form-control"
              v-model="form.salary"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="job_description"
              >Job Description</label
            >
            <input
              type="text"
              id="job_description"
              class="form-control"
              v-model="form.job_description"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="experiance">Expiriance</label>
            <input
              type="string"
              id="experiance"
              class="form-control"
              v-model="form.experiance"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="note">Note</label>
            <input
              type="text"
              id="note"
              class="form-control"
              v-model="form.note"
            />
          </div>

          <div class="form-outline mb-4">
            <label class="form-label" for="cost_center">Cost Center</label>
            <input
              type="text"
              id="cost_center"
              class="form-control"
              v-model="form.cost_center"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="confirmation">Confirmation</label>
            <input
              type="string"
              id="confirmation"
              class="form-control"
              v-model="form.confirmation"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="no_confirmation"
              >No Confirmation</label
            >
            <input
              type="text"
              id="no_confirmation"
              class="form-control"
              v-model="form.no_confirmation"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="epl_count">EPL Count</label>
            <input
              type="string"
              id="epl_count"
              class="form-control"
              v-model="form.epl_count"
            />
          </div>
          <button type="submit" class="btn btn-info">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        position_name: "",
        description: "",
        code: "",
        salary: "",
        job_description: "",
        experiance: "",
        note: "",
        cost_center: "",
        confirmation: "",
        no_confirmation: "",
        epl_count: "",
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/positions", this.form)
        .then((res) => {
          this.$emit("exit", true);
          console.log("works");
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },
  },
};
</script>

