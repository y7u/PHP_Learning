<?php
include('check.php');

if($input->get('do')=='edit'){
  $update_setting = $input->post();
  foreach ($update_setting as $key => $value) {
      $sql = "UPDATE setting set value = '{$value}' where `key` = '{$key}'";
      $is = $db->query($sql);
      if($is){
        header('location:setting.php');
      }else{
        die('执行失败');
      }
  }

}



 ?>
 <!DOCTYPE HTML>
 <html>
     <head>
         <title>系统设置</title>
         <?php include(PATH . '/header.inc.php');?>
     </head>
     <body>
     <?php include('nav.inc.php');?>

     <div class="container">
         <h1>系统设置</h1>
         <hr/>
         <div class='rows'>

 <form class="form-horizontal" role="form" action="setting.php?do=edit" method="post">
  <?php foreach ($setting as $key => $value): ?>
   <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $key; ?></label>
     <div class="col-sm-6">
       <input type="text" class="form-control" name="<?php echo $key; ?>" value = '<?php echo $value;?>'>
     </div>
   </div>
   <?php endforeach; ?>
   <div class="form-group">
     <div class="col-sm-offset-2 col-sm-6">
       <button type="submit" class="btn btn-default">提交</button>
     </div>
   </div>
 </form>

         </div>
     </div>
     </body>
 </html>
