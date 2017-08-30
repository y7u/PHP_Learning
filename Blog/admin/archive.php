<?php
include('check.php');
if( $input->get('do') == 'del' ){
    $pid = $input->get('pid');

    $sql = "delete from archive where pid='{$pid}'";
    $is = $db->query($sql);
    if($is){
        header("location:archive.php");
    }else{
        die("删除失败");
    }
}

//分页
$pageNum = $setting['pagenum']; //每页显示量
$sql = "select count(*) AS total from archive";
$total = $db->query($sql)->fetch_array(MYSQL_ASSOC)['total'];
$maxPage = ceil($total / $pageNum); //数据总量

//获取当前页码
$page = $input->get('page');

$page = $page<1 ? 1 : $page;

//偏移量
$offset = ($page - 1)*$pageNum;

//执行sql
$sql = "select * from archive order by pid desc limit {$offset},{$pageNum}";
$result = $db->query( $sql );

$rows = array();
while ($row = $result->fetch_array(MYSQL_ASSOC)) {
  $rows[] = $row;
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>文章管理</title>
 	<?php include(PATH.'/header.inc.php'); ?>
 </head>
 <body>
 <?php include('nav.inc.php'); ?>
 <div class="container">
 	<div class="rows">
 	<h3>文章管理 <small class="pull-right"><a class="btn btn-success" role="button" href="archive_add.php">添加文章</a></small></h3>
 	<table class="table">
      <thead>
        <tr>
          <th>PID</th>
          <th>标题</th>
          <th>作者</th>
          <th>发布时间</th>
          <th>修改时间</th>
        </tr>
      </thead>
      <tbody>
  		<?php foreach ($rows as $row): ?>
        <tr class="active">

          <td>
          <?php echo $row['pid'] ?>
          </td>
          <td>
          <?php echo $row['title'] ?>
          </td>
          <td>
          <?php echo $row['author'] ?>
          </td>
          <td>
          <?php echo date("Y-m-d H:i:s",$row['intime']) ?>
          </td>
          <td>
          <?php echo date("Y-m-d H:i:s",$row['uptime']) ?>
          </td>
          <td>
          	<a class="btn btn-primary btn-sm" role="button" href="archive_add.php?pid=<?php echo $row['pid'];?>">修改</a>
          	<a class="btn btn-danger btn-sm" role="button" href="archive.php?do=del&pid=<?php echo $row['pid'];?>">删除</a>
          </td>

        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li>
      <?php
      $hreftop = '<li>
      <a href="archive.php?page=%d" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
      $hrefTpl = '<li><a href="archive.php?page=%d">%s</a></li>';
      $hreffoot = '  <li>
      <a href="archive.php?page=%d" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>';

      for( $i=1; $i<=$maxPage; $i++ ){
        echo sprintf( $hreftop, $i-1 );
        echo sprintf( $hrefTpl, $i, "{$i}" );
        echo sprintf( $hreffoot, $i+1);

      }
      ?>
      </a>
      </li>
      </ul>
    </nav>
 		</div>
 	</div>
 </div>

 </body>
 </html>
