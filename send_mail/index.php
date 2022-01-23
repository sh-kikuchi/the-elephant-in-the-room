<?php
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  //POST送信で受けとった値を変数に格納しよう
  $to = '送信先のメールアドレス';
  $title = $_POST['option']."(".$_POST['name'].")";
  $message = $_POST['comment'];
  $headers =  $_POST['mail'];

  //mb_send_mail関数
  if(mb_send_mail($to, $title, $message, $headers))
  {
    echo "メール送信しました。";
  }
  else
  {
    echo "メール送信失敗しました。";
  }
 ?>
