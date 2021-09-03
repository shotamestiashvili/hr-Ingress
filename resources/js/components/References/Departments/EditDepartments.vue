<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="department">Department</label>
              <input type="text" id="department" class="form-control"  v-model="form.department"/>

            </div>

            <div class="form-outline  mb-4">
                 <label class="form-label" for="code">Code</label>
              <input type="text" id="code" class="form-control" v-model="form.code"/>

            </div>


          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit Update</button>
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
        department: this.editing.department,
        code: this.editing.code,
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/departments", this.form)
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
