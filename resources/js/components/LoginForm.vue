<template>

<div>

<hr>
<form>

<input v-model="username" placeholder="Username">

<login-screen user ="შოთა მესტიაშვილი" @myAge="myAge = $event" >
<h2> this is for slot</h2>
<h3> this is for slot also </h3>
</login-screen>

</form>
<hr>
<br>
{{ username  }}
<br>

<hr>
{{myAge}}
<hr>

</div>

</template>

<script>
import LoginScreen from './LoginScreen.vue';
import { eventBus } from '../app';

export default
{
components: { LoginScreen, },

data () {
    return {
        username: this.username,
        myAge: '31'
    }
  },

  created(){
      eventBus.$on('myAge', (data) => {this.myAge = data})
  }

}

</script>
