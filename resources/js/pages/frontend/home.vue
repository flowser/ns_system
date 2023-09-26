<template>
    <Banner/>
    <Actioncall/>
</template>
<script>
import Banner from './home/banner.vue';
import Actioncall from './home/actioncall.vue';
export default {
    name:'homebanner',
    components:{
        Banner,
        Actioncall,
    },
    data(){
        return{
        };
    },
    mounted() {
    },
    computed:{
        Company(){
            return this.$store.getters.Company
        },
    },
    methods:{
         OpenSocialpage(url){
            window.open(url, "_blank");
        },
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
