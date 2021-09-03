<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="education">Educations</label>
              <input type="text" id="education" class="form-control"  v-model="form.education"/>

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
        education: this.editing.education,

      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/educations", this.form)
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
