
<template>
    <button type="button" id="scrollToTopBtn" class="fixed bottom-5 z-10 hidden animate-bounce ltr:right-5 rtl:left-5" onclick="scrollToTop()">
        <div
            class="group flex h-14 w-14 items-center justify-center rounded-full border border-black/20 bg-black text-white transition duration-500 hover:bg-secondary dark:bg-primary dark:hover:bg-secondary"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6 transition group-hover:text-black"            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
        </div>
    </button>
</template>
<script>
export default {
    name:'buttonup',
    components:{
        // Service,
        // Aboutus,
        // Class,
        // Pricing,
        // Accordion,
        // Instructor,
        // Testimonial,
        // Blog,
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
