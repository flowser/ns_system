<template>
    <breadcrumb/>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="card">
                	<div class="card-header">
                		<h6 class="fw-600 mb-0">Footer Widget</h6>
                	</div>
                	<div class="card-body">
                		<div class="row gutters-10">
                			<div class="col-lg-6">
                				<div class="card shadow-none bg-light">
                					<div class="card-header">
                						<h6 class="mb-0">About Widget</h6>
                					</div>
                					<div class="card-body">
                						<form role="form" enctype="multipart/form-data" class="vld-parent" ref="formContainer" @submit.prevent="updateBulkBusinesssetting()" >
                                            <div class="form-group row" v-for="(formtype, idx) in businesssettingform.types" :key="idx">
                                                <label class="col-md-3 col-from-label"  v-if="formtype.type==='footer_logo'">Footer Logo</label>
                    				    		<div class="col-md-8"  v-if="formtype.type ==='footer_logo'">
                                                    <div class="form-group">
                                                        <label class="logo form-control" :for="formtype.type" >Browse</label>
                                                        <input @change="ChangeBrandLogo($event, idx)" type="file" :name="formtype.type" :id="formtype.type" class="form-control"
                                                            :class="{ 'is-invalid': businesssettingform.errors.has(formtype.type) }" hidden>
                                                        <img :src="updateBrandLogo(businesssettingform.types[idx].value, idx)" alt="" style="width: 57%;" >
                                                    </div>
                                                </div>
                                                <label class="col-md-12 col-from-label" v-if="formtype.type==='footer_about_us_description'">About Us Footer Description</label>
                    				    		<div class="col-md-12"  v-if="formtype.type==='footer_about_us_description'">
                                                    <div class="form-group">
                                                        <quill-editor v-model:content="businesssettingform.types[idx].value" theme="snow" toolbar="full" content-type="html"
                                                                        style="height: 156px">
                                                        </quill-editor>
                                                    </div>
                                                </div>
                                            </div>
                    				    	<div class="border-top pt-3">
                    				    		<div class="text-right">
                                                    <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
                    	        	    		</div>
                        			    	</div>
                        			    </form>
                					</div>
                				</div>
                			</div>
                			<div class="col-lg-6">
                                <div class="card shadow-none bg-light">
                					<div class="card-header">
                						<h6 class="mb-0">Contact Info Widget</h6>
                					</div>
                					<div class="card-body">
                                        <form role="form" enctype="multipart/form-data"  ref="formContainer" @submit.prevent="updateBulkBusinesssetting()" >
                                            <div class="form-group" v-for="(formtype, idx) in businesssettingform.types" :key="idx">

                								<label v-if="formtype.type==='contact_address'">Contact address</label>
                								<input v-if="formtype.type==='contact_address'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="Address">

                                                <label v-if="formtype.type==='contact_phone'">Contact phone</label>
                                                <input v-if="formtype.type==='contact_phone'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="Address">

                                                <label v-if="formtype.type==='contact_email'">Contact email</label>
                                                <input v-if="formtype.type==='contact_email'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="Address">
                							</div>
                							<div class="text-right">
                                                <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
                    	        	    	</div>
                						</form>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
                <div class="card">
    	            <div class="card-header">
    	            	<h6 class="fw-600 mb-0">Footer Bottom</h6>
                        <!-- <div  v-if="Router.options">
                        <div  v-if="Router.options.routes">
                            <div  v-for="(route, index) in Router.options.routes" :key="index">
                              <ul>
                                <router-link :to="route.path">
                                  <li>{{ route}}</li>
                                </router-link>
                              </ul>
                            </div>
                        </div>
                        </div> -->
    	            </div>
                    <form role="form" enctype="multipart/form-data"  ref="formContainer" @submit.prevent="updateBulkBusinesssetting()">
                        <div class="card-body">
                            <div class="card shadow-none bg-light"  v-for="(formtype, idx) in businesssettingform.types" :key="idx">
                                <div class="card-header" v-if="formtype.type==='frontend_copyright_text'">
  		            				<h6 class="mb-0">Copyright Widget</h6>
  		            			</div>
                                <div class="card-body" v-if="formtype.type==='frontend_copyright_text'">
                                    <div class="form-group">
                              			<label>Copyright Text</label>
                                          <quill-editor v-model:content="businesssettingform.types[idx].value" theme="snow" toolbar="full" content-type="html"
                                                          style="height: 156px">
                                          </quill-editor>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-none bg-light">
                              <div class="card-header">
		            				<h6 class="mb-0">Social Link Widget</h6>
		            			</div>
                              <div class="card-body">
                                <div class="form-group row" >
                                  <div class="col-md-9">
                                    <div class="form-group"  v-for="(formtype, idx) in businesssettingform.types" :key="idx">
                                        <label  for="show_social_links" v-if="formtype.type==='show_social_links'">Show Social Links</label>
                                        <Toggle class="ml-2" v-model="businesssettingform.types[idx].value" id="show_social_links"  v-if="formtype.type==='show_social_links'"
                                        @change="buttonchange($event, idx, formtype)"
                                        />
                                    </div>
                                 </div>
                                </div>
                                <div class="form-group">
                                    <label>Social Links</label>
                                    <div class="form-group"  v-for="(formtype, idx) in businesssettingform.types" :key="idx">
                                        <div class="input-group">
                                        <div class="input-group-prepend" v-if="formtype.type==='facebook_link'">
                                            <span v-if="formtype.type==='facebook_link'" class="input-group-text"><i class="bi bi-facebook " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='facebook_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='twitter_link'">
                                            <span v-if="formtype.type==='twitter_link'" class="input-group-text"><i class="bi bi-twitter " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='twitter_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='instagram_link'">
                                            <span v-if="formtype.type==='instagram_link'" class="input-group-text"><i class="bi bi-instagram " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='instagram_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='youtube_link'">
                                            <span v-if="formtype.type==='youtube_link'" class="input-group-text"><i class="bi bi-youtube " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='youtube_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='linkedin_link'">
                                            <span v-if="formtype.type==='linkedin_link'" class="input-group-text"><i class="bi bi-linkedin " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='linkedin_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='whatsapp_link'">
                                            <span v-if="formtype.type==='whatsapp_link'" class="input-group-text"><i class="bi bi-whatsapp " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='whatsapp_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='tiktok_link'">
                                            <span v-if="formtype.type==='tiktok_link'" class="input-group-text"><i class="bi bi-tiktok " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='tiktok_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='google_business_link'">
                                            <span v-if="formtype.type==='google_business_link'" class="input-group-text"><i class="bi bi-google " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='google_business_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">

                                        <div class="input-group-prepend" v-if="formtype.type==='pinterest_link'">
                                            <span v-if="formtype.type==='pinterest_link'" class="input-group-text"><i class="bi bi-pinterest " style="color: cornflowerblue;"></i></span>
                                        </div>
                                        <input v-if="formtype.type==='pinterest_link'" type="text" v-model="businesssettingform.types[idx].value" class="form-control" placeholder="http://">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
                        </div>
                     </div>
                   </form>
	            </div>
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</template>
<script>
import Breadcrumb from '../../includes/backend/breadcrumb.vue';
import Toggle from '@vueform/toggle'
import { useRoute, useRouter } from 'vue-router'
export default {
    name:'footersettings',
    components:{
        Breadcrumb,
        Toggle
    },
    data(){
        return{
            editmodeBusinesssetting:false,
            value: true,
            router:'',
            businesssettingform: new Form({
                  id:'',
                  type:'',
                  value:'',
                  routes:[],
                  formtypes: [
                      "footer_about_us_description",
                      "frontend_copyright_text",
                      "footer_logo",
                      "contact_address",
                      "contact_phone",
                      "contact_email",
                      "show_social_links",
                      "facebook_link",
                      "twitter_link",
                      "instagram_link",
                      "youtube_link",
                      "linkedin_link",
                      "whatsapp_link",
                      "tiktok_link",
                      "google_business_link",
                      "pinterest_link",
                    ],
                  types:[],
                  fetchurl:  '/api/businesssettings/fetch/' +this.$authid()+'/' +this.$authroleid(),
                  createurl: '/api/businesssetting/create/'+this.$authid()+'/' +this.$authroleid(),
                  updateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
                  updateroutesurl: '/api/businesssetting/updateroutes/'+this.$authid()+'/' +this.$authroleid(),
                  bulkupdateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid(),
            }),
        };
    },
    mounted() {
         this.loadBusinesssettings();
        //  console.log(this.businesssettingform.fetchurl)
        // const router = useRouter();
        // console.log("🚀 ~ file: footersettings.vue:234 ~ mounted ~ const router:", router)
        this.loadRouter(useRouter());
    },
    computed:{
        Company(){
            // return this.$store.getters.Company
        },
        Businesssettings(){
            return this.$store.getters.Businesssettings
        },
        Router(){
            return this.router;
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
        ChangeBrandLogo(event, idx, formtype) {
         let file = event.target.files[0];
         if (file.size > 1048576) {
           this.$toast.error({
               title:  'Oops...',
               message: 'The File you are uploading is larger than 2mbs!',
               position: 'top center',
               showDuration: 3000,
               timeOut: 3000,
               closeButton: true,
               showMethod: 'flip',
               hideMethod: 'hinge',
               color: 'red',
               delay: 0,
           })
         } else {
           let reader = new FileReader();
           reader.onload = event => {
               this.businesssettingform.types[idx].value = event.target.result
               this.businesssettingform.types[idx].image = true;
           //   this.businesssettingform.header_logo = event.target.result;
             // console.log(event.target.result)
           };
           reader.readAsDataURL(file);
         }
        },
        updateBrandLogo(businesssettingformheader_logo, idx) {
         console.log(businesssettingformheader_logo);
         let img = this.businesssettingform.types[idx].value;
         if (img == null) {
           return "/assets/images/empty.png";
           //  console.log('its reall null')
         } else {
           if (img.length > 100) {
             return this.businesssettingform.types[idx].value;
           } else {
             if (businesssettingformheader_logo) {
               return "/assets/images/" + businesssettingformheader_logo;
             } else {
               return "/assets/images/empty.png";
             }
           }
         }
        },
        buttonchange(event, idx, newvalue){
        console.log("🚀 ~ file: footersettings.vue:283 ~ buttonchange ~ event, idx:", event, idx, newvalue)
            this.businesssettingform.id    = newvalue.id;
            this.businesssettingform.type  = newvalue.type;
            this.businesssettingform.value = newvalue.value;
            this.updateBusinesssetting();
        },
        loadRouter(useRouter){
            this.router = useRouter;
            // console.log("🚀 ~ file: footersettings.vue:312 ~ loadRouter ~ this.router:", this.router)
            let routes = useRouter.options.routes;
            console.log("🚀 ~ file: footersettings.vue:317 ~ loadRouter ~ routes:", routes)
            let Unauthroutes = routes.filter(route => route.meta.requiresAuth === false)
            console.log("🚀 ~ file: footersettings.vue:319 ~ loadRouter ~ Unauthroutes:", Unauthroutes)

            Unauthroutes.forEach(unauthroute =>{
                let samplepath = {
                        name:unauthroute.name,
                        path:unauthroute.path,
                        meta_info:unauthroute.meta? unauthroute.meta.info:'empty',
                        meta_title:unauthroute.meta? unauthroute.meta.title:'empty',
                        meta_description:unauthroute.meta? unauthroute.meta.description:'empty',
                        meta_keywords:unauthroute.meta? unauthroute.meta.keywords:'empty',
                        meta_image:unauthroute.meta? unauthroute.meta.image:'empty',
                        meta_authentication:unauthroute.meta? unauthroute.meta.requiresAuth:'empty',
                    }
                    this.businesssettingform.routes.push(samplepath);
                });
                console.log("🚀 ~ file: footersettings.vue:331 ~ loadRouter ~ this.businesssettingform.routes:", this.businesssettingform.routes)
                this.updateroutes();
        },
        updateroutes(){
            this.$store.dispatch("updateBusinesssettingroutes", this.businesssettingform)
                .then((response)=>{
                    this.Success(response);
                })
                .catch((error)=>{
                    this.Error(error);
                })
        },
        loadBusinesssettings(){
            return this.$store.dispatch("Businesssettings", this.businesssettingform.fetchurl)
            .then((response)=>{
                    this.editmodeBusinesssetting      = true;
                    this.EditBusinesssettingModal(response);
                })
                .catch((error)=>{
                    this.Error(error);
                });
        },
        EditBusinesssettingModal(Businesssettings){
            this.businesssettingform.formtypes.forEach(formtype => {
                let type = Businesssettings.find(businesssetting => businesssetting.type == formtype);
                    type.image = false;
                this.businesssettingform.types.push(type);
            });
        },
        updateBusinesssetting(){
            if(this.$authcheck()){
                let loader = this.Loading();
                // this.businesssettingform
                console.log("🚀 ~ file: headersettings.vue:118 ~ updateBusinesssetting ~ businesssettingform:", this.businesssettingform)
                this.$store.dispatch("updateBusinesssetting", this.businesssettingform)
                .then((response)=>{
                    loader.hide();
                    this.editmodeBusinesssetting      = false;
                    this.Success(response);
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                })
            }
        },
        updateBulkBusinesssetting(){
            if(this.$authcheck()){
                let loader = this.Loading();
                // this.businesssettingform
                console.log("🚀 ~ file: headersettings.vue:118 ~ updateBusinesssetting ~ businesssettingform:", this.businesssettingform)
                this.$store.dispatch("updateBulkBusinesssetting", this.businesssettingform)
                .then((response)=>{
                    loader.hide();
                    this.editmodeBusinesssetting      = false;
                    this.Success(response);
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                })
            }
        },
    }
}
</script>

<style src="@vueform/toggle/themes/default.css"></style>
