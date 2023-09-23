<template>
    <Breadcrumb/>
    <Services/>
    <Counter/>
    <Portfolioslider/>
    <Howwedoit/>

</template>
<script>
import Breadcrumb from '../includes/frontend/breadcrumb.vue';
import Services from './home/impactproducts.vue';
import Counter from '../frontend/home/companyfacts/countdownfact.vue';
import Portfolioslider from '../includes/frontend/slider/portfolioslider.vue';
import Howwedoit from './products/how.vue';
export default {
    name:'products',
    components:{
        Breadcrumb,
        Services,
        Counter,
        Portfolioslider,
        Howwedoit,

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

