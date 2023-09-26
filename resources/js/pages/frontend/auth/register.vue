<template>

    <section class="py-14 dark:bg-gray-dark lg:py-[100px]">
        <div class="container">
            <div class="relative z-10 lg:flex">
                <div class="heading text-center lg:mb-0 lg:w-1/3 ltr:lg:pr-10 ltr:lg:text-left rtl:lg:pl-10 rtl:lg:text-right">
                    <h4 class="sm:!leading-[50px]">Ready to Register?</h4>
                    <img src="assets/themes/plurk/assets/images/form-img.png" alt="form-img" class="mx-auto"  />
                </div>
                <form  @submit.prevent="Register()" @keydown="registerform.onKeydown($event)" class="rounded-3xl bg-white px-4 py-12 dark:bg-[#101626] lg:w-2/3 lg:px-8">
                    <AlertError :form="registerform" class="text-red mb-2"/>
                    <div class="grid gap-10 sm:grid-cols-2">
                        <div class="relative">
                            <input v-model="registerform.first_name" type="text" name="first_name"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                             />
                            <div class="text-red" v-if="registerform.errors.has('first_name')" v-html="registerform.errors.get('first_name')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">First Name</label>

                        </div>
                        <div class="relative">
                            <input v-model="registerform.last_name" type="text" name="last_name"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                             />
                            <div class="text-red" v-if="registerform.errors.has('last_name')" v-html="registerform.errors.get('last_name')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Last Name</label>
                        </div>
                        <div class="relative">
                             <vue-tel-input v-model="registerform.phone" name="phone"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12" >
                            </vue-tel-input>
                            <div class="text-red" v-if="registerform.errors.has('phone')" v-html="registerform.errors.get('phone')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Mobile Number</label>

                        </div>
                        <div class="relative">
                            <input v-model="registerform.email" type="email" name="email"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                             />
                            <div class="text-red" v-if="registerform.errors.has('email')" v-html="registerform.errors.get('email')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white" >Email Address</label>

                        </div>
                        <div class="relative">
                            <input  v-model="registerform.password" type="password" name="password"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                             />
                            <div class="text-red" v-if="registerform.errors.has('password')" v-html="registerform.errors.get('password')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Password</label>
                        </div>
                        <div class="relative">
                            <input  v-model="registerform.password_confirmation" type="password" name="password_confirmation"
                                class="w-full rounded-2xl border-2 border-gray/20 bg-transparent p-4 font-bold outline-none transition focus:border-secondary ltr:pr-12 rtl:pl-12"
                             />
                            <div class="text-red" v-if="registerform.errors.has('password_confirmation')" v-html="registerform.errors.get('password_confirmation')" />
                            <label for="" class="absolute -top-3 bg-white px-2 font-bold ltr:left-6 rtl:right-6 dark:bg-[#101626] dark:text-white">Confirm Password</label>
                        </div>
                    </div>
					<router-link :to="{name:'Login'}" class="ml-auto mt-10 text-green">Login?</router-link>
                    <div class="mt-10 text-center ltr:lg:text-right rtl:lg:text-left">
                        <button  type="submit" :disabled="registerform.busy"
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
            registerform: new Form({
                first_name:'',
                last_name:'',
                phone:'',
                email:'',
                password:'',
                password_confirmation:'',
                roles:['Client'],
                permissions:['View', 'Create', 'Delete'],
                fullpage:false,
                status:'email',//default login with
            }),
        };
    },
    mounted(){
        this.resetForm();
        console.log(new Form(), 'form');
    },
    computed:{
        Hideheader(){
        }
    },
    methods:{
        Unhideheader(){
            window.location.replace('/')
        },
        Register(){
            let loader = this.Loading();
            this.$store.dispatch('register', this.registerform)
            .then((response)=>{
                console.log('response34', response);
                loader.hide();
                this.resetForm();
                this.Success(response);
                this.routeresolving();
            })
             .catch((error)=>{
                console.log('error', error);
                loader.hide();
                this.Error(error);
            })
        },
        routeresolving(){
            // console.log(this.$dashboard(), 'url')
                window.location.replace(this.$dashboard().redirecturl);
        },
        resetForm(){
            this.registerform.email        = '';
            this.registerform.password     = '';
            this.registerform.rememberme   = null;
            this.registerform.fullpage     = false;
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
