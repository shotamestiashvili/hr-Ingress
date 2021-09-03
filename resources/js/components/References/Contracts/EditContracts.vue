<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="contract_type">Contract Types</label>
              <input type="text" id="contract_type" class="form-control"  v-model="form.contract_type"/>

            </div>

            <div class="form-outline  mb-4">
                 <label class="form-label" for="end_date_is_mandatory">End Date is Mandatory </label>
              <input type="text" id="end_date_is_mandatory" class="form-control" v-model="form.end_date_is_mandatory"/>

            </div>


          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "PostFormAxios",
  props: ["editing"],

  data() {
    return {
      form: {
        id: this.editing.id,
        contract_type: this.editing.contract_type,
        end_date_is_mandatory: this.editing.end_date_is_mandatory,
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/contracts", this.form)
        .then((res) => {
          this.$emit("exit", true);
          console.log(this.form.id);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },
  },
};
</script>
