<template>
  <div id="app">
    <CGHeader />
    <router-view />
    <CGFooter />
  </div>
</template>

<script>
import CGHeader from "./components/CGHeader";
import CGFooter from "./components/CGFooter";

export default {
  components: { CGHeader, CGFooter }
};
</script>
<style lang="scss">
@import "./assets/app.scss";
</style>
