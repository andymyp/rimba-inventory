<script setup>
import Navbar from "./components/Navbar.vue";
</script>

<template>
  <div>
    <Navbar />
    <div class="container mt-5">
      <router-view></router-view>
    </div>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
