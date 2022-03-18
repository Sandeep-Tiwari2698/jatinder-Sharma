 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
                <?php if($this->session->userdata('level')==='admin'):?>
              <li class="breadcrumb-item active">Admin</li>
              <?php elseif($this->session->userdata('level')==='user'):?>
                 <li class="breadcrumb-item active">User</li>
                <?php else:?>
            <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
                  <?php endif;?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 