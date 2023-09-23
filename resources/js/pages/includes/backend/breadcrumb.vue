<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</template>
    <script>
    export default {
        name:'backendbreadcrumb',
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
