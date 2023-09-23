<template>
    <breadcrumb/>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <h5 class="card-title ml-4"> Business Settings</h5>
              <div class="card-body">
                <vue-good-table
                       :columns="Columns"
                       :rows="Businesssettings? Businesssettings:[]"
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
                         perPage: 5,
                       }"
                       styleClass="vgt-table condensed"
                       theme="nocturnal "
                       compactMode
                       >
                       <template #table-actions>
                        <button :class="loadclass()" @click.prevent="NewBusinesssettingModal()" title="Add New Businesssetting">Add New Businesssetting  <i class="fas fa-plus fw"></i></button>
                       </template>
                       <template #table-column="props">
                             {{props.column.label}}
                       </template>
                       <template #table-row="props">
                         <span  v-if ="props.column.field == 'action'">
                             <span @click="EditBusinesssettingModal(props.row)"   :title="'Edit '+ props.row.name"  class="text-warning" style="text-decoration: underline; cursor: pointer;">
                                   <i class="far fa-edit text-danger" aria-hidden="true"> </i>
                               </span>
                         </span>
                       </template>
                       <template #emptystate>
                      </template>
                </vue-good-table>
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- modal -->
    <div class="modal fade " id="BusinesssettingModal" tabindex="-1" role="dialog" aria-labelledby="BusinesssettingModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content" >
                <form role="form" class="vld-parent" ref="formContainer" @submit.prevent="editmodeBusinesssetting      ? updateBusinesssetting() : addBusinesssetting()" >
                    <div class="modal-body">
                        <div class="text-center">
                            <h2><label for="name" v-show="!editmodeBusinesssetting     " class="uppercase col-form-label">New Business Setting</label></h2>
                            <h2><label for="name" v-show="editmodeBusinesssetting     " class="uppercase col-form-label">Edit Business Setting</label></h2>
                            <div class="alert alert-danger" v-if="businesssettingform.errors.has('error')">
                                <div class="text-red" v-html="businesssettingform.errors.get('error')"></div>
                             </div>
                        </div>
                         <div class="row">
                              <div class="col-md-12 form-group">
                                      <label for="type" class="uppercase col-form-label">Type</label>
                                      <input v-model="businesssettingform.type" id="type" type="text" autocomplete="off" class="form-control" placeholder="Type" name="type" >
                                      <div class="text-red" v-if="businesssettingform.errors.has('type')" v-html="businesssettingform.errors.get('type')" />
                              </div>
                              <div class="col-md-12 form-group">
                                      <label for="value" class="uppercase col-form-label">Value</label>
                                      <input v-model="businesssettingform.value" id="value" type="text" autocomplete="off" class="form-control" placeholder="Last Name" name="value" >
                                      <div class="text-red" v-if="businesssettingform.errors.has('value')" v-html="businesssettingform.errors.get('value')" />
                              </div>
                          </div>
                    </div>
                    <div v-show="!editmodeBusinesssetting     " class="modal-footer">
                        <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                        <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Create</button>
                    </div>
                    <div v-show="editmodeBusinesssetting     " class="modal-footer">
                        <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                        <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
</template>
<script>
import Breadcrumb from '../../includes/backend/breadcrumb.vue'
export default {
    name:'Businesssettingsettings',
    components:{
        Breadcrumb
    },
    data(){
        return{
            editmodeBusinesssetting:false,
            businesssettingform: new Form({
                  id:'',
                  type:'',
                  value:'',
                  fetchurl:  '/api/businesssettings/fetch/' +this.$authid()+'/' +this.$authroleid(),
                  createurl: '/api/businesssetting/create/'+this.$authid()+'/' +this.$authroleid(),
                  updateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid()+ '/',
                  bulkupdateurl: '/api/businesssetting/update/'+this.$authid()+'/' +this.$authroleid(),
            }),
            columns:[
               {
                 label: 'Setting Type',
                 field: 'type',
                 sortable: true,
                 hidden: false,
               },
               {
                 label: 'Setting Value',
                 field: 'value',
                 sortable: true,
                 hidden: false,
               },
               {
                 label: 'Created At',
                 field: 'created_at',
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
        this.loadBusinesssettings();
        console.log("'+this.$authid()+'/' +this.$authroleid()",   this.$authid(), this.$authroleid())

    },
    computed:{
        Businesssettings(){
            return this.$store.getters.Businesssettings
        },
        Columns() {
          return this.columns;
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
        loadBusinesssettings(){
            return this.$store.dispatch("Businesssettings", this.businesssettingform.fetchurl);
        },
        resetbusinesssettingform(){
            this.editmodeBusinesssetting       = false;
            this.businesssettingform.id        ='';
            this.businesssettingform.type      ='';
            this.businesssettingform.value     ='';
        },
        NewBusinesssettingModal(businesssetting){
            this.resetbusinesssettingform();
            this.editmodeBusinesssetting            = false;
            $('#BusinesssettingModal').modal('show');
        },
        EditBusinesssettingModal(Businesssetting){
            this.resetbusinesssettingform();
            this.editmodeBusinesssetting              = true;
            this.businesssettingform.id               = Businesssetting.id;
            this.businesssettingform.type             = Businesssetting.type;
            this.businesssettingform.value            = Businesssetting.value;

            $('#BusinesssettingModal').modal('show');
        },
        addBusinesssetting(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("addBusinesssetting", this.businesssettingform)
                .then((response)=>{
                    loader.hide();
                    this.editmodeBusinesssetting      = false;
                    this.resetbusinesssettingform();
                    this.Success(response);
                    $('#BusinesssettingModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#BusinesssettingModal').modal('show')
                })
            }
        },
        updateBusinesssetting(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("updateBusinesssetting", this.businesssettingform)
                .then((response)=>{
                    loader.hide();
                    this.editmodeBusinesssetting      = false;
                    this.resetbusinesssettingform();
                    this.Success(response);
                    $('#BusinesssettingModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#BusinesssettingModal').modal('show')
                })
            }
        },
        DeleteBusinesssetting(Businesssetting){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.businesssettingform.id     = Businesssetting.id;
                this.businesssettingform.type   = Businesssetting.type;
                this.businesssettingform.value  = Businesssetting.value;
                this.$store.dispatch("deleteBusinesssetting", this.businesssettingform)
                .then((response)=>{
                    loader.hide();
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

</style>



