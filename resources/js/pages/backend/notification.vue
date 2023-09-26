<template>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <h5 class="card-title ml-4"> Notifications</h5>
              <div class="card-body">
                <vue-good-table
                       :columns="Columns"
                       :rows="Notifications"
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
                        <button :class="loadclass()" @click.prevent="NewnotificationModal()" title="Add New notification">Add New notification  <i class="fas fa-plus fw"></i></button>
                       </template>
                       <template #table-column="props">
                             {{props.column.label}}
                       </template>
                       <template #table-row="props">
                         <span  v-if ="props.column.field == 'notification'">
                             <span class="text-green">{{props.row.data.message}}</span>
                         </span>
                         <span  v-if ="props.column.field == 'read_at'">
                             <span class="text-green">{{props.row.read_at === null ? "Not Read": "Read"}}</span>
                         </span>
                         <span  v-if ="props.column.field == 'type'">
                             <span class="text-green">{{props.row.type}}</span>
                         </span>
                         <span v-if="props.column.field == 'created_at'">
                            <span class="text-green-101"><date-format :date="props.row.created_at" /></span>
                        </span>
                         <span  v-if ="props.column.field == 'action'">
                             <button @click="MarkRead(props.row)" :title="'Send '+ props.row.name" type="button"
                                    class="btn btn-danger " style=" cursor: pointer;">
                                Mark As Read
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
    <div class="modal fade " id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content" >
                <form role="form" class="vld-parent" ref="formContainer" @submit.prevent="editmodenotification      ? updatenotification() : addnotification()" >
                    <div class="modal-body">
                        <div class="text-center">
                            <h2><label for="name" v-show="!editmodenotification     " class="uppercase col-form-label">New Notification</label></h2>
                            <h2><label for="name" v-show="editmodenotification     " class="uppercase col-form-label">Send Notification to {{ this.notificationform.recipient  }}</label></h2>
                            <div class="alert alert-danger" v-if="notificationform.errors.has('error')">
                                <div class="text-red" v-html="notificationform.errors.get('error')"></div>
                             </div>
                        </div>
                         <div class="row">
                              <div class="col-md-12 form-group">
                                      <label for="value" class="uppercase col-form-label">Notification</label>
                                      <input v-model="notificationform.notification" id="value" type="text" autocomplete="off" class="form-control" placeholder="Notification" name="notification" >
                                      <div class="text-red" v-if="notificationform.errors.has('notification')" v-html="notificationform.errors.get('notification')" />
                              </div>
                              <div class="col-md-12 form-group" v-show="!editmodenotification">
                                <label for="value" class="uppercase col-form-label">Recipient</label>
                                <select v-model="notificationform.recipient_id" id="recipient_id">
                                    <option :value="null" disabled>Select a notificationform</option>
                                    <option v-for="user in Users" :key="user.id" :value="user.id">{{ user.full_name }}</option>
                                </select>
                                <div class="text-red" v-if="notificationform.errors.has('recipient_id')" v-html="notificationform.errors.get('recipient_id')" />
                              </div>
                          </div>
                    </div>
                    <div v-show="!editmodenotification     " class="modal-footer">
                        <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                        <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Send</button>
                    </div>
                    <div v-show="editmodenotification     " class="modal-footer">
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
    name:'notificationsettings',
    components:{
    },
    data(){
        return{
            editmodenotification:false,
            notificationform: new Form({
                  id:'',
                  notification:'',
                  sender_id:'',
                  recipient_id:'',
                  recipient:'',
                  fetchurl:  '/api/notifications/fetch/' ,
                  createurl: '/api/notification/create',
                  updateurl: '/api/notification/new/update/',
                  markReadurl: '/api/notification/markRead/',
            }),
            columns:[
               {
                 label: 'Notification',
                 field: 'notification',
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
                 label: 'Type',
                 field: 'type',
                 sortable: true,
                 hidden: false,
               },
               {
                 label: 'Status',
                 field: 'read_at',
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
        this.loadnotifications();
        this.loadusers();

    },
    computed:{
        Notifications(){
            return this.$store.getters.Notifications
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
        loadnotifications(){
            return this.$store.dispatch("Notifications", this.notificationform.fetchurl);
        },
        loadusers(){
            return this.$store.dispatch("Users", this.usersfetchurl);
        },
        resetnotificationform(){
            this.editmodenotification              = false;
            this.notificationform.id               = '';
            this.notificationform.notification     = '';
            this.notificationform.sender_id        = '';
            this.notificationform.recipient_id     = '';
            this.notificationform.recipient        = '';
        },
        NewnotificationModal(notification){
            this.resetnotificationform();
            this.editmodenotification            = false;
            $('#notificationModal').modal('show');
        },
        MarkRead(notification){
            if(this.$authcheck()){
                this.notificationform.id   = notification.id;
                let loader = this.Loading();
                this.$store.dispatch("markReadNotification", this.notificationform)
                .then((response)=>{
                    loader.hide();
                    this.editmodenotification      = false;
                    this.resetnotificationform();
                    toast.fire({
                      icon: 'success',
                      title: "Notification Marked Read Successfuly"
                    });
                    this.loadnotifications();
                    $('#notificationModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#notificationModal').modal('show')
                })
            }
        },
        addnotification(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("addNotification", this.notificationform)
                .then((response)=>{
                    loader.hide();
                    this.editmodenotification      = false;
                    this.resetnotificationform();
                    toast.fire({
                      icon: 'success',
                      title: "Notification Sent Successfuly"
                    });
                    $('#notificationModal').modal('hide')
                    this.loadnotifications();
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#notificationModal').modal('show')
                })
            }
        },
        updatenotification(){
            if(this.$authcheck()){
                let loader = this.Loading();
                this.$store.dispatch("updateNotification", this.notificationform)
                .then((response)=>{
                    loader.hide();
                    this.editmodenotification      = false;
                    this.resetnotificationform();
                    toast.fire({
                      icon: 'success',
                      title: "Notification Sent Successfuly"
                    });
                    $('#notificationModal').modal('hide')
                })
                .catch((error)=>{
                    loader.hide();
                    this.Error(error);
                    $('#notificationModal').modal('show')
                })
            }
        },

    }
}
</script>

<style>

</style>




