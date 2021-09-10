<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="container">
                          <center>
                <img
                  class="center"
                  height="130px"
                  width="auto"
                  :src="showing.avatar_url"
                  alt="Profile Photo"
                />
              </center>
          <h1 class="well"></h1>
          <div class="col-lg-12 well">
            <div class="row">
              <!-- THIS SECTION IS FOR ERRORS THAT WOULD COME FROM API -->
            </div>
            <hr>

            <br>
            <hr>

            <div class="col-sm-12">
              <div class="row"></div>
              <table class="table table-sm table-bordered">
                <thead>

                </thead>
                <tbody>
                  <hr />
                  <tr>
                    <th>UserID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Personal ID</th>
                  </tr>
                  <tr>
                    <td>{{ showing.userid }}</td>
                    <td>{{ showing.first_name }}</td>
                    <td>{{ showing.last_name }}</td>
                    <td>{{ showing.personal_id }}</td>
                  </tr>
                  <hr />
                  <br />
                  <hr />
                  <tr>
                    <th>Birth Day</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Retirement</th>
                  </tr>

                  <tr>
                    <td>{{ showing.birth_day }}</td>
                    <td>{{ showing.gender }}</td>
                    <td>{{ showing.address }}</td>
                    <td>{{ showing.retirement }}</td>
                  </tr>
                  <hr />
                  <br />
                  <hr />
                  <tr>
                    <th>Family Status</th>
                    <th>Education</th>
                    <th>Contact Info</th>
                    <th>Position</th>
                  </tr>
                  <tr>
                    <td>{{ showing.family_status }}</td>
                    <td>{{ showing.education }}</td>
                    <td>{{ showing.contact_info }}</td>
                    <td>{{ showing.position }}</td>
                  </tr>
                  <hr />
                  <br />
                  <hr />
                  <tr>
                    <th>Department</th>
                    <th>Head</th>
                    <th>Subordinate Stuff</th>
                    <th>Military Info</th>
                  </tr>
                  <tr>
                    <td>{{ showing.department }}</td>
                    <td>{{ showing.head }}</td>
                    <td>{{ showing.subordinate_stuff }}</td>
                    <td>{{ showing.military_info }}</td>
                  </tr>
                  <hr />
                  <br />
                  <hr />
                  <tr>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Author</th>
                  </tr>
                  <tr>
                    <td>{{ showing.phone }}</td>
                    <td>{{ showing.email }}</td>
                    <td>{{ showing.registration_date }}</td>
                    <td></td>
                  </tr>
                  <hr />
                  <br />
                  <hr />
                </tbody>
              </table>
            </div>
          </div>
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
.imagePreviewWrapper {
  width: 250px;
  height: 250px;
  display: block;
  cursor: pointer;
  margin: 0 auto 30px;
  background-size: cover;
  background-position: center center;
}
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
</style>
