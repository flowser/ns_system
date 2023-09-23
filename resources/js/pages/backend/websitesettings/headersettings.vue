<template>
    <breadcrumb/>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
        		<div class="card">
        			<div class="card-header">
        				<h6 class="mb-0">Header Setting</h6>
        			</div>
        			<div class="card-body">
        				<form role="form" enctype="multipart/form-data" class="vld-parent" ref="formContainer" @submit.prevent="updateBusinesssetting()" >
                            <div class="form-group row" v-for="(formtype, idx) in businesssettingform.types" :key="idx">
                                <label class="col-md-3 col-from-label"  v-if="formtype.type==='header_logo'">Header Logo</label>
        						<div class="col-md-8"  v-if="formtype.type==='header_logo'">
                                    <div class="form-group">
                                        <label class="logo form-control" :for="formtype.type" >Browse</label>
                                        <input @change="ChangeBrandLogo($event, idx)" type="file" :name="formtype.type" :id="formtype.type" class="form-control"
                                            :class="{ 'is-invalid': businesssettingform.errors.has(formtype.type) }" hidden>
                                        <img :src="updateBrandLogo(businesssettingform.types[idx].value, idx)" alt="" style="width: 57%;" >
                                    </div>
                                </div>
                                <label class="col-md-3 col-from-label" v-if="formtype.type==='helpline_number'">Help Line Number</label>
        						<div class="col-md-8"  v-if="formtype.type==='helpline_number'">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Contact Phone" v-model="businesssettingform.types[idx].value" >
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</template>
<script>
import Breadcrumb from '../../includes/backend/breadcrumb.vue'
export default {
    name:'pagessettings',
    components:{
        Breadcrumb
    },
    data(){
        return{
            editmodeBusinesssetting:false,
            businesssettingform: new Form({
                  formtypes: ["helpline_number", "header_logo"],
                  types:[],
                  fetchurl:  '/api/businesssettings/fetch/' +this.$authid()+'/' +this.$authroleid(),
                  createurl: '/api/businesssetting/create/'+this.$authid()+'/' +this.$authroleid(),
                  updateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
            }),
        };
    },
    mounted() {
         this.loadBusinesssettings();
         console.log("🚀 ~ this.$businesssetting('helpline_number'):", this.$businesssetting('helpline_number'))

    },
    computed:{
        Company(){
            // return this.$store.getters.Company
        },
        Businesssettings(){
            return this.$store.getters.Businesssettings
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
        loadBusinesssettings(){
            return this.$store.dispatch("Businesssettings", this.businesssettingform.fetchurl)
            .then((response)=>{
                    this.editmodeBusinesssetting      = true;
                    this.EditBusinesssettingModal(response);
                })
                .catch((error)=>{
                    this.Error(error);
                })
            ;
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

<style>
label .logo
{
  background-color: indigo;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}

</style>
