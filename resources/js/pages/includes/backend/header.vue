<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 text-sm">
     <Leftbar/>
     <Rightbar/>
  </nav>
</template>
    <script>
    import Leftbar from './header/leftnavbar.vue';
    import Rightbar from './header/rightnavbar.vue';
    export default {
        name:'backendheader',
        components:{
            Leftbar,
            Rightbar,
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
