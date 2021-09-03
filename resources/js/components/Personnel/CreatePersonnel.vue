<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <form v-on:submit.prevent="submitForm">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row">

         <div class="form-outline">
              <input type="text" id="firstname" class="form-control" v-model="form.firstname" />
              <label class="form-label" for="firstname">First name</label>
            </div>

            <div class="form-outline">
              <input type="text" id="lastname" class="form-control"  v-model="form.lastname"/>
              <label class="form-label" for="lastname">Last name</label>
            </div>

            <div class="form-outline">
              <input type="number" id="personalid" class="form-control" v-model="form.personalid"/>
              <label class="form-label" for="personalid">Personal ID</label>
            </div>

            <div class="form-outline">
              <input type="date" id="birthday" class="form-control" v-model="form.birthday"/>
              <label class="form-label" for="birthday">Birth Day</label>
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
              <input type="text" id="familystatus" class="form-control" v-model="form.familystatus"/>
              <label class="form-label" for="familystatus"
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
            <input type="text" id="contactinfo" class="form-control" v-model="form.contactinfo"/>
            <label class="form-label" for="contactinfo">Contact Info</label>
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
            <input type="text" id="subordinate" class="form-control" v-model="form.subordinate"/>
            <label class="form-label" for="subordinate"
              >Subordinate Stuff</label
            >
          </div>
          <!-- Number input -->
          <div class="form-outline mb-4">
            <input type="text" id="military" class="form-control" v-model="form.military"/>
            <label class="form-label" for="military">Military Info</label>
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

          <!-- Message input -->
          <div class="form-outline mb-4">
            <textarea
              class="form-control"
              id="additional"
              rows="4"
              v-model="form.additional"
            ></textarea>
            <label class="form-label" for="additional"
              >Additional information</label
            >
          </div>


          <!-- Submit button -->
          <!-- <button type="submit" class="btn btn-primary btn-block mb-4">
            Place order
          </button> -->
          <div class="form-group">
                    <button class="btn btn-primary">Submit</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PostFormAxios',

    data(){
        return{
            form: {
                userid: '123',
                firstname: '',
                lastname: '',
                personalid: '',
                birthday: '',
                gender: '',
                address: '',
                retirement: '',
                familystatus: '',
                education: '',
                contactinfo: '',
                position: '',
                department: '',
                head: '',
                subordinate: '',
                military: '',
                phone: '',
                email: '',
                additional: '',
                registration: 'today',
                author: 'Shota Mestiashvili'

            }
        }
    },
    methods:{
        submitForm(){
            axios.post('api/personnel/createpersonnel', this.form)
                 .then((res) => {
                     this.$emit('exit', true)
                     console.log('works')
                 })
                 .catch((error) => {

                 }).finally(() => {

                 });
        }
    }
}
</script>

