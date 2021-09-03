<template>
  <div>
    <form @submit.prevent="submitDate">
      <vc-date-picker
       v-model="range"
       mode="dateTime"
       is24hr
       is-range
       :attributes="attributes">

      </vc-date-picker>

      <div>
        <b-button type="submit" class="btn btn-info"> Submit </b-button>
      </div>
    </form>

    <p v-if="dates.start">
        Day:  {{ dates.start.getDate() }}
        Hour: {{ dates.start.getHours() }}
        Minutes: {{ dates.start.getMinutes() }}
    </p>
    <p v-if="dates.end">
        Day:  {{ dates.end.getDate() }}
        Hour: {{ dates.end.getHours() }}
        Minutes: {{ dates.end.getMinutes() }}
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      range: {
        key: "today",
        highlight: 'red',
        start: new Date(),
        end: new Date(),
      },

      attributes: [
      // This is a single attribute
      {
        highlight: true,  // Boolean, String, Object
        dot: true,        // Boolean, String, Object
        bar: true,        // Boolean, String, Object
        content: 'red',   // Boolean, String, Object
      }
    ],

      dates: {
        start: "",
        end: "",
      },
    };
  },
  methods: {
    submitDate() {
      (this.dates.start = this.range.start), (this.dates.end = this.range.end);
      this.$emit('submitedDate', this.dates)
    },
  },
};
</script>



