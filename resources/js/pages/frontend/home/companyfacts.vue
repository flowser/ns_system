<template>
    <section class="py-14 dark:!bg-none lg:py-[100px]" style="background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, #ffffff 54.69%)">
        <Countdownfact/>
        <Thedrive/>
        <Productfacts/>
        <!-- <Servicefacts/> -->
    </section>
</template>
<script>
import Countdownfact from './companyfacts/countdownfact.vue';
import Thedrive from './companyfacts/thedrive.vue';
import Productfacts from './companyfacts/productfacts.vue';
import Servicefacts from './companyfacts/servicefacts.vue';
export default {
    name:'companyfacts',
    components:{
        Countdownfact,
        Thedrive,
        Productfacts,
        Servicefacts,
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
