<template>
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ Messages.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item" v-for="message in Messages" :key="message.id">
            <!-- Message Start -->
            <div class="media" >
              <img src="/assets/themes/adminlte/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{message.recipient.full_name }}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm"><text-clamp :text='message.message' :max-lines='1'  container-width='240px' style="width:240px" /></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <timeago :datetime="message.created_at"/> /></p>
              </div>
              <div class="dropdown-divider"></div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <router-link :to="{name: 'Messages'}" class="dropdown-item dropdown-footer">See All Messages</router-link>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ Notifications.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{Notifications.length}} Notifications</span>
          <div class="dropdown-divider"></div>
          <router-link :to="{name: 'Notifications'}" class="dropdown-item" v-for="notification in Notifications" :key="notification">
            <i class="fas fa-envelope mr-2"></i> {{ Notifications.length }} new
            <span class="float-right text-muted text-sm" v-if="notification"><timeago :datetime="notification.created_at"/></span>
          </router-link>
          <div class="dropdown-divider"></div>
          <!-- <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> -->
          <div class="dropdown-divider"></div>
          <router-link :to="{name: 'Notifications'}" class="dropdown-item dropdown-footer">See All Notifications</router-link>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <a v-if="$authcheck()"   href="#"  class="nav-link" title="Logout" @click.prevent="logout()">
          <i class="fas fa-sign-out-alt" ></i> Logout
        </a>
      </li>
    </ul>
</template>
    <script>
    export default {
        name:'headerrightbar',
        components:{
        },
        data(){
            return{
                fetchurl:  '/api/messages/fetch/' ,
                notificationfetchurl:  '/api/notifications/fetch/' ,
            };
        },
        mounted() {

             this.loadmessages();
              this.loadnotifications();
        },
        computed:{
            Notifications(){
            return this.$store.getters.Notifications
        },
            Messages(){
                return this.$store.getters.Messages
            },
        },
        methods:{
            loadmessages(){
                return this.$store.dispatch("Messages", this.fetchurl);
            },
            loadnotifications(){
            return this.$store.dispatch("Notifications", this.notificationfetchurl);
        },
            logout(){
                console.log(this.$authcheck(), 'this.$authcheck()')
              if (this.$authcheck()) {
                this.$store.dispatch("logout")
                    .then((response)=>{
                        window.location.replace('/');
                    })
              } else {
                window.location.replace('/');
              }
            },
            Loadlogo(photo) {
              if (photo) {
                return "/themes/frontend/assets/images/" + photo;
                // return "/assets/img/" + photo;
              } else {
                return "/assets/img/empty.png";
              }
            },
        }
    }
    </script>

    <style>

    </style>
