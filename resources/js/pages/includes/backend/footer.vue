<template>
    <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Dreaming Big
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <router-link :to="{name: 'Dashboard'}" >Testing My Dream. Ltd.</router-link>.</strong> All rights reserved.
  </footer>
</template>
    <script>
    export default {
        name:'backendfooter',
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
