<template>
  <div>
    <b-navbar type="dark" variant="info">
      <b-navbar-nav>

        <b-nav-item-dropdown text="Main" right>
          <b-dropdown-item @click.prevent="createPersonnel">Main</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown text="Contracts" right>
          <b-dropdown-item @click.prevent="createContracts">Contracts </b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown text="Trainings" right>
          <b-dropdown-item @click.prevent="createTrainings">Trainings</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown text="Thanks" right>
           <b-dropdown-item @click.prevent="createThanks">Thanks</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown text="Documents" right>
          <b-dropdown-item @click.prevent="createDocuments">Documents</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item href="#">Exit</b-nav-item>

      </b-navbar-nav>
    </b-navbar>

    <div>
      <component :is="selectedComponent"> </component>
    </div>

  </div>
</template>

<script>
import CreatePersonnel from "../CreatePersonnel.vue";
import CreateContracts from "../CreateContracts.vue";
import CreateDocuments from "../CreateDocuments.vue";
import CreateThanks from "../CreateThanks.vue";
import CreateTrainings from "../CreateTrainings.vue";

export default {

    components: {
    createPersonnel: CreatePersonnel,
    createContracts: CreateContracts,
    createDocuments: CreateDocuments,
    createThanks:    CreateThanks,
    createTrainings: CreateTrainings,
  },

  data() {
    return {
      selectedComponent: ''
    };
  },


  methods: {
    createPersonnel() {
      this.selectedComponent = 'createPersonnel';
    },
    createContracts() {
      this.selectedComponent = 'createContracts';
    },
    createDocuments() {
      this.selectedComponent = 'createDocuments';
    },

    createThanks() {
      this.selectedComponent = 'createThanks';
    },

    createTrainings() {
      this.selectedComponent = 'createTrainings';
    },
  },
};
</script>
