<template>
    <div class="container">
       <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
          <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

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
                      <!-- <th>Modify</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key ="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | MyDate}}</td>
                      
                      <!-- <td>
                          <a href="#" @click="editModal(user)">
                              <i class="fa fa-edit text-blue"></i>

                          </a>
                            /
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fa fa-trash text-red"></i>

                          </a>
                      </td> -->
                    </tr>
                    
                
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


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
        
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable ui-sortable">
            <!-- Custom tabs (Charts with tabs)-->
           
            <!-- /.card -->

            <!-- DIRECT CHAT -->
           
            <!--/.direct-chat -->

            <!-- TO DO List -->
            
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable ui-sortable">

            <!-- Map card -->
           
            <!-- /.card -->

            <!-- solid sales graph -->
         
            <!-- /.card -->
            
            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">May 2020</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="04/26/2020" class="day old weekend">26</td><td data-action="selectDay" data-day="04/27/2020" class="day old">27</td><td data-action="selectDay" data-day="04/28/2020" class="day old">28</td><td data-action="selectDay" data-day="04/29/2020" class="day old">29</td><td data-action="selectDay" data-day="04/30/2020" class="day old">30</td><td data-action="selectDay" data-day="05/01/2020" class="day">1</td><td data-action="selectDay" data-day="05/02/2020" class="day weekend">2</td></tr><tr><td data-action="selectDay" data-day="05/03/2020" class="day weekend">3</td><td data-action="selectDay" data-day="05/04/2020" class="day">4</td><td data-action="selectDay" data-day="05/05/2020" class="day">5</td><td data-action="selectDay" data-day="05/06/2020" class="day">6</td><td data-action="selectDay" data-day="05/07/2020" class="day">7</td><td data-action="selectDay" data-day="05/08/2020" class="day">8</td><td data-action="selectDay" data-day="05/09/2020" class="day active today weekend">9</td></tr><tr><td data-action="selectDay" data-day="05/10/2020" class="day weekend">10</td><td data-action="selectDay" data-day="05/11/2020" class="day">11</td><td data-action="selectDay" data-day="05/12/2020" class="day">12</td><td data-action="selectDay" data-day="05/13/2020" class="day">13</td><td data-action="selectDay" data-day="05/14/2020" class="day">14</td><td data-action="selectDay" data-day="05/15/2020" class="day">15</td><td data-action="selectDay" data-day="05/16/2020" class="day weekend">16</td></tr><tr><td data-action="selectDay" data-day="05/17/2020" class="day weekend">17</td><td data-action="selectDay" data-day="05/18/2020" class="day">18</td><td data-action="selectDay" data-day="05/19/2020" class="day">19</td><td data-action="selectDay" data-day="05/20/2020" class="day">20</td><td data-action="selectDay" data-day="05/21/2020" class="day">21</td><td data-action="selectDay" data-day="05/22/2020" class="day">22</td><td data-action="selectDay" data-day="05/23/2020" class="day weekend">23</td></tr><tr><td data-action="selectDay" data-day="05/24/2020" class="day weekend">24</td><td data-action="selectDay" data-day="05/25/2020" class="day">25</td><td data-action="selectDay" data-day="05/26/2020" class="day">26</td><td data-action="selectDay" data-day="05/27/2020" class="day">27</td><td data-action="selectDay" data-day="05/28/2020" class="day">28</td><td data-action="selectDay" data-day="05/29/2020" class="day">29</td><td data-action="selectDay" data-day="05/30/2020" class="day weekend">30</td></tr><tr><td data-action="selectDay" data-day="05/31/2020" class="day weekend">31</td><td data-action="selectDay" data-day="06/01/2020" class="day new">1</td><td data-action="selectDay" data-day="06/02/2020" class="day new">2</td><td data-action="selectDay" data-day="06/03/2020" class="day new">3</td><td data-action="selectDay" data-day="06/04/2020" class="day new">4</td><td data-action="selectDay" data-day="06/05/2020" class="day new">5</td><td data-action="selectDay" data-day="06/06/2020" class="day new weekend">6</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2020</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month active">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year active">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
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
        axios.get("api/user"). then(({ data }) => (this.users = data.data));
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
