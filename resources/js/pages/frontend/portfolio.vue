<template>
    <Breadcrumb/>
    <section class="pt-12 pb-14 md:pb-[100px]">
        <div class="container">
            <div class="overflow-x-auto">
                <ul class="filters portfolio-filter mx-auto flex w-max gap-7 whitespace-nowrap pb-2.5 font-bold dark:text-white">
                    <li class="active filter" data-filter="all">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            All Work
                        </button>
                    </li>
                    <li class="filter" data-filter="design">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            Design
                        </button>
                    </li>
                    <li class="filter" data-filter="website">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            Website
                        </button>
                    </li>
                    <li class="filter" data-filter="app">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            Mobile App
                        </button>
                    </li>
                    <li class="filter" data-filter="application">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            Web Application
                        </button>
                    </li>
                    <li class="filter" data-filter="ecommerce">
                        <button type="button" class="rounded-[10px] bg-gray/5 py-4 px-5 leading-5 transition hover:bg-secondary hover:text-white">
                            Ecommerce
                        </button>
                    </li>
                </ul>
            </div>
            <div class="projects mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="project" data-filter="website">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-1.png')" alt="project-1" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Space Landing page</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="app">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-2.png')" alt="project-2" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Crypto Game - UX Interface</h6>
                            <p>Website, App</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="website">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-3.png')" alt="project-3" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Looking for a quiet place</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="website">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-4.png')" alt="project-4" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">WeTour - Travel Hero Illustration</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="design">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-5.png')" alt="project-5" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Digital Art Guide</h6>
                            <p>Branding</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="design">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-6.png')" alt="project-6" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Frozeverse - 3D and motion design</h6>
                            <p>Branding, Website, App</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="website">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-7.png')" alt="project-7" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Space Landing page</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="app">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-8.png')" alt="project-8" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Crypto Game - UX Interface</h6>
                            <p>Website, App</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="website">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-9.png')" alt="project-9" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Looking for a quiet place</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="application">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-10.png')" alt="project-10" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">WeTour - Travel Hero Illustration</h6>
                            <p>Website</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="design">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}" class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-11.png')" alt="project-11" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Digital Art Guide</h6>
                            <p>Branding</p>
                        </div>
                    </div>
                </div>
                <div class="project" data-filter="ecommerce">
                    <div
                        class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                    >
                        <router-link :to="{name: 'Portfolio Details', params:{portfolio:'1'}}"  class="absolute top-0 h-full w-full ltr:left-0 rtl:right-0"></router-link>
                        <img :src="Loadimage('project-12.png')" alt="project-12" class="h-52 w-full rounded-t-3xl object-cover" />
                        <div class="p-5 text-sm font-bold">
                            <h6 class="mb-1 text-black dark:text-white">Frozeverse - 3D and motion design</h6>
                            <p>Branding, Website, App</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Breadcrumb from '../includes/frontend/breadcrumb.vue'
export default {
    name:'portfolio',
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

