<?php
include('check.php');
$key = 'file';
$dir = '../uploadfiles/';
$whiteMap = array(
  'jpg',
  'gif',
  'png',
  'bmp'
);

if( isset( $_FILES[$key] ) ){
    $file = $_FILES[$key];
    if( $file['error'] == 0 ){
        $pathName = $dir . $file['name'];
        $urlName = 'http://127.0.0.1/Blog/uploadfiles/' . $file['name'];
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(!in_array($extension,$whiteMap)){
          if($extension == ''){
            exit('不允许上传空类型文件');
          }else{
            exit('不允许上传'.$extension.'类型文件');
          }
        }
      if(file_exists($pathName)){
        die('文件重复上传');
      }
    $is = move_uploaded_file( $file['tmp_name'], $pathName );
     if( !$is ){
         die("上传失败");
     }

     $json = array(
         'success' => true,
         'msg' => '',
         'file_path' => $urlName
         );
     echo json_encode( $json );

   }

  }
 ?>
