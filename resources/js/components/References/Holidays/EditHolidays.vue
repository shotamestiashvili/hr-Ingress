<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="holiday_name">Holiday Name</label>
              <input type="text" id="holiday_name" class="form-control"  v-model="form.holiday_name"/>
            </div>

                        <div class="form-outline mb-4" >
                 <label class="form-label" for="family_status">date</label>
              <input type="date" id="date" class="form-control"  v-model="form.date"/>
            </div>

          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit Holidays</button>
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
        holiday_name: this.editing.holiday_name,
        date: this.editing.date,

      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/holidays", this.form)
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
