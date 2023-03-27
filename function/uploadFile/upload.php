<?php

if($_FILES['upfile']['error'] !== UPLOAD_ERR_OK){
  //アップロード処理の成否
  $msg =[
    UPLOAD_ERR_INT_SIZE   => 'HTMLのMAX_FILE_SIZE制限を越えています',
    UPLOAD_ERR_PARTIAL    => 'ファイルの一部しかアップロードされていません',
    UPLOAD_ERR_NO_FILE    => 'ファイルはアップロードされませんでした',
    UPLOAD_ERR_NO_TMP_DIR => '一時フォルダーが存在しません',
    UPLOAD_ERR_CANT_WRITE => 'ディスクへの書き込みに失敗しました',
    UPLOAD_ERR_EXTENSION  => '拡張モジュールによってアップロードが中断されました',
  ];
  $err_msg = $msg[$_FILES['upfile']['error']];
}else if(!in_array(strtolower(pathinfo($_FILES['upfile']['name'])['extension']),
  ['gif','jpg', 'jpeg', 'png']))
  //拡張子の確認
{
  $err_msg = "画像以外のファイルはアップロードできません";
}else if(!in_array(finfo_file(
                   finfo_open(FILEINFO_MIME_TYPE),$_FILES['upfile']['tmp_name']),
             ['image/gif','image/jpg', 'image/jpeg', 'image/png']))
{
  //ファイル内容が画像かどうか
  $err_msg = "ファイル内容が画像ではありません";
}else{
  $src  = $_FILES['upfile']['tmp_name']; //一時ファイルパス
  $dest = $_FILES['upfile']['name'];     //ファイル名

  /**
   * move_uploaded_file
   * @param string $src　一時ファイルパス
   * @param string [path].$dest 保存先
   */
  if(!move_uploaded_file($src,'../../../the_Elephant_in_the_Room/storage/doc/'.$dest)){
    $err_msg = "アップロードに失敗しました";
  }
}

//エラーメッセージ
if(isset($err_msg)){
  die('<div style="color:Red">'.$err_msg.'</div>');
}

 header('Location:/the_Elephant_in_the_Room/page/uploadFile/upload.php');

?>
