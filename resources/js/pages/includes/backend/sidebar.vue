<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <Sidebarheader/>
    <!-- Sidebar -->
    <div class="sidebar">
      <Authuser/>
      <Sidebarsearch/>
      <Sidebarmenu/>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
    <script>
    import Sidebarheader from './bars/sidebarheader.vue';
    import Authuser from './bars/authuser.vue';
    import Sidebarsearch from './bars/sidebarsearch.vue';
    import Sidebarmenu from './bars/sidebarmenu.vue';
    export default {
        name:'sidebar',
        components:{
            Sidebarheader,
            Authuser,
            Sidebarsearch,
            Sidebarmenu,
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
