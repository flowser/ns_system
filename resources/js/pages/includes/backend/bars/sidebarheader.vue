<template>
    <!-- Brand Logo -->
    <router-link :to="{name: 'Dashboard'}" class="brand-link">
      <span class="brand-text font-weight-light">Notification System</span>
    </router-link>
</template>
    <script>
    export default {
        name:'backendsidebarheader',
        components:{
        },
        data(){
            return{
            };
        },
        mounted() {

        },
        computed:{
            Company(){
                // return this.$store.getters.Company
            },
        },
        methods:{
            Loadlogo(photo) {
              if (photo) {
                return "/themes/backend/adminlte/dist/img/" + photo;
                // return "/assets/img/" + photo;
              } else {
                return "/assets/img/empty.png";
              }
            },
        }
    }
    </script>

    <style>

    </style>
