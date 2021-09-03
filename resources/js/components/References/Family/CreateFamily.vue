<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->


            <div class="form-outline  mb-4">
              <label class="form-label" for="family_status"
                >Family Status</label
              >
              <input
                type="text"
                id="family_status"
                class="form-control"
                v-model="form.family_status"
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
        family_status: "",
      },
    };
  },
  methods: {
    clearFields() {
      this.form.family_status = "";

    },

    submitForm() {
      axios
        .post("api/references/family", this.form)
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

