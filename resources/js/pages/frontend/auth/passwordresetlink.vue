<template>

    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 lg:w-1/3 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h4 class="sm:!leading-[50px]">Ready to Reset the Password?</h4>
                    <img src="assets/themes/plurk/assets/images/form-img.png" alt="form-img" class="mx-auto"  />
                </div>
                <form  @submit.prevent="PasswordReset()" @keydown="passwordresetform.onKeydown($event)" class="rounded-3xl bg-white px-4 py-12 dark:bg-[#101626] lg:w-2/3 lg:px-8">
                    <AlertError :form="passwordresetform" class="text-red mb-2"/>
                    <div class="relative mt-10">
                        <input  v-model="passwordresetform.password" type="password" name="password"
                            class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                         />
                        <div class="text-red" v-if="passwordresetform.errors.has('password')" v-html="passwordresetform.errors.get('password')" />
                        <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Password</label>
                    </div>
                    <div class="relative mt-10">
                        <input  v-model="passwordresetform.password_confirmation" type="password" name="password_confirmation"
                            class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                         />
                        <div class="text-red" v-if="passwordresetform.errors.has('password_confirmation')" v-html="passwordresetform.errors.get('password_confirmation')" />
                        <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Confirm Password</label>
                    </div>
					<router-link :to="{name:'Login'}" class="ml-auto mt-10 text-green">Login?</router-link>
                    <div class="mt-10 text-center ltr:lg:text-right rtl:lg:text-left">
                        <button  type="submit" :disabled="passwordresetform.busy"
                        class="btn bg-gray px-12 capitalize text-white dark:bg-white dark:text-black dark:hover:bg-secondary">
                            Register
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
                id:'',
                password:'',
                password_confirmation:'',
                token:'',
                fullpage:false,
                status:'email',//default login with
            }),
        };
    },
    mounted(){
        this.resetForm();
        console.log(this.$route.params, 'params');
    },
    computed:{
    },
    methods:{
        PasswordReset(){
            let loader = this.Loading();
            this.$store.dispatch('passwordreset', this.passwordresetform)
            .then((response)=>{
                console.log('response34', response);
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
            this.$router.push({name:'Login'});
        },
        resetForm(){
            this.passwordresetform.token                     = this.$route.params.token;
            this.passwordresetform.id                        = this.$route.params.id;
            this.passwordresetform.password                  = '';
            this.passwordresetform.password_confirmation     = '';
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
.text-green{
    color: #00ff1f !important;
}
</style>
