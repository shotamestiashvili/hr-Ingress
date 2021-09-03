<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="holiday_name">Qualification Name</label>
              <input type="text" id="qualification" class="form-control"  v-model="form.qualification"/>
            </div>


          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit qualification</button>
          <!-- </div> -->
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
        qualification: this.editing.qualification,
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/qualifications", this.form)
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
