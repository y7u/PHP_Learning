<?php
include('config.php');
$pid = (int) $input->get('pid');
if( $pid<1 ){
    die('无效文章');
}
$sql = "select * from archive where pid='{$pid}'";
$pages = $db->query($sql)->fetch_array( MYSQL_ASSOC );
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $setting['title'] ?></title>
    <?php include(PATH . '/header.inc.php');?>
  </head>
  <body>
    <div class="container">
      <div class="jumbotron">
        <h1><?php echo $setting['title'] ?></h1>
        <p><?php echo $setting['Motto'] ?></p>
      </div>

      <div class="row">
        <div class="col-md-2">
          <ul class="nav nav-stacked ">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="./admin/login.php">登录</a></li>
            <li role="presentation"><a href="me.php">关于我</a></li>
          </ul>
        </div>
        <div class="col-md-10">
          <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">当前位置</li>
          </ol>
            <div class="panel panel-success">
            <div class="panel-body">
              <?php echo $pages['content']; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
