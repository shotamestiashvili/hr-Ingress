<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->

          <div class="form-outline mb-4">
            <label class="form-label" for="training">Code</label>
            <input
              type="text"
              id="code"
              class="form-control"
              v-model="form.code"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="start">Start</label>
            <input
              type="time"
              id="start"
              class="form-control"
              v-model="form.start"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="end">End</label>
            <input
              type="time"
              id="end"
              class="form-control"
              v-model="form.end"
            />
          </div>
          <div class="form-outline mb-4">
            <label class="form-label" for="hours">Hours</label>
            <input
              type="text"
              id="hours"
              class="form-control"
              v-model="form.hours"
            />
          </div>

          <button type="submit" class="btn btn-info">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import axios from "axios";

export default {
  name: "PostFormAxios",

  data() {
    return {
      form: {
        code: "",
        start: "",
        end: "",
        hours: "",
      },
    };
  },

  mounted() {},

  filters: {},

   computed: {
    end() {
      return this.form.end;
    }
  },

  watch: {
    end() {
        var end = moment(this.form.end, "HH:mm:ss");
        var start = moment(this.form.start, "HH:mm:ss");
        var duration = moment.duration(end.diff(start));
        var hours = duration.hours();
        var minutes = duration.minutes();
        this.form.hours =  minutes
    },
  },


  methods: {
    submitForm() {
      axios
        .post("api/references/worktypes", this.form)
        .then((res) => {
          this.$emit("exit");
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

