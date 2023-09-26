<template>
   <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <li class="nav-item">
         <router-link :to="{name: 'Dashboard'}" class="nav-link">
           <i class="far fa-circle nav-icon"></i>
           <p>Dashboard</p>
         </router-link>
       </li>
       <li class="nav-item">
         <router-link :to="{name: 'Messages'}" class="nav-link">
           <i class="far fa-comments nav-icon"></i>
           <p>Messages</p>
         </router-link>
       </li>
       <li class="nav-item">
         <router-link :to="{name: 'Notifications'}" class="nav-link">
           <i class="far fa-comments nav-icon"></i>
           <p>Notifications</p>
         </router-link>
       </li>
     </ul>
   </nav>
</template>
    <script>
    export default {
        name:'backendsidebarmenu',
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
