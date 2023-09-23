<template>
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
    </template>
        <script>
        export default {
            name:'backendsidebaruser',
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
