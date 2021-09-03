<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="salary_date">Salary Date</label>
              <input type="date" id="salary_date" class="form-control"  v-model="form.salary_date"/>
            </div>


          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit Salary Date</button>
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
        salary_date: this.editing.salary_date,
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/salarydates", this.form)
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
