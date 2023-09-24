<template>

    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 lg:w-1/3 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h4 class="sm:!leading-[50px]">Ready to Login?</h4>
                    <img src="assets/themes/plurk/assets/images/form-img.png" alt="form-img" class="mx-auto"  />
                </div>
                <form  @submit.prevent="login()" @keydown="loginform.onKeydown($event)" class="rounded-3xl bg-white px-4 py-12 dark:bg-[#101626] lg:w-2/3 lg:px-8">
                    <AlertError :form="loginform" class="text-red mb-2"/>
                    <div class="relative mt-10">
                            <input v-model="loginform.email" type="email" name="email"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                            />
                            <div class="text-red" v-if="loginform.errors.has('email')" v-html="loginform.errors.get('email')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Email Address</label
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
                    <div class="relative mt-10">
                        <input  v-model="loginform.password" type="password" name="password"
                            class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                        />
                        <div class="text-red" v-if="loginform.errors.has('password')" v-html="loginform.errors.get('password')" />
                        <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Password</label
                        >
                        <svg
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute top-1/2 -translate-y-1/2 ltr:right-4 rtl:left-4 dark:text-white"
                        >
                            <path
                                d="M1 11.467V18.9267C1 19.7652 1.96993 20.2314 2.6247 19.7076L5.45217 17.4456C5.8068 17.1619 6.24742 17.0073 6.70156 17.0073H16C18.7614 17.0073 21 14.7687 21 12.0073V6.00732C21 3.2459 18.7614 1.00732 16 1.00732H6C3.23858 1.00732 1 3.2459 1 6.00732V7.62225"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />
                            <circle cx="6.05005" cy="9.05713" r="1.25" fill="currentColor" />
                            <circle cx="11.05" cy="9.05713" r="1.25" fill="currentColor" />
                            <circle cx="16.05" cy="9.05713" r="1.25" fill="currentColor" />
                        </svg>
                    </div>
					<router-link :to="{name:'Forgot Password'}" class="ml-auto text-green">Forgot Password?</router-link> <br>
					<router-link :to="{name:'Register'}" class="ml-auto text-green">Dont Have Account?</router-link><br>
                    <div class="mt-10 text-center ltr:lg:text-right rtl:lg:text-left">
                        <button  type="submit" :disabled="loginform.busy"
                        class="btn bg-gray px-12 capitalize text-white dark:bg-white dark:text-black dark:hover:bg-secondary">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import Form from 'vform';
export default {
    name:'login',
    components:{
    },
    data(){
        return{
            loginform: new Form({
                email:'',
                password:'',
                rememberme:null,
                fullpage:false,
                status:'email',//default login with
            }),
        };
    },
    mounted(){
        this.resetForm();
    },
    computed:{
        Hideheader(){
        }
    },
    methods:{
        Unhideheader(){
            window.location.replace('/')
        },
        login(){
            let loader = this.Loading();
            this.$store.dispatch('login', this.loginform)
            .then((response)=>{
                console.log('response34', response);
                loader.hide();
                this.resetForm();
                this.Success(response);
                this.routeresolving();
            })
             .catch((error)=>{
                console.log('error', error);
                this.Error(error);
            })
        },
        routeresolving(){
                window.location.replace(this.$dashboard().redirecturl);
        },
        Loading(){
            let loader = this.$loading.show({
                // Optional parameters
                container: this.loginform.fullpage ? null : this.$refs.formContainer,
                canCancel: true,
                // onCancel: this.Error(error),
                color: '#000000',
                loader: 'bars',
                width: 64,
                height: 64,
                backgroundColor: '#ffffff',
                opacity: 0.5,
                zIndex: 999,
            })
            return loader;
        },
        resetForm(){
            this.loginform.email        = '';
            this.loginform.password     = '';
            this.loginform.rememberme   = null;
            this.loginform.fullpage     = false;
        },
    },
    watch: {
        $route(to, from) {
        },
    }
}
</script>
<style>
</style>
