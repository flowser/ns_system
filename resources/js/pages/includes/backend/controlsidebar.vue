<template>
    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</template>
    <script>
    export default {
        name:'backendcontrolsidebar',
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
