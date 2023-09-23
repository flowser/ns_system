

<script>
export default {
  methods: {
    $authcheck() {
      return this.$store.getters.Auth;
    },
    $authuser() {
      return this.$store.getters.AuthUser;
    },
    $authid() {
      return this.$store.getters.AuthUserId;
    },    
    $authrole() {
      return this.$store.getters.AuthUserRoles[0];
    },
    $authroleid() {
      return this.$authrole().toLowerCase();
    },
  }
};
</script>


