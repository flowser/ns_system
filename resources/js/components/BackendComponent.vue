<template>
<!-- Navbar -->
  <Backendheader/>
  <!-- /.navbar -->
  <Backendsidebar/>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 381.009px;">
    <router-view></router-view>
  </div>
  <!-- /.content-wrapper -->
  <Controlsidebar/>
  <Backendfooter/>

</template>
<script>
import Backendheader from '../pages/includes/backend/header.vue';
import Backendsidebar from '../pages/includes/backend/sidebar.vue';
import Backendfooter from '../pages/includes/backend/footer.vue';
import Controlsidebar from '../pages/includes/backend/controlsidebar.vue';
    export default {
       name:'backendmaster',
       components:{
         Backendheader,
         Backendsidebar,
         Backendfooter,
         Controlsidebar,
       },
       data(){
           return{

           };
       },
       mounted(){
        this.loadscripts();
       },
       computed:{
       },
       methods:{
        loadscripts(){
        },
        active(route){
            return  this.$route.name == route ? 'current' : ''
        },
        LoadLogo(photo) {
          if (photo) {
            return "/themes/buliten/images/" + photo;
            // return "/assets/img/" + photo;
          } else {
            return "/assets/img/empty.png";
          }
        },
    }
}
</script>
