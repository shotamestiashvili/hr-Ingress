<template>
  <div>
    <b-container class="bv-hr-row bv-hr-row-flex-cols">
      <b-row class="justify-text-xs-center">
        <b-col align-self="center" cols="24">
          <navbar-app> </navbar-app>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Navbar from "./Navbar/Navbar.vue";
export default {
  components: {
    navbarApp: Navbar,
  },
};
</script>


