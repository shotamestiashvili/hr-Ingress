<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->
                       <div class="form-outline mb-4" >
                 <label class="form-label" for="name">Absence Name</label>
              <input type="text" id="name" class="form-control"  v-model="form.name"/>

            </div>

            <div class="form-outline  mb-4">
                 <label class="form-label" for="percent_from_salary">Percentage from Salary</label>
              <input type="text" id="percent_from_salary" class="form-control" v-model="form.percent_from_salary"/>

            </div>

                        <div class="form-outline mb-4" >
                 <label class="form-label" for="color">Color</label>
              <input type="text" id="color" class="form-control"  v-model="form.color"/>

            </div>

            <div class="form-outline  mb-4">
                 <label class="form-label" for="nickname">Nickname</label>
              <input type="text" id="nickname" class="form-control" v-model="form.nickname"/>

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
        name: "",
        percent_from_salary: "",
        color: "",
        nickname: "",

      },
    };
  },
  methods: {

    submitForm() {
      axios
        .post("api/references/absences", this.form)
        .then((res) => {
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

