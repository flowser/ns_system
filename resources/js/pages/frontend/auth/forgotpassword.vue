<template>

    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 lg:w-1/3 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h4 class="sm:!leading-[50px]">Ready to Reset Password?</h4>
                    <img src="assets/themes/plurk/assets/images/form-img.png" alt="form-img" class="mx-auto"  />
                </div>
                <form  @submit.prevent="PasswordReset()" @keydown="passwordresetform.onKeydown($event)" class="rounded-3xl bg-white px-4 py-12 dark:bg-[#101626] lg:w-2/3 lg:px-8">
                    <AlertError :form="passwordresetform" class="text-red mb-2"/>
                    <div class="relative">
                        <input v-model="passwordresetform.email" type="email" name="email"
                            class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                         />
                        <div class="text-red" v-if="passwordresetform.errors.has('email')" v-html="passwordresetform.errors.get('email')" />
                        <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white" >Email Address</label>
                    </div>
					<router-link :to="{name:'Login'}" class="ml-auto mt-10 text-green">Login?</router-link>
                    <div class="mt-10 text-center ltr:lg:text-right rtl:lg:text-left">
                        <button  type="submit" :disabled="passwordresetform.busy"
                        class="btn bg-gray px-12 capitalize text-white dark:bg-white dark:text-black dark:hover:bg-secondary">
                            Reset Password
                        </button>
                    </div>
                </form>
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
            passwordresetform: new Form({
                email:'',
                fullpage:false,
                status:'email',//default login with
            }),
        };
    },
    mounted(){
        this.resetForm();
    },
    computed:{

    },
    methods:{
        Unhideheader(){
            window.location.replace('/')
        },
        PasswordReset(){
            let loader = this.Loading();
            this.$store.dispatch('resetpasswordform', this.passwordresetform)
            .then((response)=>{
                loader.hide();
                this.resetForm();
                this.Success(response);
                this.routeresolving();
            })
             .catch((error)=>{
                loader.hide();
                this.Error(error);
            })
        },
        routeresolving(){
            // this.$router.push({name:'Forgot Password Response', params:{token:123}});
            this.$router.push({name:'Forgot Password Response'});
        },
        resetForm(){
            this.passwordresetform.email        = '';
            this.passwordresetform.password     = '';
            this.passwordresetform.rememberme   = null;
            this.passwordresetform.fullpage     = false;
        },
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
