<template>
    <Breadcrumb/>
    <section class="bg-gradient-to-b from-white/[55%] to-transparent py-14 dark:from-white/5 lg:py-[100px]">
        <div class="container">
            <div class="heading text-center">
                <h4>Our Visionary Leaders</h4>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img :src="Loadimage('leader-1.png')" alt="leader-1" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Aditya Patel
                    </h4>
                    <h6 class="text-sm font-bold">Chief Executive Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img :src="Loadimage('leader-2.png')" alt="leader-2" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Audrey Ramirez
                    </h4>
                    <h6 class="text-sm font-bold">Chief Operating Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img :src="Loadimage('leader-3.png')" alt="leader-3" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        James Robinson
                    </h4>
                    <h6 class="text-sm font-bold">Chief Financial Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img :src="Loadimage('leader-4.png')" alt="leader-4" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Daniel Allen
                    </h4>
                    <h6 class="text-sm font-bold">Chief Marketing Officer</h6>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Breadcrumb from '../includes/frontend/breadcrumb.vue'
export default {
    name:'teams',
    components:{
        Breadcrumb
    },
    data(){
        return{
        };
    },
    mounted() {
        this.$loadScript("assets/themes/plurk/assets/js/aos.js");
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
        Loadimage(photo) {
          if (photo) {
            return "/assets/themes/plurk/assets/images/" + photo;
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

