<template>
    <section class="py-14 lg:py-[100px]">
        <div class="container">
            <div class="mb-7 flex flex-col items-center justify-center lg:mb-0 lg:flex-row lg:justify-between">
                <div class="heading text-center ltr:lg:text-left rtl:lg:text-right">
                    <h6>Our Project</h6>
                    <h4>Some of our finest work.</h4>
                </div>
                <div class="flex items-center justify-end gap-4">
                    <a
                        href="portfolio-detail.html"
                        class="text-sm font-extrabold text-black transition hover:text-secondary dark:text-white dark:hover:text-secondary"
                        >View All</a
                    >
                    <button
                        type="button"
                        class="project-slider-button-prev flex h-10 w-10 items-center justify-center rounded-full bg-black/5 transition hover:bg-secondary dark:bg-white/5 dark:hover:bg-secondary"
                    >
                        <svg
                            width="7"
                            height="12"
                            viewBox="0 0 7 12"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-black rtl:rotate-180 dark:text-white"
                        >
                            <path
                                d="M5.95007 1.2002L1.48924 5.3424C1.06317 5.73803 1.06317 6.41236 1.48924 6.80799L5.95007 10.9502"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            ></path>
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="project-slider-button-next text-p flex h-10 w-10 items-center justify-center rounded-full bg-black/5 transition hover:bg-secondary dark:bg-white/5 dark:hover:bg-secondary"
                    >
                        <svg
                            width="7"
                            height="12"
                            viewBox="0 0 7 12"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-black rtl:rotate-180 dark:text-white"
                        >
                            <path
                                d="M1.05005 10.7998L5.51089 6.6576C5.93695 6.26197 5.93695 5.58764 5.51089 5.19201L1.05005 1.0498"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper project-slider px-6">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark"
                    >
                        <router-link :to="{ name: 'Portfolio Details', params:{ portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-2.png')" alt="project-2" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black line-clamp-1 dark:text-white">Crypto Game - UX Interface</h6>
                            <p>Website, App</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-3.png')" alt="project-3" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black line-clamp-1 dark:text-white">Looking for a quiet place</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-4.png')" alt="project-4" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black line-clamp-1 dark:text-white">WeTour - Travel Hero Illustration</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-5.png')" alt="project-5" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black line-clamp-1 dark:text-white">Digital Art Guide</h6>
                            <p>Branding</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-6.png')" alt="project-6" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black line-clamp-1 dark:text-white">Frozeverse - 3D and motion design</h6>
                            <p>Branding, Website, App</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    name:'portfolioslider',
    components:{
    },
    data(){
        return{
        };
    },
    mounted() {
        // this.$loadScript("assets/themes/plurk/assets/js/swiper-bundle.min.js")
        //     .then(() => {
        //         var swiper = new Swiper('.mySwiper', {
        //             loop: true,
        //             slidesPerView: 'auto',
        //             spaceBetween: 30,
        //             speed: 1000,
        //             autoplay: {
        //                 delay: 3000,
        //                 disableOnInteraction: false,
        //             },
        //             navigation: {
        //                 nextEl: '.testimonial-swiper-button-next',
        //                 prevEl: '.testimonial-swiper-button-prev',
        //             },
        //         });
        //         // Counter Js
        //         VanillaCounter();
        //     });
    },
    computed:{
        Company(){
            // return this.$store.getters.Company
        },
    },
    methods:{
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
