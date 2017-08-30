<?php
include('check.php');
	//执行的相应操作
	if( $input->get('do') == 'del' ){
    $aid = $input->get('aid');
    if( $aid == $session_aid ){
        die("不能删除自己");
    }
    $sql = "delete from admin where aid='{$aid}'";
    $is = $db->query($sql);
    if($is){
        header("location:user.php");
    }else{
        die("删除失败");
    }
}




	$sql = "select * from admin";
	$result = $db->query($sql);
	$rows = array();
	while($row = $result->fetch_array(MYSQL_ASSOC)){
		$rows[] = $row;
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>管理员管理</title>
 	<?php include(PATH.'/header.inc.php'); ?>
 </head>
 <body>
 <?php include('nav.inc.php'); ?>
 <div class="container">
 	<div class="rows">
 	<h3>管理员管理 <small class="pull-right"><a class="btn btn-default" href="user_add.php">添加管理员</a></small></h3>
 	<table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>用户名</th>
          <th>管理</th>
        </tr>
      </thead>
      <tbody>
  		<?php foreach ($rows as $row): ?>
        <tr class="active">

          <td>
          <?php echo $row['aid'] ?>
          </td>
          <td>
          <?php echo $row['auname'] ?>
          </td>
          <td>
          	<a class="btn btn-primary btn-sm" role="button" href="user_add.php?aid=<?php echo $row['aid']; ?>">修改</a>
          	<a class="btn btn-danger btn-sm" role="button" href="user.php?do=del&aid= <?php echo $row['aid']; ?>">删除</a>
          </td>

        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
 		</div>
 	</div>
 </div>

 </body>
 </html>
