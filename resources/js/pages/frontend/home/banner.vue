<template>
    <div class="overflow-hidden bg-black pt-[82px] sm:-mx-[250px] sm:rounded-b-[50%] lg:-mx-[150px] lg:pt-[106px]">
        <div class="relative" style="margin-left: 170px;margin-right: 170px">
            <div class="swiper mySwiper relative sm:py-12 md:py-0">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="w-5/6">
                            <div class=" bg-[url(../images/world-map.png)] bg-cover bg-top bg-no-repeat pt-14 pb-0 lg:pt-20 lg:pb-60 xl:pt-36">
                                <div class="relative z-[1] text-center text-white lg:w-3/5 ltr:lg:text-left rtl:lg:text-right xl:w-1/2">
                                    <h2 class="text-4xl font-extrabold leading-normal sm:text-5xl lg:text-[70px] lg:leading-[90px]">
                                        Make your <span class="italic text-primary">team</span> <span class="italic text-secondary">work</span> together
                                    </h2>
                                    <p class="my-8 text-lg lg:w-[90%]">
                                        In publishing and graphic design, Lets Dream Big and Make it Happen Closer than You could think.
                                    </p>
                                    <a href="about-us.html" class="btn mx-auto mt-2 block w-fit bg-white lg:mx-0 lg:rtl:ml-auto">read more</a>
                                </div>
                                <div
                                    class="bottom-0 mx-auto w-auto ltr:right-0 rtl:left-0 md:w-[540px] lg:absolute xl:w-[650px]"
                                    data-aos="fade-left"
                                    data-aos-duration="1000"
                                >
                                    <img src="assets/themes/plurk/assets/images/home-banner-icon.svg" alt="home-banner-icon" class="rtl:rotate-y-180" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="w-5/6">
                            <div class=" bg-[url(../images/world-map.png)] bg-cover bg-top bg-no-repeat pt-14 pb-0 lg:pt-20 lg:pb-60 xl:pt-36">
                                <div class="relative z-[1] text-center text-white lg:w-3/5 ltr:lg:text-left rtl:lg:text-right xl:w-1/2">
                                    <h2 class="text-4xl font-extrabold leading-normal sm:text-5xl lg:text-[70px] lg:leading-[90px]">
                                        Testing <span class="italic text-primary">My</span> <span class="italic text-secondary">Dream</span> together
                                    </h2>
                                    <p class="my-8 text-lg lg:w-[90%]">
                                        The Dreams
                                    </p>
                                    <a href="about-us.html" class="btn mx-auto mt-2 block w-fit bg-white lg:mx-0 lg:rtl:ml-auto">read more</a>
                                </div>
                                <div
                                    class="bottom-0 mx-auto w-auto ltr:right-0 rtl:left-0 md:w-[540px] lg:absolute xl:w-[650px]"
                                    data-aos="fade-left"
                                    data-aos-duration="1000"
                                >
                                    <img src="assets/themes/plurk/assets/images/home-banner-icon.svg" alt="home-banner-icon" class="rtl:rotate-y-180" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'banner',
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

