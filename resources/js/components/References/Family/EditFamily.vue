<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="family_status">Family Status</label>
              <input type="text" id="family_status" class="form-control"  v-model="form.family_status"/>

            </div>

          <div class="form-group  mb-4">
            <button class="btn btn-primary">Family Status</button>
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
        family_status: this.editing.family_status,

      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/family", this.form)
        .then((res) => {
          this.$emit("exit", true);
          console.log(res);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },
  },
};
</script>
