<template>
  <div>
    <div class="home">
      <Navbar />
      <Landing />
    </div>
  </div>
</template>

<script>
import Landing from "../components/Landing.vue";
import Navbar from "../components/Navbar.vue";

export default {
  name: "Home",
  components: {
    Navbar,
    Landing,
  },
};
</script>

<style lang="scss" scoped>
.home {
  height: 100vh;
}
</style>
