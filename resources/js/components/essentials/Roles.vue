
<script>
export default {
  methods: {
    $hasrole(roleName) {
      let Roles = this.$store.getters.AuthUserRoles;
      if (Array.isArray(roleName) == true) {
        return roleName.some(ele => Roles.includes(ele));
      } else {
        return Roles.indexOf(roleName) !== -1;
      }
    },
    $can(permissionName) {
      let Permissions = this.$store.getters.AuthUserPermissions;
      if (Array.isArray(permissionName) == true) {
        return permissionName.some(ele => Permissions.includes(ele));
      } else {
        return Permissions.indexOf(permissionName) !== -1;
      }
    },
    $acronym(){
        const institution = this.$authinstitution();
        const acronym = institution.acronym.toUpperCase();
        return acronym;
    },
    $acronymlower(){
        const institution = this.$authinstitution();
        const acronym = institution.acronym.toLowerCase();
        return acronym;
    },
    $routename(){
        return this.$route.name;
    },
    $dashboard(){
        if(this.$authcheck()){
            if(this.$hasrole('Superadmin','Admin')){
                this.$store.dispatch('urlUpdate', 'system');
                this.$store.dispatch('urlroleUpdate', 'system');
               return this.$store.getters.AuthDashboard;
            }
            if(this.$hasrole(['Institution Superadmin', 'Institution Admin'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'institution');
                return this.$store.getters.AuthDashboard;
            }
            if(this.$hasrole(['Investigator'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'investigator');
                return this.$store.getters.AuthDashboard;
            }
            if(this.$hasrole(['Supervisor'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'supervisor');
                return this.$store.getters.AuthDashboard;
            };
            if(this.$hasrole(['Team Leader'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'teamleader');
                return this.$store.getters.AuthDashboard;
            };
            if(this.$hasrole(['Surveyor'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'surveyor');
                return this.$store.getters.AuthDashboard;
            };
            if(this.$hasrole(['Participant'])){
                this.$store.dispatch('urlUpdate', 'institution');
                this.$store.dispatch('urlroleUpdate', 'participant');
                return this.$store.getters.AuthDashboard;
            };
        }else{
            window.location.replace('/');
        }
    },
    $routename(){
        return this.$route.name;
    },
    $businesssetting(type){
        let Businesssettings = this.$store.getters.Businesssettings;
        // if (Businesssettings.isArray) {
            let response = Businesssettings.find(businesssetting => businesssetting.type === type);
            return response;
        // }
    }
  }
};
</script>




