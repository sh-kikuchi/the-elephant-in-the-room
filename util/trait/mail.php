<?php
trait Mail{
	function sendMail($post_data){
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    //POST送信で受けとった値を変数に格納しよう
    $to      = $post_data['mail'];
    $title   = $post_data['username'].'さんからのお便り';
    $message = $post_data['comment'];
    $headers =  'From:'.$post_data['mail'];

    //mb_send_mail関数
    if(mb_send_mail($to, $title, $message, $headers))
    {
      echo "メール送信しました。";
    }
    else
    {
      echo "メール送信失敗しました。";
    }
	}
}
?>