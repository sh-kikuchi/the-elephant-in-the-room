<?php
trait Mail{
	function sendMail($post_data){
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    //POST送信で受けとった値を変数に格納しよう
    $to      = '送信先のメールアドレス';
    $title   = $post_data['option']."(".$post_data['name'].")";
    $message = $post_data['comment'];
    $headers =  $post_data['mail'];

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