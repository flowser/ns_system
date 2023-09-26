<template>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <h5 class="card-title ml-4"> Messages</h5>
              <div class="card-body">
                <vue-good-table
                       :columns="Columns"
                       :rows="Messages"
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
                        <button :class="loadclass()" @click.prevent="NewmessageModal()" title="Add New message">Add New message  <i class="fas fa-plus fw"></i></button>
                       </template>
                       <template #table-column="props">
                             {{props.column.label}}
                       </template>
                       <template #table-row="props">
                         <span  v-if ="props.column.field == 'recipient'">
                             {{ props.row.recipient.full_name }}
                         </span>
                         <span v-if="props.column.field == 'created_at'">
                            <span class="text-green-101"><date-format :date="props.row.created_at" /></span>
                        </span>
                         <span  v-if ="props.column.field == 'action'">
                             <button @click="UpdatemessageModal(props.row)" :title="'Send '+ props.row.name" type="button"
                                    class="btn btn-danger " style=" cursor: pointer;">
                                New Message
                            </button>
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
    <div class="modal fade " id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content" >
                <form role="form" class="vld-parent" ref="formContainer" @submit.prevent="editmodemessage      ? updatemessage() : addmessage()" >
                    <div class="modal-body">
                        <div class="text-center">
                            <h2><label for="name" v-show="!editmodemessage     " class="uppercase col-form-label">New Message</label></h2>
                            <h2><label for="name" v-show="editmodemessage     " class="uppercase col-form-label">Send Message to {{ this.messageform.recipient  }}</label></h2>
                            <div class="alert alert-danger" v-if="messageform.errors.has('error')">
                                <div class="text-red" v-html="messageform.errors.get('error')"></div>
                             </div>
                        </div>
                         <div class="row">
                              <div class="col-md-12 form-group">
                                      <label for="value" class="uppercase col-form-label">Message</label>
                                      <input v-model="messageform.message" id="value" type="text" autocomplete="off" class="form-control" placeholder="Message" name="message" >
                                      <div class="text-red" v-if="messageform.errors.has('message')" v-html="messageform.errors.get('message')" />
                              </div>
                              <div class="col-md-12 form-group" v-show="!editmodemessage">
                                <label for="value" class="uppercase col-form-label">Recipient</label>
                                <select v-model="messageform.recipient_id" id="recipient_id">
                                    <option :value="null" disabled>Select a messageform</option>
                                    <option v-for="user in Users" :key="user.id" :value="user.id">{{ user.full_name }}</option>
                                </select>
                                <div class="text-red" v-if="messageform.errors.has('recipient_id')" v-html="messageform.errors.get('recipient_id')" />
                              </div>
                          </div>
                    </div>
                    <div v-show="!editmodemessage     " class="modal-footer">
                        <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                        <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Send</button>
                    </div>
                    <div v-show="editmodemessage     " class="modal-footer">
                        <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                        <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Send</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
</template>
<script>
export default {
    name:'messagesettings',
    components:{
    },
    data(){
        return{
            editmodemessage:false,
            messageform: new Form({
                  id:'',
                  message:'',
                  sender_id:'',
                  recipient_id:'',
                  recipient:'',
                  fetchurl:  '/api/messages/fetch/' ,
                  createurl: '/api/message/create',
                  updateurl: '/api/message/new/update/',
            }),
            columns:[
               {
                 label: 'Message',
                 field: 'message',
                 sortable: true,
                 hidden: false,
               },
               {
                 label: 'recipient',
                 field: 'recipient',
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
            usersfetchurl:'/api/fetch/users'
        };
    },
    mounted() {
        this.loadmessages();
        this.loadusers();

    },
    computed:{
        Messages(){
            return this.$store.getters.Messages
        },
        Users(){
            return this.$store.getters.Users
        },
        Columns() {
          return this.columns;
        },

    },
    methods:{
        Loadlogo(photo) {
        //   if (photo) {
        //     return "/themes/frontend/assets/images/" + photo;
        //     // return "/assets/img/" + photo;
        //   } else {
        //     return "/assets/img/empty.png";
        //   }
        },
        loadmessages(){
            return this.$store.dispatch("Messages", this.messageform.fetchurl);
        },
        loadusers(){
            return this.$store.dispatch("Users", this.usersfetchurl);
        },
        resetmessageform(){
            this.editmodemessage              = false;
            this.messageform.id               = '';
            this.messageform.message          = '';
            this.messageform.sender_id        = '';
            this.messageform.recipient_id     = '';
            this.messageform.recipient        = '';
        },
        NewmessageModal(message){
            this.resetmessageform();
            this.editmodemessage            = false;
            $('#messageModal').modal('show');
        },
        UpdatemessageModal(message){
            this.resetmessageform();
            this.editmodemessage              = true;
            this.messageform.id               = message.id;
            this.messageform.message          = '';
            this.messageform.sender_id        = message.sender_id;
            this.messageform.recipient_id     = message.recipient_id;
            this.messageform.recipient        = message.recipient.full_name;
            $('#messageModal').modal('show');
        },
        addmessage(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("addMessage", this.messageform)
                .then((response)=>{
                    loader.hide();
                    this.editmodemessage      = false;
                    this.resetmessageform();
                    toast.fire({
                      icon: 'success',
                      title: "Message Sent Successfuly"
                    });
                    $('#messageModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#messageModal').modal('show')
                })
            }
        },
        updatemessage(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("updateMessage", this.messageform)
                .then((response)=>{
                    loader.hide();
                    this.editmodemessage      = false;
                    this.resetmessageform();
                    toast.fire({
                      icon: 'success',
                      title: "Message Sent Successfuly"
                    });
                    $('#messageModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#messageModal').modal('show')
                })
            }
        },

    }
}
</script>

<style>

</style>



