

<script>
export default {
  methods: {
    Error(error){
        toast.fire({
          icon: 'error',
          title: "check error"
        });
    },
    Error2(error){
        toast.fire({
          icon: error.icon,
          title: error.title,
          text: error.text,
        //   footer:error.footer,
          position: error.position,
          timer: error.timer,
          customClass: {
            //   container: error.customClass.container,
            //   popup: error.customClass.popup,
            //   header: error.customClass.header,
              title: error.customClass.title,
              text: error.customClass.text,
            //   closeButton: error.customClass.closeButton,
              icon: error.customClass.icon,
            //   image: error.customClass.image,
            //   content: error.customClass.content,
            //   htmlContainer: error.customClass.htmlContainer,
            //   input: error.customClass.input,
            //   inputLabel: error.customClass.inputLabel,
            //   validationMessage: error.customClass.validationMessage,
            //   actions: error.customClass.actions,
            //   confirmButton: error.customClass.confirmButton,
            //   denyButton: error.customClass.denyButton,
            //   cancelButton: error.customClass.cancelButton,
            //   loader: error.customClass.loader,
            //   footer: error.customClass.footer,
              timerProgressBar: error.customClass.timerProgressBar,
            }
        })
    },
    UnauthorizedError2(error){
        toast.fire({
           icon: 'error',
          title: error.title,
          text: error.text,
        //   footer:error.footer,
          position: 'center',
          timer: 6000,
          customClass: {
            //   container: error.customClass.container,
            //   popup: error.customClass.popup,
            //   header: error.customClass.header,
              title: 'text-red',
              text: 'text-red',
            //   closeButton: error.customClass.closeButton,
              icon: 'red',
            //   image: error.customClass.image,
            //   content: error.customClass.content,
            //   htmlContainer: error.customClass.htmlContainer,
            //   input: error.customClass.input,
            //   inputLabel: error.customClass.inputLabel,
            //   validationMessage: error.customClass.validationMessage,
            //   actions: error.customClass.actions,
            //   confirmButton: error.customClass.confirmButton,
            //   denyButton: error.customClass.denyButton,
            //   cancelButton: error.customClass.cancelButton,
            //   loader: error.customClass.loader,
            //   footer: error.customClass.footer,
              timerProgressBar: 'text-red',
            }
        });
        // this.status
    },
    BranchselectionError(error){
        toast.fire({
          icon: error.icon,
          title: error.title,
          text: error.text,
        //   footer:error.footer,
          position: error.position,
          timer: error.timer,
          customClass: {
            //   container: error.customClass.container,
            //   popup: error.customClass.popup,
            //   header: error.customClass.header,
              title: error.customClass.title,
              text: error.customClass.text,
            //   closeButton: error.customClass.closeButton,
              icon: error.customClass.icon,
            //   image: error.customClass.image,
            //   content: error.customClass.content,
            //   htmlContainer: error.customClass.htmlContainer,
            //   input: error.customClass.input,
            //   inputLabel: error.customClass.inputLabel,
            //   validationMessage: error.customClass.validationMessage,
            //   actions: error.customClass.actions,
            //   confirmButton: error.customClass.confirmButton,
            //   denyButton: error.customClass.denyButton,
            //   cancelButton: error.customClass.cancelButton,
            //   loader: error.customClass.loader,
            //   footer: error.customClass.footer,
              timerProgressBar: error.customClass.timerProgressBar,
            }
        })

    },
    Success(response){
        toast.fire({
          icon: 'success',
          title: response.data.status,
          message: response.data.status
        });
    },
    Loading(){
        return this.$loading.show({
            // Optional parameters
            // container: '',
            canCancel: true,
            // onCancel: this.Error(error),
            color: '#000000',
            loader: 'bars',
            width: 64,
            height: 64,
            backgroundColor: '#ffffff',
            opacity: 0.5,
            zIndex: 999,
        });
    },
    CourseEmptyCheck(CourseToast, Courses, alertcoursetoast){
        this.$toast.clear();
        this.$store.commit('clearcoursetoast', { root: true })
            if(!Courses.length){
                var data = {
                    index: 0,
                    id: null,
                    title: 'You have No Courses Available',
                    name: 'Course',
                    action: 'Create Your Own Course',
                    model: "Course",
                    routename: 'Lecturer Courses',
                    redirect: this.$dashboard(),
                    parentid: null,
                    childid: null,
                    course: null,
                    editmode: false,
                }
                var content = {
                     component: alertcoursetoast,
                     props: {
                         CourseToast : data,
                     },
                     listeners:{
                         respondCourseLinkClicked:(event, data)=>{
                           this.redirectCourseRoute(event, data);
                         }
                     }
                };
                var id = this.$toast.error(content,
                    {
                        position: "bottom-right",
                        timeout: 0 ,
                        closeOnClick: false,
                        icon: 'fas fa-exclamation-triangle fa-2x',
                        newestOnTop: false,
                    }
                );
                this.$store.commit('coursetoast', data, { root: true })
            }
    },
    redirectCourseRoute(event, load){
        console.log('2 event, load', event, load)
        let loader = this.Loading();
        const data = {
            id:       load.childid,
            parentid: load.parentid,
            course:   load.course,
            model:    load.model,
            redirect: load.redirect,
            editmode: load.editmode,
        }
        this.$store.dispatch('pageData', data)
        .then((response) => {
            loader.hide();
            Vue.nextTick(function(){
                 this.$router.push({ name: load.routename});
            }.bind(this));
        })
        .catch((error) => {
            loader.hide();
            this.Error(error);
        });
    },
    CoursebranchEmptyCheck(Coursebranches, alertcoursebranchtoast){
        if(!Coursebranches.length){
            const content = {
                 component: alertcoursebranchtoast,
                 props: {
                      title: 'You have No Course Branches Available',
                      name: 'Coursebranch',
                      action: 'Create Your Own Coursebranch',
                      data:{
                          parentid: null,
                          childid: null,
                          coursebranch: null,
                          model: "Coursebranch",
                          routename: 'Lecturer Coursebranches',
                          redirect: this.$dashboard(),
                          editmode: false,
                      }
                 },
                 listeners:{
                     respondCoursebranchLinkClicked:(load)=>{
                       this.redirectCoursebranchRoute(load);
                     }
                 }
            };
            this.$toast.error(content,
                {
                    position: "bottom-right",
                    timeout: 0 ,
                    closeOnClick: true,
                    icon: 'fas fa-exclamation-triangle fa-2x',
                    newestOnTop: false,
                }
            );
        }
    },
    redirectCoursebranchRoute(load){
        let loader = this.Loading();
        const data = {
            id:       load.childid,
            parentid: load.parentid,
            coursebranch:   load.coursebranch,
            model:    load.model,
            redirect: load.redirect,
            editmode: load.editmode,
        }
        this.$store.dispatch('coursebranchData', data)
        .then((response) => {
            loader.hide();
            Vue.nextTick(function(){
                 this.$router.push({ name: load.routename});
            }.bind(this));
        })
        .catch((error) => {
            loader.hide();
            this.Error(error);
        });
    },


    loadclass(){
        let value = "px-4 py-1 text-sm text-green-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2";
        return value;
    },

  },
};
</script>


