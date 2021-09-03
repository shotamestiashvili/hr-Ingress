<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="well">
              <div class="card">
                <div class="card-header">
                  <div class="card-body">
                    <hr />
                    <h6>
                      {{ schedule.data.first_name }} {{ " " }}
                      {{ schedule.data.last_name }} {{ " " }}
                      {{ this.schedule.index }} / {{ this.selectedMonth }}
                      {{ this.selectedYear }}
                    </h6>
                    <hr />

                    <fieldset class="form-group">
                      <div class="row">
                        <div class="col-sm-10">
                          <div
                            class="form-check"
                            v-for="absence in apiAbsence"
                            :key="absence.id"
                          >
                            <input
                              v-bind:value="absence.name"
                              class="form-check-input"
                              type="radio"
                              name="gridRadios"
                              id="gridRadios1"
                              checked
                              v-model="form.selectedAbsence"
                            />
                            <label class="form-check-label" for="gridRadios1">
                              {{ absence.name }}
                            </label>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="well">
              <div class="card">
                <div class="card-header">
                  <div class="card-body">
                    <h6>Select Position</h6>
                    <hr />
                    <div class="form-group form-control-sm">
                      <select v-model="form.selectedPosition">
                        <option value="">Position</option>
                        <option
                          v-for="position in apiPosition"
                          v-bind:key="position"
                          v-bind:value="position.code"
                        >
                          {{ position.code }}
                        </option>
                      </select>
                    </div>

                    {{ form.selectedPosition }}
                    <br />
                    <h6>Select Work Type</h6>
                    <hr />
                    <div class="form-group form-control-sm">
                      <select v-model="form.selectedWorktype">
                        <option value="">Work Type</option>
                        <option
                          v-for="worktype in apiWorktype"
                          v-bind:key="worktype"
                          v-bind:value="worktype.code"
                        >
                          {{ worktype.code }}
                        </option>
                      </select>
                    </div>

                    {{ form.selectedWorktype }}

                    <hr />

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="honorableminutes">
                        Min</span
                      >
                      <input
                        type="time"
                        class="form-control"
                        placeholder="Honorable minutes"
                        aria-label="Min"
                        aria-describedby="basic-addon1"
                        v-model="form.honorMinutes"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button
        type="button"
        class="btn btn-info"
        @click.prevent="submitSchedule()"
      >
        Submit
      </button>
      <button
        type="button"
        class="btn btn-danger"
        @click.prevent="closeModal()"
      >
        Cancel
      </button>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import axios from "axios";

export default {
  components: {
    "v-select": vSelect,
  },

  props: ["schedule", "selectedYear", "selectedMonth"],

  data() {
    return {
      selected: "",
      apiPosition: "",
      apiWorktype: "",
      apiAbsence: "",
      position: [],
      worktype: [],
      selectedPosition: "",
      selectedWorktype: "",
      minutes: "00:00",
      comp: 'comp',
      form: {
        userid: this.schedule.data.userid,
        selectedDay: this.schedule.index,
        selectedMonth: this.selectedMonth,
        selectedYear: this.selectedYear,
        selectedAbsence: "",
        selectedPosition: "",
        selectedWorktype: "",
        honorMinutes: "",
      },
    };
  },

  mounted() {
    this.runAxiosWorktype();
    this.runAxiosPosition();
    this.runAxiosAbsence();
  },

  computed: {},

  methods: {
    closeModal() {
      this.$emit("exit", true);
    },

    runAxiosPosition() {
      axios
        .get("api/references/positions")
        .then((res) => {
          this.apiPosition = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    runAxiosAbsence() {
      axios
        .get("api/references/absences")
        .then((res) => {
          this.apiAbsence = res.data.data;
          console.log(res);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    runAxiosWorktype() {
      axios
        .get("api/references/worktypes/", {
          params: {
              search: 'comp',
          },
        })
        .then((res) => {
          this.apiWorktype = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    submitSchedule() {
      axios
        .post("api/personnel/schedules", this.form)
        .then((res) => {
          this.$emit("exit", true);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          console.log(this.form);
        });
    },
  },
};
</script>
