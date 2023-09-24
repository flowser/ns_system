<template>
    <header id="top-header" class="sticky top-0 z-50 bg-black/10 transition duration-300">
                <div class="container">
                    <div class="flex items-center justify-between py-5 lg:py-0">
                        <!-- <a href="index.html"><img src="assets/themes/plurk/assets/images/logo.png" alt="Felix" class="h-10" /></a> -->
                        <router-link :to="{name: 'Home'}" v-bind:class="{ active: isActive('Home')}" class="text-white">Felix</router-link>
                        <div class="flex items-center">
                            <div onclick="toggleMenu()" class="overlay fixed inset-0 z-[51] hidden bg-black/60"></div>
                            <div class="menus">
                                <div class="border-b border-gray/10 ltr:text-right rtl:text-left lg:hidden">
                                    <button onclick="toggleMenu()" type="button" class="p-4">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6 text-black dark:text-white"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <ul>
                                    <li><router-link :to="{name: 'Home'}" v-bind:class="{ active: isActive('Home')}">Home</router-link></li>
                                    <li>
                                        <router-link :to="{name: 'Contact'}" v-bind:class="{ active: isActive('Contact')}" >Contact Us</router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{name: 'Login'}" v-bind:class="{ active: isActive('Login')}" >Login</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
</template>
<script>
// import Banner from './home/banner.vue';
export default {
    name:'frontheader',
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
        isActive(routeName) {
          return this.$route.name === routeName;
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
