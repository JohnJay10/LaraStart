<style>
.widget-user-header{
background-position: center center;
background-size: cover;
height: 600px;
}
.widget-user .widget-user-header{
  height:350px;
}

.widget-user-username h2{
 font-family: Arial, Helvetica, sans-serif;
 font-weight: bold;
 font-size: 1.3rem; 
}

.widget-user .widget-user-image > img {
  height:200px;
  width: 150px;
  background-image: center;
}

.widget-user .widget-user-username {
  font-size: 50px;
}
</style>

<template>
    <div class="container">
        
        <div class="row ">
            <div class="col-md-12 mt-3">
               <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./images/bg-01.jpg') ">
                <h2 class="widget-user-username text-right" >{{this.form.name}}</h2>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <!-- <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                   
                  </div> -->
                  <!-- /.col -->
                  <!-- <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                   
                  </div> -->
                  <!-- /.col -->
                  <!-- <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                   
                  </div> -->
                  <!-- /.col -->
                </div>
                </div>
            </div>
                <!-- /.row -->
                
                <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                  <h3 class="text-center"><strong>Display User Acivity</strong></h3>
                  </div>
                  <!-- /.tab-pane -->
               
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group ">
                        <label  for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                          <input  v-model="form.name" type="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                          <input v-model="form.email" 
                          type="email" class="form-control"
                          :class="{ 'is-invalid': form.errors.has('email') }" 
                          id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      
                      <div class="form-group ">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                        <div class="col-sm-12">
                          <textarea  v-model="form.experience" class="form-control"   :class="{ 'is-invalid': form.errors.has('experience') }" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group ">
                        <label for="photo" class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-12">
                          <input  type="file"  @change= "updatePhoto" name="photo" class="form-input" >
                        </div>
                      </div>

                      <div class="form-group ">
                        <label for="passpord" class="col-sm-2 control-label">Passport</label>
                        <div class="col-sm-12">
                          <input  type="password"  v-model="form.password" class="form-control"     id="passpord" placeholder="Passport">
                        </div>
                      </div>
                      
                      <div class="form-group ">
                        <div class="col-sm-offset-2 col-sm-12">
                          <button @click.prevent ="updateInfo" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>

              </div>
            </div>
           
        
    </div>
</template>

<script>
    export default {
        data() {
            return{
         form : new Form({
            id :'',
            name :'',
            email :'',
            password :'',
            type :'',
            bio :'',
            photo :''
          })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

      methods:{

        getProfilePhoto(){

          let photo = (this.form.photo.length > 200) ? this.form.photo: "./images/profile/" + this.form.photo;
          return photo;
        },

   
        updateInfo(){
         this.$Progress.start();
        this.form.put('api/profile' )

        .then(()=>{
          Fire.$emit('AfterCreated');

          Swal.fire(
                'Updated!',
                'Information has been Updated',
                'success'
              )
             this.$Progress.finish();

        })

        .catch(()=>{
          this.$Progress.fail();
        });
        },

        updatePhoto(e){
          
          //console.log('uploading');
        let file = e.target.files[0];
        console.log(file);
        let reader = new FileReader();
      if(file['size'] < 2111775){
         reader.onloadend = (file)=>{
           //console.log('RESULT', reader.result)
           this.form.photo = reader.result;
         }
          reader.readAsDataURL(file);
         console.log('uploaded')
      }else{


        
          Swal.fire ({
            type: 'error',
            title: 'Oops....',
            text: 'You are Uploading a Large File',
          })
      }
        
        }
      },
        
        created() {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill( data )));
        }
    }
</script>
