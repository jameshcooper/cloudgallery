<template>
  <b-card-group columns class="mt-2">
    <b-card
      v-for="a in album"
      :key="a.name"
      :img-src="a.path.medium"
      img-fluid
      no-body
    ></b-card>
  </b-card-group>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["album"])
  }
};
</script>

<style scoped>
.card-columns {
  column-gap: 0.5rem;
}
.card-columns .card {
  margin-bottom: 0.5rem;
}
</style>
