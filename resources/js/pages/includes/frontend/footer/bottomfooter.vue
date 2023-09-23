<template>
    <div class="py-5 dark:border-t-2 dark:border-white/5">
        <div class="container">
            <div class="flex flex-col items-center justify-between text-center font-bold dark:text-white md:flex-row">
                <div>
                    Copyright© <span class="curr-year">2022 </span>
                        <router-link :to="{name: 'Home'}" class="text-primary transition hover:text-secondary"> HillMan Paints. Ltd. </router-link>
                        All rights reserved.  <span class="curr-year">Developed by  </span>
                        <a href="http://www.savvytexmarines.co.ke" class="text-primary transition hover:text-secondary" target="_blank"> Graphic Marines</a>

                </div>
                <div>Need help? Visit the <router-link :to="{name: 'Contact'}" class="text-secondary transition hover:text-primary">Contact Us</router-link></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'bottomfooter',
    components:{
        // Banner,
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
