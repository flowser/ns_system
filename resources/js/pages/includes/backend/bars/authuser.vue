<template>
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <router-link :to="$dashboard()" class="d-block">{{this.$authuser().full_name}}</router-link>
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
