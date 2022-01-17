<template>
  <v-app>
    <v-app-bar color="white" app>
        <v-toolbar-title>Exam</v-toolbar-title>

      <v-spacer />

    </v-app-bar>

    <v-main>
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
