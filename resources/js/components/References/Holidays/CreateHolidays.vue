<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->


            <div class="form-outline  mb-4">
              <label class="form-label" for="holiday_name"
                >Holiday Name</label
              >
              <input
                type="text"
                id="holiday_name"
                class="form-control"
                v-model="form.holiday_name"
              />
            </div>
                        <div class="form-outline  mb-4">
              <label class="form-label" for="holiday_name"
                >Date</label
              >
                          <input
                type="date"
                id="date"
                class="form-control"
                v-model="form.date"
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
        holiday_name: "",
        date: "",

      },
    };
  },
  methods: {
    clearFields() {
      this.form.holiday_name = "";
       this.form.date = "";

    },

    submitForm() {
      axios
        .post("api/references/holidays", this.form)
        .then((res) => {
          this.clearFields();
          this.$emit('exit');
          console.log("works");
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },
  },
};
</script>

