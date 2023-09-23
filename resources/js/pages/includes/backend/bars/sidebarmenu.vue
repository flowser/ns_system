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
         <router-link :to="{name: 'Products Settings'}" class="nav-link">
           <i class="far fa-circle nav-icon"></i>
           <p>Products</p>
         </router-link>
       </li>
       <li class="nav-item">
         <router-link :to="{name: 'Portfolio Settings'}" class="nav-link">
           <i class="far fa-circle nav-icon"></i>
           <p>Portfolio</p>
         </router-link>
       </li>
       <li class="nav-item menu-closed">
         <a href="#" class="nav-link ">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
            Website Setup
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <router-link :to="{name: 'Header Settings'}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>Header</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link :to="{name: 'Footer Settings'}" class="nav-link ">
               <i class="far fa-circle nav-icon"></i>
               <p>Footer</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link :to="{name: 'Pages Settings'}" class="nav-link ">
               <i class="far fa-circle nav-icon"></i>
               <p>Pages</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link :to="{name: 'Appearance Settings'}" class="nav-link ">
               <i class="far fa-circle nav-icon"></i>
               <p>Appearance</p>
             </router-link>
           </li>
         </ul>
       </li>
       <li class="nav-item menu-closed">
         <a href="#" class="nav-link ">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
            Setup & Configuration
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <router-link :to="{name: 'General Settings'}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>General Settings</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link :to="{name: 'SMPT Settings'}" class="nav-link ">
               <i class="far fa-circle nav-icon"></i>
               <p>SMTP Settings</p>
             </router-link>
           </li>
         </ul>
       </li>
       <li class="nav-item menu-closed">
         <a href="#" class="nav-link ">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
            Staff
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <router-link :to="{name: 'All Staff'}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>All Staff</p>
             </router-link>
           </li>
           <li class="nav-item">
             <router-link :to="{name: 'Staff Permissions'}" class="nav-link ">
               <i class="far fa-circle nav-icon"></i>
               <p>Staff Permissions</p>
             </router-link>
           </li>
         </ul>
       </li>
       <li class="nav-item">
         <router-link :to="{name: 'Superadmin Settings'}" class="nav-link ">
           <i class="far fa-circle nav-icon"></i>
           <p>Superadmin</p>
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
