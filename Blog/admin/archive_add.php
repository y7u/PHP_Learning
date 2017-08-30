<?php
include('check.php');
$pid = $input->get('pid');
$archive = array(
    'title' => '',
    'author' => '',
    'content'=>'',
    );

if($pid>0){
  $sql = "select * from archive where pid = '{$pid}'";
  $res = $db->query($sql);
  $archive = $res->fetch_array(MYSQL_ASSOC);
}
if($input->get('do')=='add'){
  $title = $input->post('title');
  $author = $input->post('author');
  $content = $input->post('author');
  if(empty($title)||empty($author)){
    echo '数据不能为空';
  }

  if($pid >0){
    $uptime = time();
    $upstrp1 = "UPDATE archive set title = '%s', author= '%s',content='%s',uptime='%d' where pid = '%d'";
    $sql = sprintf($upstrp1,$title,$author,$content,$uptime,$pid);
  }else {
    $intime = time();
    $instrp1 = "INSERT INTO archive (`title`, `author`, `content`, `intime`, `uptime`) values ( '%s', '%s', '%s', '%d' , '%d')";
    $sql = sprintf( $instrp1, $title, $author, $content, $intime, 0 );
  }
  $is = $db->query($sql);
  if($is){
    header("location:archive.php");
  }else{
    die('执行失败');
  }
}
 ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>添加文章</title>
        <?php include(PATH . '/header.inc.php');?>
        <link rel="stylesheet" type="text/css" href="../theme/simditor-2.3.6/styles/simditor.css" />
        <script type="text/javascript" src="../theme/simditor-2.3.6/scripts/module.js"></script>
        <script type="text/javascript" src="../theme/simditor-2.3.6/scripts/hotkeys.js"></script>
        <script type="text/javascript" src="../theme/simditor-2.3.6/scripts/uploader.js"></script>
        <script type="text/javascript" src="../theme/simditor-2.3.6/scripts/simditor.js"></script>
    </head>
    <body>
    <?php include('nav.inc.php');?>
    <div class="container">
        <h1>文章添加 <small class='pull-right'><a class="btn btn-info" role="button" href="archive.php">返回</a></small></h1>
        <hr/>
        <div class='rows'>

<form class="form-horizontal" role="form" action="archive_add.php?do=add&pid=<?php echo $pid ?>" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="title"  value = "<?php echo $archive['title'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="author"  value = '<?php echo $archive['author'];?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-8">
      <textarea  id="editor" placeholder="Balabala" autofocus>
        <?php echo $archive['content'];?>
      </textarea>

    </div>
    <script>
    var editor = new Simditor({
      textarea: $('#editor'),
      upload:{
        url:'upload.php',
        fileKey:'file'
      }

});
    </script>

  </div>
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
