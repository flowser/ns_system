<template>
    <section class="bg-[url(../images/team-bg.png)] bg-cover bg-center bg-no-repeat py-14 dark:bg-black/50 lg:py-[100px]">
        <div class="container">
            <div class="heading text-center">
                <h6>Meet Our Team</h6>
                <h4>Creative Minds</h4>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img src="assets/themes/plurk/assets/images/team-member-1.png" alt="team-member-1" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Aditya Patel
                    </h4>
                    <h6 class="text-sm font-bold">Chief Executive Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img src="assets/themes/plurk/assets/images/team-member-2.png" alt="team-member-2" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Audrey Ramirez
                    </h4>
                    <h6 class="text-sm font-bold">Chief Operating Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img src="assets/themes/plurk/assets/images/team-member-3.png" alt="team-member-3" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        James Robinson
                    </h4>
                    <h6 class="text-sm font-bold">Chief Financial Officer</h6>
                </div>
                <div class="group cursor-pointer text-center">
                    <div class="relative h-[280px] rounded-3xl transition-all duration-500 group-hover:shadow-[0_0_25px_#979797]">
                        <img src="assets/themes/plurk/assets/images/team-member-4.png" alt="team-member-4" class="h-full w-full rounded-3xl object-cover object-top" />
                    </div>
                    <h4 class="pt-5 pb-2 text-xl font-extrabold text-black transition duration-500 group-hover:text-secondary dark:text-white">
                        Daniel Allen
                    </h4>
                    <h6 class="text-sm font-bold">Chief Marketing Officer</h6>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name:'frontfooter',
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
