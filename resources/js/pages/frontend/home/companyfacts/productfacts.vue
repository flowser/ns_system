<template>
     <div class="container">
        <div class="flex flex-col items-center justify-center lg:flex-row lg:justify-between">
            <div class="heading text-center ltr:lg:text-left rtl:lg:text-right">
                <h6>Our Products</h6>
                <h4>Some of our finest work.</h4>
            </div>
            <div class="flex items-center justify-end gap-4">
            <div class="text-sm font-extrabold text-black dark:text-white">View All</div>
            <button type="button" class="bg-black/5 dark:bg-white/5 w-10 h-10 rounded-full flex items-center justify-center hover:bg-secondary dark:hover:bg-secondary transition">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-black dark:text-white">
                    <path d="M5.95007 1.2002L1.48924 5.3424C1.06317 5.73803 1.06317 6.41236 1.48924 6.80799L5.95007 10.9502" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <button type="button" class="bg-black/5 dark:bg-white/5 text-p w-10 h-10 rounded-full flex items-center justify-center hover:bg-secondary dark:hover:bg-secondary transition">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-black dark:text-white">
                    <path d="M1.05005 10.7998L5.51089 6.6576C5.93695 6.26197 5.93695 5.58764 5.51089 5.19201L1.05005 1.0498" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        </div>
        <div class="mb-7">
            <ul class="filters home-filter mt-10 flex gap-8 overflow-x-auto whitespace-nowrap pb-3 font-bold lg:mt-0 lg:gap-10">
                <li class="active filter" data-filter="all"><button type="button">All Work</button></li>
                <li class="filter" data-filter="design"><button type="button" class="transition hover:text-secondary">Design</button></li>
                <li class="filter" data-filter="website"><button type="button" class="transition hover:text-secondary">Website</button></li>
                <li class="filter" data-filter="app"><button type="button" class="transition hover:text-secondary">Mobile App</button></li>
                <li class="filter" data-filter="web"><button type="button" class="transition hover:text-secondary">Web Application</button></li>
                <li class="filter" data-filter="ecommerce"><button type="button" class="transition hover:text-secondary">Ecommerce</button></li>
            </ul>
        </div>
        <div class="projects grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="project" data-filter="web">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-1.png" alt="project-1" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">Space Landing page</h6>
                        <p>Website</p>
                    </div>
                </div>
            </div>
            <div class="project" data-filter="ecommerce">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-2.png" alt="project-2" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">Crypto Game - UX Interface</h6>
                        <p>Website, App</p>
                    </div>
                </div>
            </div>
            <div class="project" data-filter="app">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-3.png" alt="project-3" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">Looking for a quiet place</h6>
                        <p>Website</p>
                    </div>
                </div>
            </div>
            <div class="project" data-filter="design">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-4.png" alt="project-4" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">WeTour - Travel Hero Illustration</h6>
                        <p>Website</p>
                    </div>
                </div>
            </div>
            <div class="project" data-filter="website">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-5.png" alt="project-5" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">Digital Art Guide</h6>
                        <p>Branding</p>
                    </div>
                </div>
            </div>
            <div class="project" data-filter="app">
                <div
                    class="relative rounded-3xl border border-transparent bg-white drop-shadow-[5px_10px_80px_rgba(119,128,161,0.15)] transition duration-500 hover:border-secondary hover:bg-secondary/20 dark:bg-gray-dark dark:drop-shadow-none"
                >
                    <a href="portfolio-detail.html" class="absolute top-0 left-0 h-full w-full"></a>
                    <img src="assets/themes/plurk/assets/images/project-6.png" alt="project-6" class="h-52 w-full rounded-t-3xl object-cover" />
                    <div class="p-5 text-sm font-bold">
                        <h6 class="mb-1 text-black dark:text-white">Frozeverse - 3D and motion design</h6>
                        <p>Branding, Website, App</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'productfacts',
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
