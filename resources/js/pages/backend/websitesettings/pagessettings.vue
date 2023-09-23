<template>
    <breadcrumb/>
    <div class="content">
       <div class="container-fluid">
          <div class="row">
             <div class="col-lg-12">
                <div class="card card-primary card-outline">
                   <div class="card-body">
                    <vue-good-table
                       :columns="Columns"
                       :rows="Pages? Pages:[]"
                       max-height="600px"
                       :fixed-header="true"
                       :line-numbers="true"
                       :rtl="false"
                       :select-options="{ enabled: false }"
                       :search-options="{
                         enabled: true,
                         trigger: 'enter',
                       }"
                       :pagination-options="{
                         enabled: true,
                         mode: 'records',
                         perPage: 10,
                       }"
                       styleClass="vgt-table condensed"
                       theme="nocturnal "
                       compactMode
                       >
                       <template #table-actions>
                        <!-- <button :class="loadclass()" @click.prevent="NewPageModal()" title="Add New Page">Add New Page  <i class="fas fa-plus fw"></i></button> -->
                       </template>
                       <template #table-column="props">
                             {{props.column.label}}
                       </template>
                       <template #table-row="props">
                         <span  v-if ="props.column.field == 'name'">
                             {{props.row.title}}
                         </span>
                         <span  v-else-if ="props.column.field == 'url'">
                             {{loadhost(props.row.path)}}
                         </span>
                         <span  v-else-if ="props.column.field == 'action'">
                             <span @click="EditPageModal(props.row)"   :title="'Edit '+ props.row.name"  class="text-warning" style="text-decoration: underline; cursor: pointer;">
                                   <i class="far fa-edit text-danger" aria-hidden="true"> </i>
                             </span>
                         </span>
                       </template>
                       <template #emptystate>
                      </template>
                </vue-good-table>
                   </div>
                </div>
                <!-- /.card -->
             </div>
          </div>
          <!-- /.row -->
       </div>
       <!-- /.container-fluid -->
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
                editmodePage:false,
                pageform: new Form({
                      id:'',
                      type:'',
                      routes:[],
                      fetchurl:  '/api/pages/fetch/' +this.$authid()+'/' +this.$authroleid(),
                      createurl: '/api/page/create/'+this.$authid()+'/' +this.$authroleid(),
                      updateurl: '/api/page/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
                      autoupdateurl: '/api/page/autoupdate/'+this.$authid()+'/' +this.$authroleid(),
                }),
                columns:[
                   {
                     label: 'Name',
                     field: 'name',
                     sortable: true,
                     hidden: false,
                   },
                   {
                     label: 'URL',
                     field: 'url',
                     sortable: true,
                     hidden: false,
                   },
                   {
                     label: 'Action',
                     field: 'action',
                     sortable: true,
                     hidden: false,
                   },
                ],
            };
        },
        mounted() {
             this.loadPages();
            //  console.log(this.pageform.fetchurl)
            // const router = useRouter();
            // console.log("🚀 ~ file: footersettings.vue:234 ~ mounted ~ const router:", router)
            // this.loadRouter(useRouter());
        },
        computed:{
            Pages(){
                return this.$store.getters.Pages
            },
            Router(){
                return this.router;
            },
            Columns() {
              return this.columns;
            },
        },
        methods:{
            loadhost(url){
                return window.location.origin + url;
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
                            meta_settings_page:unauthroute.meta? unauthroute.meta.settings_page:'empty',
                            meta_settings_params:unauthroute.meta? unauthroute.meta.settings_params:'empty',
                        }
                        this.pageform.routes.push(samplepath);
                    });
                    console.log("🚀 ~ file: footersettings.vue:331 ~ loadRouter ~ this.pageform.routes:", this.pageform.routes)
                    this.updateroutes();
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
            loadPages(){
               this.$store.dispatch("Pages", this.pageform.fetchurl)
                .then((response)=>{
                        // this.editmodePage      = true;
                        // this.EditPageModal(response);
                    })
                    .catch((error)=>{
                        this.Error(error);
                    });
            },
            EditPageModal(page){
                var pagename  = page.title + ' Settings';
                this.$router.push({ name: pagename, params: { param: page.slug } });
            },
            updatePage(){
                if(this.$authcheck()){
                    let loader = this.Loading();
                    // this.pageform
                    console.log("🚀 ~ file: headersettings.vue:118 ~ updatePage ~ pageform:", this.pageform)
                    this.$store.dispatch("updatePage", this.pageform)
                    .then((response)=>{
                        loader.hide();
                        this.editmodePage      = false;
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


