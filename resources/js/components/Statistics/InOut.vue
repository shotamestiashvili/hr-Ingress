<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-14">
        <div class="card">
          <div class="card-header">
            <strong> In /Out Statistics </strong>
          </div>
          <div class="card-body">
            <div class="w-100 p-3" style="background-color: #eee">
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Personnel</th>
                    <th scope="col">Department</th>
                    <th scope="col">Date</th>
                    <th scope="col">In Time</th>
                    <th scope="col">Break Started</th>
                    <th scope="col">Break Ended</th>
                    <th scope="col">Out Time</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Honorary Minutes</th>
                    <th scope="col">Delay (min)</th>
                    <th scope="col">Unexcusable (min)</th>
                    <th scope="col">Overtime</th>
                  </tr>
                </thead>
                <tbody v-for="inout in inouts.data" :key="inout.useid">
                  <tr>
                    <th scope="row">{{ inout.userid }}</th>
                    <td>Operation</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="inouts" @pagination-change-page="getResults">
              </pagination>
            </div>
           <p v-for="user in users.data" :key="user.useid">  {{user}} </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";

export default {
  components: {
    pagination,
  },

  data() {
    return {
      inouts: {},
      users: [],
    };
  },

  mounted() {
    // Fetch initial results
    this.getResults();
    this.getUsers();
  },

  methods: {

    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get("api/inout?page=" + page).then((response) => {
        this.inouts = response.data;
      });
    },

    getUsers() {
        axios.get("api/inout?page=" + page).then((response) => {
        this.users.push(responce.data.userid)
      });
    },
  },
};
</script>

<style scoped>
.pagination {
  margin-bottom: 0;
}
</style>

