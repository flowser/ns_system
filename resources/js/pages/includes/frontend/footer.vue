<template>
    <Topfooter/>
    <Bottomfooter/>
    <Buttonup/>
</template>
<script>
import Topfooter from './footer/topfooter.vue';
import Bottomfooter from './footer/bottomfooter.vue';
import Buttonup from './footer/buttonup.vue';
export default {
    name:'frontfooter',
    components:{
        Topfooter,
        Bottomfooter,
        Buttonup,
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
