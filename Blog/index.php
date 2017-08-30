<?php
include('config.php');
$sql = "select * from archive order by pid desc limit 0,5";
$res = $db->query($sql);
$pages = array();
while ($row  = $res->fetch_array(MYSQL_ASSOC)) {
  $pages[] = $row;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $setting['title'] ?></title>
    <?php include(PATH . '/header.inc.php');?>


  </head>
  <body>

  <div id="particles-js">
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
            <li><a href="index.php">Home</a></li>
            <li class="active">当前位置</li>

          </ol>
          <?php foreach ($pages as $content): ?>
            <div class="panel panel-success">
            <div class="panel-heading"><a href="read.php?pid=<?php echo $content['pid'];?>"><?php echo $content['title'] ?></a></div>
            <div class="panel-body">
              <?php echo mb_substr(strip_tags($content['content']),0,100) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  </body>
</html>
