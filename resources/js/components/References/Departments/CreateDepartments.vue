<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="form-outline  mb-4">
              <label class="form-label" for="department">Department</label>
              <input
                type="text"
                id="department"
                class="form-control"
                v-model="form.department"
              />
            </div>

            <div class="form-outline  mb-4">
              <label class="form-label" for="code"
                >Code</label
              >
              <input
                type="text"
                id="code"
                class="form-control"
                v-model="form.code"
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
        department: "",
        code: "",

      },
    };
  },
  methods: {
    clearFields() {
      this.form.department = "";
      this.form.code = "";

    },

    submitForm() {
      axios
        .post("api/references/departments", this.form)
        .then((res) => {
          this.clearFields();
          this.$emit('exit');
          console.log("works");
        })
        .catch((error) => {
          console.log("not working");
        })
        .finally(() => {});
    },
  },
};
</script>

