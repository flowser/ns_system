<template>
    <div class="account-form">
		<div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
			<a href="" @click.prevent="Unhideheader()"><img src="assets/images/logo-white-2.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Forget <span>Password</span></h2>
					<p>Login Your Account <router-link :to="{name:'Login'}">Click here</router-link></p>
				</div>
				<form class="contact-bx">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email Address</label>
									<input name="dzName" type="email" required="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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
