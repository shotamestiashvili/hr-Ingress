<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="card">
          <div class="card-header">
            <strong> Personnel</strong>
          </div>
          <div class="card-body">
            <table class="table table-sm table-bordered">
              <thead>

                    <tr>
                  <th >UserID</th>
                  <th >First Name</th>
                  <th >Last Name</th>
                  <th >Personal ID</th>
                    </tr>

                    <tr>
                  <th >Birth Day</th>
                  <th >Gender</th>
                  <th >Address</th>
                  <th >Retirement</th>
                    </tr>

                    <tr>
                  <th >Family Status</th>
                  <th >Education</th>
                  <th >Contact Info</th>
                  <th >Position</th>
                    </tr>

                    <tr>
                  <th >Department</th>
                  <th >Head</th>
                  <th >Subordinate Stuff</th>
                  <th >Military Info</th>
                    </tr>
                    <tr>
                  <th >Phone</th>
                  <th >Email</th>
                  <th >Registration Date</th>
                  <th >Author</th>
                    </tr>


              </thead>
              <tbody>
                <tr>
                  <td>{{ showing.userid }}</td>
                  <td>{{ showing.first_name }}</td>
                  <td>{{ showing.last_name }}</td>
                  <td>{{ showing.personal_id }}</td>
                </tr>

                <tr>
                  <td>{{ showing.birth_day }}</td>
                  <td>{{ showing.gender }}</td>
                  <td>{{ showing.address }}</td>
                  <td>{{ showing.retirement }}</td>
                </tr>

                <tr>
                  <td>{{ showing.family_status }}</td>
                  <td>{{ showing.education }}</td>
                  <td>{{ showing.contact_info }}</td>
                  <td>{{ showing.position }}</td>
                </tr>

                <tr>

                  <td>{{ showing.department }}</td>
                  <td>{{ showing.head }}</td>
                  <td>{{ showing.subordinate_stuff }}</td>
                  <td>{{ showing.military_info }}</td>
                </tr>

                <tr>
                  <td>{{ showing.phone }}</td>
                  <td>{{ showing.email }}</td>
                  <td>{{ showing.registration_date }}</td>
                  <td> </td>
                </tr>
              </tbody>
            </table>
          </div>
          </div>
        </div>
    </div>

</template>

<script>
export default {
  props: ["showing"],

  components: {},

  data() {
    return {
      form: {

        id: this.showing.userid,
        first_name: this.showing.first_name,
        last_name: this.showing.last_name,
        personal_id: this.showing.personal_id,
        birth_day: this.showing.birth_day,
        gender: this.showing.gender,
        address: this.showing.address,
        retirement: this.showing.retirement,
        family_status: this.showing.family_status,
        education: this.showing.education,
        contact_info: this.showing.contact_info,
        position: this.showing.position,
        department: this.showing.department,
        head: this.showing.head,
        subordinate_stuff: this.showing.subordinate_stuff,
        military_info: this.showing.military_info,
        phone: this.showing.phone,
        email: this.showing.email,

      },
    };
  },

  methods: {
    closeModal() {
      this.$emit("exit", true);
    },
  },
};
</script>

<style scoped>
body {
  font-size: 7px sans-serif;
}
/* table {
  background: white;
  color: #fff;
  width: 65%;
  border-collapse: separate;
  border: 2px solid black;
} */
td {

  font-size: 7px;
  text-align: center;
}
th {
  background: white;
  color: black;
  font-size: 7px;
  text-align: center;
}

</style>
