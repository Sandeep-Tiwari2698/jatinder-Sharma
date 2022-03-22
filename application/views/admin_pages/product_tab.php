  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                      <th>Price</th>
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
                      <td><?=$show->price;?></td>
                      <td><?=$show->description;?></td>
                      <td>
                      	<?php if($show->status == '1'){ ?>

            <button class="btn btn-success user_status" uid="<?php echo $show->id; ?>"  ustatus="<?php echo $show->status; ?>">Active</button>
                    
          <?php }else{ ?>

            <button class="btn btn-primary user_status" uid="<?php echo $show->id; ?>"  ustatus="<?php echo $show->status; ?>">Inactive</button>

          <?php } ?>
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
  <div class="modal modal-danger fade" id="modal_popup">

    <div class="modal-dialog modal-sm">

      <form action="<?php echo base_url(); ?>Login/product_status_changed" method="post"> 
         <div class="modal-content">

            <div class="modal-header" style="height: 150px;">

                <h4 style="margin-top: 50px;text-align: center;">Are you sure, do you change user status?</h4>

          <input type="hidden" name="id" id="user_id" value="">
          <input type="hidden" name="status" id="user_status" value="">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No</button>

                <button type="submit" name="submit" class="btn btn-success">Yes</button>

            </div>

          </div>

        </form>

    </div>

 </div>
</html>
<script type="text/javascript">
  $(document).on('click','.user_status',function(){

    var id = $(this).attr('uid'); //get attribute value in variable
    var status = $(this).attr('ustatus'); //get attribute value in variable

    $('#user_id').val(id); //pass attribute value in ID
    $('#user_status').val(status);  //pass attribute value in ID

    $('#modal_popup').modal({backdrop: 'static', keyboard: true, show: true}); //show modal popup

  });
</script>
 
 