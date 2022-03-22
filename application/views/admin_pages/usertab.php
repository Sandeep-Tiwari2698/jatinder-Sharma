  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Table</h3>

                <div class="card-tools">
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    
                  </div> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($data as $role): ?>
                      <?php if( $role->user_level =='user'): ?>
                    <tr>
                      <td><?=$role->user_id;?></td>
                      <td><?=$role->user_name;?></td>
                      <td><?=$role->user_email;?></td>
                      <td><?=$role->user_level;?></td>
                      <td>
                       <!--  <a href=""><i class="nav-icon fas fa-edit" style="color:green;"></i></a> -->
                        <a href="<?=base_url('Login/deleteuser/'.$role->user_id);?>"><i class="nav-icon fas fa-trash" style="color:red;"></i></a>
                      </td>
                    </tr>   
                <?php endif; ?>
               <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
 
 