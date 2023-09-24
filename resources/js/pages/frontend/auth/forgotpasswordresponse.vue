<template>
    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h4 class="sm:!leading-[50px]">Check Your Email: <span class="text-green">{{ Passwordresetemail }}</span> to Reset Password</h4>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// import Form from 'vform';
export default {
    name:'login',
    components:{
    },
    data(){
        return{

        };
    },
    mounted(){

    },
    computed:{
        Passwordresetemail(){
            return this.$store.getters.Passwordresetemail
        },

    },
    methods:{
    },
    watch: {
        $route(to, from) {
        },
    }
}
</script>
<style>
/* //warning on field inputs */
.text-red{
    color: red !important;
}
</style>
