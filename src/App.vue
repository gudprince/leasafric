<template>
  <v-app>
    <!-- Sizes your content based upon application components -->
    <div>

      <!-- Provides the application the proper gutter -->
      <!-- <v-container fluid> -->
        <!-- If using vue-router -->
        <router-view></router-view>
      <!-- </v-container> -->
    </div>
  </v-app>
</template>

<script>

export default {
  name: 'App',
  data: () => ({
    //
  }),
};
</script>
