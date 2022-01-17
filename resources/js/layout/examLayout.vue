<template>
  <v-app>
    <v-app-bar color="white" app>
        <v-toolbar-title>Technical Task</v-toolbar-title>

      <v-spacer />

    </v-app-bar>

    <v-main class="mt-10">
      <!-- Content-->
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "examLayout",
    data() {
    return {};
  },
};
</script>

<style scoped>
</style>
