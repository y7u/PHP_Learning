<?php
include('check.php');

$aid = $input->get('aid');
$auser = array(
    'auname' => '',
    'aupassd' => '',
    );
if( $aid>0 ){
    $sql = "select * from admin where aid='{$aid}'";
    $res = $db->query($sql);
    $auser = $res->fetch_array( MYSQL_ASSOC );
}

if( $input->get('do')=='add' ){
    $auser = $input->post('username');
    $apass = $input->post('password');
    if( empty($auser) || empty($apass) ){
        die("账号或密码不能为空");
    }

    //检查用户名是否重复
    $sql = "select * from admin where auname='{$auser}' and aid <> '{$aid}'";
    $res = $db->query( $sql );
    if( $res->fetch_array() ){
        die('账号不能重复');
    }

		if( $aid<1 ){
			//插入数据
			$sql = "insert into admin (auname,aupassd) values ('{$auser}', '{$apass}')";
    }else{
        $sql = "UPDATE admin SET auname='{$auser}', aupassd='{$apass}' where aid='{$aid}'";
    }
    $is = $db->query($sql);
    if($is){
        header("location:user.php");
    }else{
        die("执行失败");
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>添加管理员</title>
        <?php include(PATH . '/header.inc.php');?>
    </head>
    <body>
    <?php include('nav.inc.php');?>

    <div class="container">
        <h1>管理员添加 <small class='pull-right'><a class='btn btn-default' href="user.php">返回</a></small></h1>
        <hr/>
        <div class='rows'>

<form class="form-horizontal" role="form" action="user_add.php?do=add&aid=<?php echo $aid ?>" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="username" placeholder="请输入账号" value = "<?php echo $auser['auname'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" name="password" placeholder="请输入密码" value = '<?php echo $auser['aupassd'];?>'>
    </div>
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
