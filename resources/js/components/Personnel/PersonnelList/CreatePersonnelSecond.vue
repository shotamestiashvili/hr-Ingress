<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="container">
          <h1 class="well">Registration Form</h1>
          <div class="col-lg-12 well">
            <div class="row">
              <!-- THIS SECTION IS FOR ERRORS THAT WOULD COME FROM API -->
              <div v-if="errors">
                <div
                  v-for="error in errors"
                  class="alert alert-danger"
                  :key="error"
                >
                  {{ error }}
                </div>
              </div>

              <!-- FORM WITH v-if WILL BE SHOWN BUT THEN HIDDEN AFTER SUCCESS SUBMIT -->
              <form v-if="showForm">
                <div class="custom-file">
                  <!-- MOST IMPORTANT - SEE "ref" AND "@change" PROPERTIES -->
                  <input
                    type="file"
                    class="custom-file-input"
                    id="customFile"
                    ref="file"
                    @change="handleFileObject()"
                  />
                  <label class="custom-file-label text-left" for="customFile">{{
                    avatarName
                  }}</label>
                </div>
                <br />

                <button
                  @click.prevent="submit"
                  type="submit"
                  class="btn btn-primary"
                  style="background: #42b983"
                >
                  Upload
                </button>
                <hr />
              </form>

              <div v-if="user">
                <div class="alert alert-success">Photo Uploaded</div>
                <div>
                  <img
                    height="100px"
                    width="auto"
                    :src="user.avatar_url"
                    alt=""
                  />
                </div>
              </div>

              <form v-on:submit.prevent="submitForm">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-6 form-group">
                      <label>First Name</label>
                      <input
                        type="text"
                        placeholder="Enter First Name Here.."
                        class="form-control"
                        v-model="form.first_name"
                      />
                    </div>
                    <div class="col-sm-6 form-group">
                      <label>Last Name</label>
                      <input
                        type="text"
                        placeholder="Enter Last Name Here.."
                        class="form-control"
                        v-model="form.last_name"
                      />
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <textarea
                      placeholder="Enter Address Here.."
                      rows="3"
                      class="form-control"
                      v-model="form.address"
                    ></textarea>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 form-group">
                      <label>Company ID</label>
                      <input
                        type="text"
                        placeholder="Company ID"
                        class="form-control"
                        v-model="form.companyid"
                      />
                    </div>

                    <div class="col-sm-4 form-group">
                      <label>UserID</label>
                      <input
                        type="text"
                        placeholder="Userid"
                        class="form-control"
                        v-model="form.userid"
                      />
                    </div>
                    <div class="col-sm-4 form-group">
                      <label>Personal ID</label>
                      <input
                        type="text"
                        placeholder="Personal ID"
                        class="form-control"
                        v-model="form.personal_id"
                      />
                    </div>
                  </div>
                  <br />
                  <div class="row">
                    <div class="col-sm-4 form-group">
                      <label>Gender Status</label>
                      <hr />
                      <select
                        class="form-select"
                        v-model="form.gender"
                        aria-label=".form-select-sm example"
                      >
                        <option selected>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>

                    <div class="col-sm-4 form-group">
                      <label>Family Status</label>
                      <hr />

                      <select v-model="form.family_status">
                        <option
                          v-for="family in familyData"
                          v-bind:key="family"
                          v-bind:value="family.id"
                        >
                          {{ family.family_status }}
                        </option>
                      </select>
                    </div>

                    <div class="col-sm-4 form-group">
                      <label for="example-datepicker">Date of Birth</label>
                      <hr />
                      <b-form-datepicker
                        id="example-datepicker"
                        v-model="form.birth_day"
                        class="mb-2"
                      ></b-form-datepicker>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4 form-group">
                      <label>Education</label>
                      <hr />
                      <select v-model="form.education">
                        <option
                          v-for="education in educationApi"
                          v-bind:key="education"
                          v-bind:value="education.id"
                        >
                          {{ education.education }}
                        </option>
                      </select>
                    </div>

                    <div class="col-sm-4 form-group">
                      <label>Position</label>
                      <hr />
                      <select v-model="form.position">
                        <option
                          v-for="position in positionApi"
                          v-bind:key="position.id"
                          v-bind:value="position.id"
                        >
                          {{ position.position_name }}
                        </option>
                      </select>
                    </div>

                    <div class="col-sm-4 form-group">
                      <label>Department</label>
                      <hr />
                      <select v-model="form.department">
                        <option
                          v-for="department in departmentApi"
                          v-bind:key="department.di"
                          v-bind:value="department.id"
                        >
                          {{ department.department }}
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6 form-group">
                      <label> Contact Info</label>
                      <input
                        type="text"
                        placeholder="Contact Info.."
                        class="form-control"
                        v-model="form.contact_info"
                      />
                    </div>
                    <div class="col-sm-6 form-group">
                      <label>Bank Account</label>
                      <input
                        type="text"
                        placeholder="Enter Company Name Here.."
                        class="form-control"
                        v-model="form.bank_account"
                      />
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Pohne Number</label>
                    <input
                      type="text"
                      placeholder="Enter Phone Number Here.."
                      class="form-control"
                      v-model="form.phone"
                    />
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input
                      type="text"
                      placeholder="Enter Email Address Here.."
                      class="form-control"
                      v-model="form.email"
                    />
                  </div>
                  <div class="form-group">
                    <label>Additional Infor</label>
                    <input
                      type="text"
                      placeholder="Enter Website Name Here.."
                      class="form-control"
                      v-model="form.additional"
                    />
                  </div>

                  <div class="row">
                    <div class="col-sm-4 form-group">
                      <label>Insuarence</label>
                      <hr />
                      <input
                        type="text"
                        placeholder="Insuarence"
                        class="form-control"
                        v-model="form.ensuarence"
                      />
                    </div>

                    <div class="col-sm-4 form-group form-check">
                      <label class="form-check-label" for="food"
                        >Food Subsidy</label
                      >
                      <hr />

                      <div class="form-check">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="food"
                          v-model="form.food"
                          value="true"
                        />
                      </div>
                    </div>

                    <div class="col-sm-4 form-group form-check">
                      <label class="form-check-label" for="union"
                        >Member of Union</label
                      >
                      <hr />

                      <div class="form-check">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="union"
                          v-model="form.subordinate_stuff"
                          value="true"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-lg btn-info">
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        name: null,
        email: "test@test.ge",
      },
      avatar: null,
      avatarName: "Avatar",
      showForm: true,
      user: null,
      errors: null,
      previewImage: null,

      familyData: "",
      educationData: "",
      positionData: "",
      departmentData: "",

      form: {
        userid: "",
        first_name: "",
        last_name: "",
        personal_id: "",
        birth_day: "",
        gender: "",
        address: "",
        companyid: "",
        retirement: "",
        family_status: "",
        education: "",
        contact_info: "",
        position: "",
        department: "",
        head: "",
        subordinate_stuff: "",
        military_info: "",
        phone: "",
        email: "",
        author: "",
        food: "",
        ensuarence: "",
        additional: "",
        bank_account: "",
        avatar_url: "",
      },
    };
  },

  mounted() {
    this.familyApi();
    this.departmentApi();
    this.positionApi();
    this.educationApi();
  },

  watch: {
    submit() {
      this.form.avatar_url = this.$store.state.avatar_url;
    },
  },

  methods: {
    submit() {
      this.errors = null;
      let formData = new FormData();

      formData.append("avatar", this.avatar);

      _.each(this.formData, (value, key) => {
        formData.append(key, value);
      });

      axios
        .post("api/upload", formData, {
          headers: {
            "Content-Type":
              "multipart/form-data; charset=utf-8; boundary=" +
              Math.random().toString().substr(2),
          },
        })
        .then((response) => {
          this.showForm = false;
          this.user = response.data.data;
          this.form.avatar_url = response.data.data.avatar;
          console.log(response.data.data.avatar_url);
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.errors = [];
            _.each(err.response.data.errors, (error) => {
              _.each(error, (e) => {
                this.errors.push(e);
              });
            });
          }
        });
    },

    handleFileObject() {
      this.avatar = this.$refs.file.files[0];
      this.avatarName = this.avatar.name;
    },

    submitForm() {
      axios
        .post("api/personnel/personnellist", this.form)
        .then((res) => {
          this.$emit("exit", true);
          console.log(res);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    familyApi() {
      axios
        .get("/api/references/family")
        .then((res) => {
          this.familyData = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    educationApi() {
      axios
        .get("/api/references/educations")
        .then((res) => {
          this.educationApi = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    positionApi() {
      axios
        .get("/api/references/positions")
        .then((res) => {
          this.positionApi = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },

    departmentApi() {
      axios
        .get("/api/references/departments")
        .then((res) => {
          this.departmentApi = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
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
