<template>
    <Breadcrumb/>
    <section class="relative pt-14 lg:pb-48 lg:pt-[100px]">
        <div class="container relative z-[1]">
            <div class="text-center lg:w-1/2 ltr:lg:text-left rtl:lg:text-right">
                <div class="heading mb-5 text-center ltr:lg:text-left rtl:lg:text-right xl:w-[95%]">
                    <h6>Who are we?</h6>
                    <h4>We thrive to help our clients have global impact</h4>
                </div>
                <p class="pb-10 text-lg font-semibold leading-[30px]">
                    In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document
                    or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                </p>
                <a href="career.html" class="btn capitalize text-white">Join Our Team</a>
            </div>
        </div>
        <div class="bottom-0 ltr:right-0 rtl:left-0 lg:absolute" data-aos="fade-left" data-aos-duration="1000">
            <img :src="Loadimage('about-who-bg.png')" alt="about-who-bg" class="rtl:rotate-y-180" />
        </div>
    </section>
    <Counter/>
</template>
<script>
import Breadcrumb from '../includes/frontend/breadcrumb.vue'
import Counter from './home/companyfacts/countdownfact.vue';
export default {
    name:'about_us',
    components:{
        Counter,
        Breadcrumb
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

