<template>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
    </template>
        <script>
        export default {
            name:'backendsidebarsearch',
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
    