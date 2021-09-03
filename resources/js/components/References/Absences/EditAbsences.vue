<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

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
        name: this.editing.name,
        percent_from_salary: this.editing.percent_from_salary,
         color: this.editing.color,
        nickname: this.editing.nickname,
      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/absences", this.form)
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
