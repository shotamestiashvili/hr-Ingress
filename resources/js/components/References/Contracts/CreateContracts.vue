<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="form-outline  mb-4">
              <label class="form-label" for="contract_type">Contract Type</label>
              <input
                type="text"
                id="contract_type"
                class="form-control"
                v-model="form.contract_type"
              />
            </div>

            <div class="form-outline  mb-4">
              <label class="form-label" for="end_date_is_mandatory"
                >End Date is mandatory</label
              >
              <input
                type="text"
                id="end_date_is_mandatory"
                class="form-control"
                v-model="form.end_date_is_mandatory"
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
  name: "PostFormAxios",

  data() {
    return {
      form: {
        contract_type: "",
        end_date_is_mandatory: "",

      },
    };
  },
  methods: {
    clearFields() {
      this.form.contract_type = "";
      this.form.end_date_is_mandatory = "";

    },

    submitForm() {
      axios
        .post("api/references/contracts", this.form)
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

