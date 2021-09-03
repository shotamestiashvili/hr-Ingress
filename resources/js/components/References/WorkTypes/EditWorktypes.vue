<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- <div class="row"> -->

            <div class="form-outline mb-4" >
                 <label class="form-label" for="training">Code</label>
              <input type="text" id="code" class="form-control"  v-model="form.code"/>
            </div>
                        <div class="form-outline mb-4" >
                 <label class="form-label" for="code">Start</label>
              <input type="text" id="code" class="form-control"  v-model="form.start"/>
            </div>
                        <div class="form-outline mb-4" >
                 <label class="form-label" for="end">End</label>
              <input type="text" id="end" class="form-control"  v-model="form.end"/>
            </div>
                        <div class="form-outline mb-4" >
                 <label class="form-label" for="hours">Hours</label>
              <input type="text" id="hours" class="form-control"  v-model="form.hours"/>
            </div>


          <div class="form-group  mb-4">
            <button class="btn btn-primary">Submit Worktype</button>
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
        code: this.editing.code,
        start: this.editing.start,
        end: this.editing.end,
        hours: this.editing.hours,

      },
    };
  },
  methods: {
    submitForm() {
      axios
        .post("api/references/worktypes", this.form)
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
