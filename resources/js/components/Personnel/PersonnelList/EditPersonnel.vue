<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <div class="row">

         <div class="form-outline">
              <input type="text" id="userid" class="form-control" v-model="form.userid" />
              <label class="form-label" for="userid">User ID</label>
            </div>

         <div class="form-outline">
              <input type="text" id="first_name" class="form-control" v-model="form.first_name" />
              <label class="form-label" for="first_name">First name</label>
            </div>

            <div class="form-outline">
              <input type="text" id="last_name" class="form-control"  v-model="form.last_name"/>
              <label class="form-label" for="last_name">Last name</label>
            </div>

            <div class="form-outline">
              <input type="number" id="personal_id" class="form-control" v-model="form.personal_id"/>
              <label class="form-label" for="personal_id">Personal ID</label>
            </div>

            <div class="form-outline">
              <input type="date" id="birth_day" class="form-control" v-model="form.birth_day"/>
              <label class="form-label" for="birth_day">Birth Day</label>
            </div>

            <div class="form-outline">
              <input type="text" id="gender" class="form-control" v-model="form.gender"/>
              <label class="form-label" for="gender">Gender</label>
            </div>

            <div class="form-outline">
              <input type="text" id="address" class="form-control" v-model="form.address"/>
              <label class="form-label" for="address">Address</label>
            </div>

            <div class="form-outline">
              <input type="text" id="retirement" class="form-control" v-model="form.retirement"/>
              <label class="form-label" for="retirement">Retirement</label>
            </div>

            <div class="form-outline">
              <input type="text" id="family_status" class="form-control" v-model="form.family_status"/>
              <label class="form-label" for="family_status"
                >Family Status</label
              >
            </div>

            <div class="form-outline">
              <input type="text" id="education" class="form-control" v-model="form.education"/>
              <label class="form-label" for="education">Education</label>
            </div>
          </div>

          <!-- Text input -->
          <div class="form-outline mb-4">
            <input type="text" id="contact_info" class="form-control" v-model="form.contact_info"/>
            <label class="form-label" for="contact_info">Contact Info</label>
          </div>

          <!-- Text input -->
          <div class="form-outline mb-4">
            <input type="text" id="position" class="form-control" v-model="form.position"/>
            <label class="form-label" for="position">Position</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="department" class="form-control" v-model="form.department"/>
            <label class="form-label" for="department">Department</label>
          </div>

          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="head" class="form-control" v-model="form.head"/>
            <label class="form-label" for="head">Head</label>
          </div>

          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="subordinate_stuff" class="form-control" v-model="form.subordinate_stuff"/>
            <label class="form-label" for="subordinate_stuff"
              >Subordinate Stuff</label
            >
          </div>
          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="military_info" class="form-control" v-model="form.military_info"/>
            <label class="form-label" for="military_info">Military Info</label>
          </div>
          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="phone" id="phone" class="form-control" v-model="form.phone"/>
            <label class="form-label" for="phone">Phone</label>
          </div>
          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="email" id="email" class="form-control" v-model="form.email"/>
            <label class="form-label" for="email">Email</label>
          </div>
                    <div class="form-outline mb-4">
            <input type="text" id="author" class="form-control" v-model="form.author"/>
            <label class="form-label" for="author">Author</label>
          </div>

          <div class="form-group  mb-4">
            <button class="btn btn-primary">Update Update</button>
          <!-- </div> -->
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {

  props: ["editing"],

  data() {
    return {
      form: {
                id: this.editing.id,
                userid: this.editing.userid,
                first_name: this.editing.first_name,
                last_name: this.editing.last_name,
                personal_id: this.editing.personal_id,
                birth_day: this.editing.birth_day,
                gender: this.editing.gender,
                address: this.editing.address,
                retirement: this.editing.retirement,
                family_status: this.editing.family_status,
                education: this.editing.education,
                contact_info: this.editing.contact_info,
                position: this.editing.position,
                department: this.editing.department,
                head: this.editing.head,
                subordinate_stuff: this.editing.subordinate_stuff,
                military_info: this.editing.military_info,
                phone: this.editing.phone,
                email: this.editing.email,
                author: this.editing.author,
      },
    };
  },

  methods: {
    submitForm() {
      axios
        .post('api/personnel/personnellist', this.form)
        .then((res) => {
          this.$emit("exit", true);
          console.log(this.form.userid)
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {});
    },
  },
};
</script>
