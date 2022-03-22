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
                 <div class="input-group input-group-sm" style="width: 150px;">
                    <a class="btn btn-primary"href="<?=base_url();?>addproduct">+ Add Product</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($data as $show): ?>
                    <tr>
                      <td><?=$show->id;?></td>
                      <td><?=$show->name;?></td>
                      <td><img style="width: 100px; height: 100px;" src="<?=base_url('./uploads/'.$show->image);?>"></td>
                      <td><?=$show->description;?></td>
                      <td>
                      	<?php if($show->status == '1'):?>
                      		<button class="btn btn-success">Activate</button>
                      		<?php else: ?>
                      			<button class="btn btn-danger">Deactive</button>
                      	<?php endif;?>
                      </td>
                      <td>
                       <a href="<?=base_url('Login/productid/'.$show->id);?>"><i class="nav-icon fas fa-edit" style="color:green;"></i></a> 
                        <a href="<?=base_url('Login/deleteproduct/'.$show->id);?>"><i class="nav-icon fas fa-trash" style="color:red;"></i></a>
                      </td>
                    </tr>   
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
 
 