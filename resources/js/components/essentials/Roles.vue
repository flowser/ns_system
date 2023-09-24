
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
            return this.$store.getters.AuthDashboard;
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




