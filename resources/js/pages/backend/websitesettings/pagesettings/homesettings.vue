<template>
    <breadcrumb/>
    <div class="content">
       <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <form role="form" @submit.prevent="updateHomePage()" >
                        <div class="card-header">
                	    	<h6 class="mb-0">Home Page Banner Sliders</h6>
                	    </div>
                        <div class="card-body">
                            <div class="form-group row border-top border-bottom" v-for="(input, idx) in pageform.inputs" :key="idx">
        			    		<div class="col-md-3 form-group">
                                        <label class="logo" for="r" >{{'Slide '}} {{1 + idx}}</label>
                                        <input @change="ChangeBrandLogo($event, idx, 'banner')" type="file"  class="form-control">
                                        <img :src="updateBrandLogo(pageform.inputs[idx].banner, idx, 'banner')" alt="" style="width: 200px;" required>
                                </div>
        			    		<div class="col-md-4 form-group">
                                        <label class="logo" for="r" >Description</label>
                                        <textarea v-model="pageform.inputs[idx].description" type="text"  class="form-control"
                                            :class="{ 'is-invalid': pageform.errors.has() }" required>
                                        </textarea>
                                </div>
        			    		<div class="col-md-3 form-group">
                                        <label class="logo" for="r" >URL</label>
                                        <!-- <input v-model="pageform.inputs[idx].url" type="text"  class="form-control"
                                            :class="{ 'is-invalid': pageform.errors.has() }" required> -->
                                            <Multiselect
                                              v-model="pageform.inputs[idx].url"
                                              :mode="'single'"
                                              :options="Urls"
                                              :placeholder="'Select  Url'"
                                              :valueProp="'url'"
                                              :trackBy="'idx'"
                                              :label="'name'"
                                              @select="checkselect($event, idx)"
                                            />
                                </div>
                                <label class="col-md-2 mt-4" >
                                    <button type="button" id="remove_fields" :class="loadclass()" class="text-green-600 border-green-200
                                            hover:bg-green-600 focus:ring-green-600 " @click="removeInput(idx)">
                                            <i class="fa fa-minus"></i> Remove Field
                                    </button>
                                </label>
                            </div>
                            <div class="controls ml-2">
                                <button type="button" id="remove_fields" :class="loadclass()" class="mb-2 text-green-600 border-green-200
                                        hover:bg-green-600 focus:ring-green-600 " @click="loadnewInput()">
                                        <i class="fa fa-plus"></i> Add More
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card shadow-none bg-light">
                	    		<div class="card-header">
                	    			<h6 class="mb-0">Search Engine Optimization</h6>
                	    		</div>
                	    		<div class="card-body">
                                    <div class="form-group row" >
                                        <label class="col-md-3 col-from-label" for="meta_title">Meta Title</label>
                        				<div class="col-md-8">
                                            <div class="form-group">
                                                <input  type="text" v-model="pageform.meta_title" class="form-control">
                                            </div>
                                        </div>
                                        <label class="col-md-3 col-from-label" for="keyword">Meta Keywords</label>
                        				<div class="col-md-8">
                                            <div class="form-group">
                                                <input  type="text" v-model="pageform.keywords" class="form-control">
                                            </div>
                                        </div>
                                        <label class="col-md-3 col-from-label" for="meta_description">Meta Description</label>
                        				<div class="col-md-8">
                                            <div class="form-group">
                                                <quill-editor v-model:content="pageform.meta_description" theme="snow" toolbar="full" content-type="html"
                                                                style="height: 156px">
                                                </quill-editor>
                                            </div>
                                        </div>
                                        <label class="col-md-3 col-from-label" >Meta Image</label>
                        			    <div class="col-md-8" >
                                            <div class="form-group">
                                                <label class="logo form-control">Browse</label>
                                                <input @change="ChangeBrandLogo($event, 'idx', 'meta_image')" type="file" class="form-control">
                                                <img :src="updateBrandLogo(pageform.meta_image, 'idx', 'meta_image')" alt="" style="width: 200px;" >
                                            </div>
                                        </div>
                                    </div>
                	    		</div>
                	    	</div>
                        </div>
                        <div class="border-top pt-3">
        			        <div class="text-right mb-4">
                                <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
        	    	    	</div>
            		    </div>
            	    </form>
             </div>
          </div>
          <!-- /.row -->
          </div>
       <!-- /.container-fluid -->
       </div>
    </div>
 </template>
 <script>
    import Breadcrumb from '../../../includes/backend/breadcrumb.vue';
    import Toggle from '@vueform/toggle'
    export default {
        name:'homepagesettings',
        components:{
            Breadcrumb,
            Toggle
        },
        data(){
            return{
                    urls:[],
                    Businesssettings:'',
                pageform: new Form({
                      id:this.$route.params.param,
                      meta_title:'',
                      meta_image:'',
                      keywords:'',
                      meta_description:'',
                      routes:[],
                      inputs:[],
                      fetchurl:  '/api/pages/fetch/' +this.$authid()+'/' +this.$authroleid(),
                      createurl: '/api/page/create/'+this.$authid()+'/' +this.$authroleid(),
                      updateurl: '/api/page/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
                      autoupdateurl: '/api/page/autoupdate/'+this.$authid()+'/' +this.$authroleid(),
                }),
                businesssettingform: new Form({
                  fetchurl:  '/api/businesssettings/fetch/' +this.$authid()+'/' +this.$authroleid(),
                  createurl: '/api/businesssetting/create/'+this.$authid()+'/' +this.$authroleid(),
                  updateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
            }),
            };
        },
        mounted() {
            //  this.loadnewInput();
             this.loadPage();
        },
        computed:{
            Urls(){
                return this.urls;
            },
        },
        methods:{
            checkselect($event, idx){
                console.log("🚀 ~ file: homesettings.vue:151 ~ checkselect ~ $event, idx:", $event, idx)
                console.log("🚀 ~ file: this.pageform.inputs:", this.pageform.inputs)
            },
            loadnewInput(){
                let emptyinput ={
                  // id:'',
                  banner:'',
                  description:'',
                  url:'',
                };
                this.pageform.inputs.push(emptyinput);
            },
            removeInput(idx){
                 this.pageform.inputs.splice(idx, 1);
            },
            submit(){
             for (var key of Object.keys(this.values)) {
                  console.log(key + " -> " + this.values[key])
              }
            },
            ChangeBrandLogo(event, idx, type) {
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
                    if(type == 'banner'){
                        this.pageform.inputs[idx].banner = event.target.result;
                    }else{
                        this.pageform.meta_image = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
              }
            },
            updateBrandLogo(pageformheader_logo, idx, type) {
            //   console.log(this.pageform.inputs);
              console.log("🚀 ~ file: homesettings.vue:150 ~ updateBrandLogo ~ this.pageform.inputs:", this.pageform.inputs, idx)
              let img = '';
              if(type == 'banner'){
                img = this.pageform.inputs[idx].banner;
              }else{
                img = this.pageform.meta_image;
              }

              if (img == null) {
                return "/assets/images/empty.png";
                //  console.log('its reall null')
              } else {
                if (img.length > 100) {
                  return img;
                } else {
                  if (pageformheader_logo) {
                    return "/assets/images/" + pageformheader_logo;
                  } else {
                    return "/assets/images/empty.png";
                  }
                }
              }
            },
            updateroutes(){
                this.$store.dispatch("updatePageroutes", this.pageform)
                    .then((response)=>{
                        this.Success(response);
                    })
                    .catch((error)=>{
                        this.Error(error);
                    })
            },
            loadPage(){
               this.$store.dispatch("Page", this.pageform.id)
                .then((response)=>{
                        this.EditPage(response);
                    })
                    .catch((error)=>{
                        this.Error(error);
                    });
            },
            EditPage(page){
                console.log("🚀 ~ file: homesettings.vue:223 ~ EditPage ~ page:", page)
                this.pageform.meta_title       = page.meta_title;
                this.pageform.meta_image       = page.meta_image;
                this.pageform.keywords         = page.keywords;
                this.pageform.meta_description = page.meta_description;
                this.loadBusinesssettings();
                this.loadBusinesssettingsUrl();
            },
            loadBusinesssettings(){
                this.$store.dispatch("Businesssettings", this.businesssettingform.fetchurl)
                .then((response)=>{
                    this.Businesssettings = response;
                        var homapagesliders       = this.Businesssettings.find(businesssetting => businesssetting.type == 'home_slider_images');
                        var arrayhomapagesliders  = JSON.parse(homapagesliders.value);
                         if(!_.isEmpty(arrayhomapagesliders)){
                            arrayhomapagesliders.forEach(slide => {
                                let emptyinput ={
                                  banner: slide.banner,
                                  description:slide.description,
                                  url:slide.url,
                                };
                                this.pageform.inputs.push(emptyinput);
                            });
                         }else{
                            let emptyinput ={
                              banner:'',
                              description:'',
                              url:'',
                            };
                            this.pageform.inputs.push(emptyinput);
                         };
                    })
                    .catch((error)=>{
                        this.Error(error);
                    });
            },
            loadBusinesssettingsUrl(){
                this.$store.dispatch("Businesssettings", this.businesssettingform.fetchurl)
                .then((response)=>{
                        var urlcolumn        = this.Businesssettings.find(businesssetting => businesssetting.type == 'header_menu_links');
                        var urlheaders       = this.Businesssettings.find(businesssetting => businesssetting.type == 'header_menu_labels');
                        var arrayurls        = JSON.parse(urlcolumn.value);
                        var arrayurlheaders  = JSON.parse(urlheaders.value);
                        // console.log("🚀 ~ file: homesettings.vue:277 ~ .then ~ arrayurls:", arrayurls)
                        console.log("🚀 ~ file: homesettings.vue:277 ~ .then ~ arrayurlheaders:", arrayurlheaders)
                        // console.log("🚀 ~ file: response:", response)
                        arrayurls.forEach((url, index) => {
                            let urlobject = {
                                idx: index,
                                name: arrayurlheaders[index],
                                url:window.location.origin + url,
                            }
                            this.urls.push(urlobject);
                            console.log(urlobject);
                        });
                    })
                    .catch((error)=>{
                        this.Error(error);
                    });
            },
            updateHomePage(){
                if(this.$authcheck()){
                    let loader = this.Loading();
                    this.$store.dispatch("updatePage", this.pageform)
                    .then((response)=>{
                        loader.hide();
                        // this.loadPage();
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
 <style >
/* .btn {
     width: 50%;
    background: #3f51b5;
    color: white;
    border: 0;
    padding: 7px;
    border-radius: 5px;
}

.wrapper {
  width: 400px;
  margin: 40px auto;
  padding: 10px;
  border-radius: 5px;
  background: white;
  box-shadow: 0px 10px 40px 0px rgba(47,47,47,.1);
} */

/* input[type="text"]{
  padding: 10px;
  margin: 10px auto;
  display: block;
  border-radius: 5px;
  border: 1px solid lightgrey;
  background: none;
  width: 274px;
  color: black;
}

input[type="text"]:focus {
  outline: none;
}

.controls {
  width: 294px;
  margin: 15px auto;
}

#remove_fields {
  float: right;
}
.controls a i.fa-minus {
  margin-right: 5px;
} */

/* a {
  color: black;
  text-decoration: none;
}

h1 {
  text-align: center;
  font-size: 48px;
  color: #232c3d;
} */
</style>


