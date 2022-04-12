<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<!-- Include jQuery library -->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

li {
  float: left;
}

li a {
  display: block;
  padding: 8px;
  background-color: #dddddd;
}
</style>
<script>
function updateCartItem(obj, rowid){
    $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

<h1>SHOPPING CART</h1>
 <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="<?php echo site_url('Products/index');?>">Shop</a></li>
      <?php if (!empty($this->session->userdata('username'))): ?>
          <li><a href=""><?php echo $this->session->userdata('username');?></a></li>
          <li>
            <a class="btn btn-danger" href="<?php echo site_url('login/logout');?>">logout</a>
          </li>
      <?php endif ?>
      <li style="float:right;">
          <form action="<?php echo base_url(); ?>Cart" method="post">
            <select id="select-cr" name="cur" onchange="this.form.submit();">                
                <option value="EUR"<?php if($cur=='EUR'){ echo 'selected="selected"'; }?>>EUR</option>
                <option value="USD"<?php if($cur=='USD'){ echo 'selected="selected"'; }?>>USD</option>
                <option value="RON"<?php if($cur=='RON'){ echo 'selected="selected"'; }?>>RON</option>
            </select>           
        </form>
      </li>
    </ul>
<table class="table table-striped">
<thead>
    <tr>
        <th width="10%"></th>
        <th width="30%">Product</th>
        <th width="15%">Price</th>
        <th width="13%">Quantity</th>
        <th width="20%" class="text-right">Subtotal</th>
        <th width="12%"></th>
    </tr>
</thead>
<tbody>
 
    
    <?php if($cartItems){
      
     foreach($cartItems as $item){  //print_r($item);
  
      ?>
    <tr>
        <td>
            <?php $imageURL = !empty($item["image"])?base_url('uploads/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
            <img src="<?php echo $imageURL; ?>" width="50"/>
        </td>
        <td><?php echo $item["name"]; ?></td>
        <td>
        <?php 
        if ($cur=='EUR') {
        ?> 
            <?php echo '€'.$item["price"].' EUR'; ?>
        <?php 
        }elseif ($cur=='USD') {
        ?>
            <?php echo '$'.$item["price"].' USD'; ?>
         <?php
        }elseif ($cur=='RON') {
        ?>
             <?php echo $item["price"].' Leu'; ?>
        <?php
        } 
        ?>  
        </td>
        <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
        
        <td class="text-right">
        <?php 
        if ($cur=='EUR') {
        ?>
            <?php echo '€'.$item["subtotal"].' EUR'; ?>
        <?php 
        }elseif ($cur=='USD') {
        ?>  
            <?php echo '$'.$item["subtotal"].' USD'; ?>  
        <?php
        }elseif ($cur=='RON') {
        ?> 
            <?php echo $item["subtotal"].' Leu'; ?>
        <?php
        } 
        ?>  
        </td>
        
        <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>':false;">X</button> </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><p>Your cart is empty.....</p></td>
    <?php } ?>
    <?php if($this->cart->total_items() > 0){ ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Cart Total</strong></td>
        <td class="text-right">
        <?php 
        if ($cur=='EUR') {
        ?>
            <strong><?php echo '€'.$this->cart->total()*$exchan.'EUR'; ?></strong>
        <?php 
        }elseif ($cur=='USD') {
        ?>
            <strong><?php echo '$'.$this->cart->total()*$exchan.'USD'; ?></strong>
        <?php
        }elseif ($cur=='RON') {
        ?>
            <strong><?php echo $this->cart->total()*$exchan.'Leu'; ?></strong>
        <?php
        } 
        ?>
        </td>
        <td>
            
        </td>
    </tr>
    <?php } ?>
     
</tbody>
</table>
