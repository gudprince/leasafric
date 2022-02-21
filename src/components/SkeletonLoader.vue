<template>
    <v-sheet
        :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
        class="pa-3"
    >
        <v-skeleton-loader
           
            type="card-avatar"
            >
        </v-skeleton-loader>
    </v-sheet>
</template>

<script>
  export default {
    // Vuetify components provide
    // a theme variable that is
    // used to determine dark
    inject: {
      theme: {
        default: { isDark: false },
      },
    },
  }
</script>