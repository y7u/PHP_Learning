<?php

/**
 * 程序的配置文件
 */

define("PATH", dirname(__FILE__));

include(PATH . '/core/db.class.php');
$db = new db();

include( PATH . '/core/input.class.php' );
$input = new input();

//系统配置

$sql  = "select *from setting";
$set_re = $db->query($sql);
$setting = array();

while($row = $set_re->fetch_array(MYSQL_ASSOC)){
    $setting[$row['key']] = $row['value'];
}
