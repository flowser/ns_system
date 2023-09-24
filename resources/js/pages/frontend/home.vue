<template>
    <Banner/>
    <!-- <Impactproducts/> -->
    <!-- <Companyfacts/> -->
    <!-- <Partteam/> -->
    <!-- <Pricingplan/> -->
    <!-- <Parttestimonials/> -->
    <Actioncall/>
</template>
<script>
import Banner from './home/banner.vue';
import Impactproducts from './home/impactproducts.vue';
import Companyfacts from './home/companyfacts.vue';
import Partteam from './home/partteam.vue';
import Pricingplan from './home/pricingplan.vue';
import Parttestimonials from './home/parttestimonials.vue';
import Actioncall from './home/actioncall.vue';
export default {
    name:'homebanner',
    components:{
        Banner,
        Impactproducts,
        Companyfacts,
        Partteam,
        Pricingplan,
        Parttestimonials,
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
