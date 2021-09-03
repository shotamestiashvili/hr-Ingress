<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->


            <div class="form-outline  mb-4">
              <label class="form-label" for="education"
                >Education</label
              >
              <input
                type="text"
                id="education"
                class="form-control"
                v-model="form.education"
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
        education: "",
      },
    };
  },
  methods: {
    clearFields() {
      this.form.education = "";

    },

    submitForm() {
      axios
        .post("api/references/educations", this.form)
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

