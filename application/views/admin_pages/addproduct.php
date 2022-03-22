<div class="content-wrapper">    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">	
   <form method="post" enctype="multipart/form-data">
      	<?=isset($error)? $error :''?>
      	<?= validation_errors();?>
<div class="form-group">
<label>title</label>
<input type="text" class="form-control" name="name">
</div>
<div class="form-group">
<label>Image</label>
<input type="file" class="form-control" name="image">
</div>
<div class="form-group">
<label>Price</label>
<input type="number" class="form-control" name="price">
</div>
<div class="form-group">
<label>Description</label>
<textarea  type="text" class="form-control" name="description"></textarea>
</div>
<input type="submit" class="btn btn-default" name="submit" value="submit">
</form>
</div>
</section>
</div>