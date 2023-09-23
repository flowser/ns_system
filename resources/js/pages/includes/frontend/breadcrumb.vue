<template>
    <div class="bg-[url(../images/inner-page-hero-bg.png)] bg-cover bg-bottom bg-no-repeat pt-[0px] lg:pt-[0px]">
        <div class="relative">
            <div class="container">
                <div class="items-center justify-between py-10 md:flex md:h-[400px] md:py-0">
                    <div class="heading relative mb-0 text-center ltr:md:text-left rtl:md:text-right">
                        <h6>{{capitalize(currentroute)}}</h6>
                        <h4 class="!text-white">{{ info }}</h4>
                    </div>
                    <div
                        class="top-[100px] mt-10 h-96 w-auto ltr:right-0 rtl:left-0 lg:absolute lg:mt-0 lg:h-auto lg:w-2/5"
                        data-aos="fade-left"
                        data-aos-duration="1000">
                        <!-- <img :src="Loadimage('services-detail-phone.png')" alt="services-detail-phone" class="mx-auto h-full" /> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'breadcrumb',
    components:{
    },
    data(){
        return{
            currentroute:'',
                home:{
                    name:''
                },
        };
    },
    mounted() {
        console.log(this.$route);
        this.currentroute = this.$route.name;
        this.info = this.$route.meta.info;
        this.home.name = 'Home';
    },
    computed:{
        homeroute(){
            return this.home;
        },
    },
    methods:{
        Loadimage(photo) {
          if (photo) {
            return "/themes/frontend/plurk/assets/images/" + photo;
            // return "/assets/img/" + photo;
          } else {
            return "/assets/img/empty.png";
          }
        },
        capitalize(text){
            return text.charAt(0).toUpperCase() + text.slice(1);
       },
    },
    watch: {
        $route(to, from) {
            this.currentroute = this.$route.name;
        },

    }
}
</script>

<style>

</style>
