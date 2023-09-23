<template>
    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 lg:w-1/3 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h6>Reset Your Password</h6>
                    <h4 class="sm:!leading-[50px]">Forgot Your Password?</h4>
                    <img src="assets/themes/frontend/plurk/assets/images/form-img.png" alt="form-img" class="mx-auto" data-aos="fade-right" data-aos-duration="1000" />
                </div>
                <form action="" class="rounded-3xl bg-white px-4 py-12 dark:bg-[#101626] lg:w-2/3 lg:px-8">
                    <div class="relative mt-10">
                        <input
                            type="email"
                            name="email"
                            class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                        />
                        <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white"
                            >Email</label
                        >
                        <svg
                            width="22"
                            height="21"
                            viewBox="0 0 22 21"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute top-1/2 -translate-y-1/2 ltr:right-4 rtl:left-4 dark:text-white"
                        >
                            <path
                                d="M1 8.00732V7.00732C1 4.2459 3.23858 2.00732 6 2.00732H16C18.7614 2.00732 21 4.2459 21 7.00732V13.0073C21 15.7687 18.7614 18.0073 16 18.0073H6C3.23858 18.0073 1 15.7687 1 13.0073V12.0073"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                            <path
                                d="M5 7.00732L9.8 10.6073C10.5111 11.1407 11.4889 11.1407 12.2 10.6073L17 7.00732"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <router-link :to="{name:'Login'}" class="ml-auto mt-10">Login?</router-link>
                    <div class="mt-10 text-center ltr:lg:text-right rtl:lg:text-left">
                        <button type="button" class="btn bg-gray px-12 capitalize text-white dark:bg-white dark:text-black dark:hover:bg-secondary">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name:'forgotpassword',
    components:{
    },
    data(){
        return{
        };
    },
    mounted(){
    },
    computed:{
        Hideheader(){
        }
    },
    methods:{
        Unhideheader(){
             window.location.replace('/')
        }
    },
    watch: {
        $route(to, from) {
        },

    }
}
</script>

<style>

</style>
