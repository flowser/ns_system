<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{name: 'Dashboard'}" class="nav-link">Home</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
</template>
    <script>
    export default {
        name:'backendheader',
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
                return "/themes/frontend/assets/images/" + photo;
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
