<template>
    <div class="account-form">
		<div class="account-head" style="background-image:url(/assets/themes/front/assets/images/background/bg2.jpg);">
			<a href="" @click.prevent="Unhideheader()"><img src="/assets/themes/front/assets/images/logo-white-2.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Login to your <span>Account</span></h2>
					<p>Don't have an account? <router-link :to="{name: 'Register'}">Create one here</router-link></p>
				</div>
				<form class="contact-bx vld-parent" ref="formContainer" @submit.prevent="login()" @keydown="loginform.onKeydown($event)">
					<div class="row placeani col-lg-12">
                        <div class="alert alert-danger" v-if="loginform.errors.has('error')">
                                <div class="text-red" > Check your credentials <span v-html="loginform.errors.get('error')"></span> </div>
                        </div>
						<div class="col-lg-12">
							<div class="form-group">
									<label>Your Name</label>
									<input v-model="loginform.email" name="email" type="text" class="form-control">
                                    <div class="text-red" v-if="loginform.errors.has('email')" v-html="loginform.errors.get('email')" />
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
									<label>Your Password</label>
									<input v-model="loginform.password" name="password" type="password" class="form-control" placeholder="Password">
                                    <div class="text-red" v-if="loginform.errors.has('password')" v-html="loginform.errors.get('password')" />
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input v-model="loginform.rememberme" type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
								</div>
								<router-link :to="{Name:'Forgot Password'}" class="ml-auto">Forgot Password?</router-link>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button  type="submit" :disabled="loginform.busy" class="btn button-md">Login</button>
						</div>
						<div class="col-lg-12">
							<h6>Login with Social media</h6>
							<div class="d-flex">
								<a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
								<a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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
                console.log('dashboard', this.$dashboard());
                this.routeresolving();
            })
             .catch((error)=>{
                console.log('error', error);
                this.Error(error);
            })
        },
        routeresolving(){
                window.location.replace(this.$router.resolve(this.$dashboard()).href);
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
