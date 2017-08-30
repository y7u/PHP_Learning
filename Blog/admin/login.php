<?php
session_start();
include('../config.php');

if( $input->get('do') == 'check' ){
    $auser =addslashes( $input->post('auser'));
    $apass = addslashes($input->post('apass'));
    $sql = "select * from admin where auname='{$auser}' and aupassd='{$apass}'";
    $mysqli_result = $db->query( $sql );
	$row = $mysqli_result->fetch_array( MYSQL_ASSOC );
    if( is_array( $row ) ){
        $_SESSION['aid'] = $row['aid'];
        header("location: home.php");
    }else{
        die("error");
    }

}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>管理员登录</title>
        <?php include(PATH . '/header.inc.php'); ?>
    </head>
    <body>
        <div class='container'>
            <div class="row" style="margin-top:200px;">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">管理员登录</div>
                        <div class="panel-body">

                        <form class="form-horizontal" action="login.php?do=check" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">用户</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='auser' id="auser" placeholder="请输入用户名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name='apass' id="apass" placeholder="请输入密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <input type='submit' value='提交登录' class='btn btn-primary'/>
                                </div>
                            </div>
                        </form>

                        </div>
                        <div class="panel-footer text-right">版权所有 盗版必究</div>
                    </div>

                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </body>
</html>
