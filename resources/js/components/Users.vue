<template>
    <div class="container">
        <div class="row" v-if ="$gate.isAdmin()">
          <div class="col-md-12">
            <div class="card" >
              <div class="card-header">
                <h3 class="card-title" style="font-size: 45px;">Users Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click= "newModal"> Add New <i class="fa fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Registered At</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key ="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | MyDate}}</td>
                      
                      <td>
                          <a href="#" @click="editModal(user)">
                              <i class="fa fa-edit text-blue"></i>

                          </a>
                            /
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fa fa-trash text-red"></i>

                          </a>
                      </td>
                    </tr>
                    
                
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="users" 
                @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if ="!$gate.isAdmin()">
          <not-found></not-found>
        </div>
        <!-- Modal -->
<div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="AddNewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="AddNewLabel"><strong>Add New User</strong></h5>
        <h5 class="modal-title" v-show ="editmode" id="AddNewLabel"><strong>Update User's Info</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="editmode ? updateUser() : CreateUser()">
      <div class="modal-body">
        ...
         <div class="form-group">
     
      <input v-model="form.name" type="text" name="name"
      placeholder="Name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
      <has-error :form="form" field="name"></has-error>
    </div>

     <div class="form-group">
     
      <input v-model="form.email" type="text" name="email"
      placeholder="Email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
      <has-error :form="form" field="email"></has-error>
    </div>

       <div class="form-group">
     
      <textarea v-model="form.bio" id="bio" name="bio"
      placeholder="Short bio for User (Optional)"
        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>

    <div class="form-group">
     <select name="type" v-model="form.type" id="type" 
        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">

        <option value="">Select User Role</option>
        <option value="admin">Admin</option>
        <option value="user">Standard User</option>
        <option value="author">Author</option>

        </select>
      <has-error :form="form" field="type"></has-error>
    </div>

    
     <div class="form-group">
     
      <input v-model="form.password" type="password" name="password"
      placeholder="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
        <button v-show = "!editmode" type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {

      data(){
        return{
          editmode: false,
          users: {},
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


      methods: {

        getResults(page = 1) {
			    axios.get('api/user?page=' + page)
				    .then(response => {
				      	this.users = response.data;
			  	});
	  	},
	

        updateUser(){
          this.$Progress.start();
          //console.log('Editingdata');
          this.form.put('api/user/' + this.form.id)
          .then(()=> {
               Fire.$emit('AfterCreated');
              Swal.fire(
                'Updated!',
                'Information has been Updated',
                'success'
              )
                $('#AddNew').modal('hide'); 
          })
          .catch(()=> {
            this.$Progress.fail();
          });
        },

        

         editModal(user) {
           this.editmode = true;
          this.form.reset();
        $('#AddNew').modal('show'); 
        this.form.fill(user); 
        },

        newModal() {
          this.editmode= false;
          this.form.reset();
        $('#AddNew').modal('show');  
        },
        
        deleteUser(id) {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {

            //send request to the server
              if (result.value) {
            this.form.delete('api/user/'+ id).then(()=> {
               Fire.$emit('AfterCreated');
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
           

            }).catch(()=> {
              swal("Failed!","There was something wrong" , "warning");
            });
             }

           
          })
        },
        
        loadUsers(){
          if(this.$gate.isAdmin()){
            axios.get("api/user"). then(({ data }) => (this.users = data));
          }
        
      },
        CreateUser(){
          this.$Progress.start();
          this.form.post('api/user')

          .then(() => {
             Fire.$emit('AfterCreated');


          $('#AddNew').modal('hide')
          Toast.fire({
            icon: 'success',
            title: 'User Created successfully'
            })
          this.$Progress.finish();
          })

          .catch(() => {

          })

          
          
         
        }
      },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreated',  () => {
              this.loadUsers();
            })
           // setInterval(() => this.loadUsers(),3000);
        }
    }
</script>
