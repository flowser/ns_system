<template>
    <FrontHeader/>
    <div class="-mt-[82px] overflow-x-hidden bg-gradient-to-r from-[#FCF1F4] to-[#EDFBF9] dark:bg-none lg:-mt-[106px]">
        <router-view></router-view>
    </div>
    <FrontFooter/>
</template>
<script>
import FrontHeader from '../pages/includes/frontend/header.vue';
import FrontFooter from '../pages/includes/frontend/footer.vue';
    export default {
       name:'frontmaster',
       components:{
         FrontHeader,
         FrontFooter,
       },
       data(){
           return{

           };
       },
       mounted(){
        this.loadscripts();
       },
       computed:{
       },
       methods:{
        loadscripts(){
            //  <!--================= jquery latest version =================-->
            this.$loadScript("assets/themes/plurk/assets/js/vanilla-counter.js");
            this.$loadScript("assets/themes/plurk/assets/js/aos.js")
            .then(() => {
                if (window['AOS']) {
                    window['AOS'].init({
                        once: true,
                    });
                    }
                })
            .catch(() => {
              // Failed to fetch script
            });
            // AOS Animation


            // Testimonial Slider
            this.$loadScript("assets/themes/plurk/assets/js/custom.js");
            this.$loadScript("assets/themes/plurk/assets/js/swiper-bundle.min.js")
            .then(() => {
                // Testimonial Slider
                var swiper = new Swiper('.mySwiper', {
                    loop: true,
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    speed: 1000,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.testimonial-swiper-button-next',
                        prevEl: '.testimonial-swiper-button-prev',
                    },
                });

                // Project Slider
                var swiper = new Swiper('.project-slider', {
                    loop: true,
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.project-slider-button-next',
                        prevEl: '.project-slider-button-prev',
                    },
                    breakpoints: {
                        600: {
                            slidesPerView: 2,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        1000: {
                            slidesPerView: 4,
                        },
                        1200: {
                            slidesPerView: 5,
                        },
                    },
                });

                // Service Page - Partner Slider
                var swiper = new Swiper('.partner-slider', {
                    loop: true,
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    speed: 2500,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1.7,
                        },
                        600: {
                            slidesPerView: 3,
                        },
                        1000: {
                            slidesPerView: 5,
                        },
                        1600: {
                            slidesPerView: 8,
                        },
                    },
                });
                // Counter Js
                VanillaCounter();

                //  Filter
                const filters = document.querySelectorAll('.filter');
                filters.forEach((filter) => {
                    filter.addEventListener('click', function () {
                        let selectedFilter = filter.getAttribute('data-filter');
                        let itemsToHide = document.querySelectorAll(`.projects .project:not([data-filter='${selectedFilter}'])`);
                        let itemsToShow = document.querySelectorAll(`.projects [data-filter='${selectedFilter}']`);
                        if (selectedFilter == 'all') {
                            itemsToHide = [];
                            itemsToShow = document.querySelectorAll('.projects [data-filter]');
                        }
                        filterMenu = document.querySelectorAll('.filters li.filter');
                        filterMenu.forEach((el) => {
                            el.classList.remove('active');
                        });
                        filter.classList.add('active');
                        itemsToHide.forEach((el) => {
                            el.classList.add('hidden');
                            el.classList.remove('block');
                        });
                        itemsToShow.forEach((el) => {
                            el.classList.remove('hidden');
                            el.classList.add('block');
                        });
                    });
                });
            })
            .catch(() => {
              // Failed to fetch script
            });
        },
        active(route){
            return  this.$route.name == route ? 'current' : ''
        },
        LoadLogo(photo) {
          if (photo) {
            return "/themes/buliten/images/" + photo;
            // return "/assets/img/" + photo;
          } else {
            return "/assets/img/empty.png";
          }
        },
       },
       watch:{
           $route (to, from){
            this.loadscripts();
           }
       }
}



</script>
