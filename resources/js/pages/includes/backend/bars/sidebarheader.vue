<template>
    <!-- Brand Logo -->
    <router-link :to="{name: 'Dashboard'}" class="brand-link">
      <img :src="Loadlogo('AdminLTELogo.png')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
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
