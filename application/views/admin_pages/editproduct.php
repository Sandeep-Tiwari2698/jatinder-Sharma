<div class="content-wrapper">    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">	
   <form method="post" enctype="multipart/form-data" action="<?=base_url('Login/upd_pd');?>">
      	<?=isset($error)? $error :''?>
      	<?= validation_errors();?>
<div class="form-group">
<label>title</label>
<input type="text" class="form-control" name="name" value="<?=$fetch['name'];?>">
</div>
<div class="form-group">
<label>Image</label>
<input type="file" class="form-control" name="image">
<img src="<?=base_url('./uploads/'.$fetch['image']);?>" height="205" width="205">
</div>
<div class="form-group">
<label>Price</label>
<input type="number" class="form-control" name="price" value="<?=$fetch['price'];?>">
</div>
<div class="form-group">
<label>Description</label>
<input type="text" class="form-control" name="description" value="<?=$fetch['description'];?>" />
</div>
<input type="hidden" name="id" name="<?=$fetch['id'];?>">
<input type="submit" class="btn btn-success" name="submit" value="submit">
</form>
</div>
</section>
</div>