<?php
// session_start();
   require_once('../controller/auth.php');



//エラーメッセージ(初期化)
$error = [];

// // トークン照会
// $token = filter_input(INPUT_POST, 'csrf_token');

// // if(!isset($_SESSION['']) || $token !== $_SESSION['csrf_token']){
// //     exit('不正なリクエスト');
// // }

// //トークン削除
// unset($_SESSION['csrf_token']);

//バリデーション
if(!$name = filter_input(INPUT_POST, 'name')){
    $error[] = "ユーザー名を記入して下さい";
}

if(!$email = filter_input(INPUT_POST, 'email')){
    $error[] = "メールアドレスを記入して下さい";
}

$pass = filter_input(INPUT_POST,'pass');
if(!preg_match("/\A[a-z\d]{8,25}+\z/i",$pass)){
    $error[] = "パスワードは英数字8文字以上25文字以下にしてください";
}
$pass_conf = filter_input(INPUT_POST,'pass_conf');
if(!$password = $pass_conf){
    $error[] = "確認用パスワードと異なっています。";
}


if(count($error)===0){
    //フォームの値を渡してあげることが出来る⇒userDataとして
    $register = UserAuth::register($_POST);

    //上記の処理で失敗した場合（falseが返ってきた場合）
    if(!$register){
        $error[] = "登録に失敗しました";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録完了画面</title>
</head>
<body>
    <?php if(count($error)>0) : ?>
    <?php foreach($error as $e) : ?>
        <p> <?php echo $e ?> </p>
    <?php endforeach ?>
    <?php else : ?>
        <p>ユーザー登録が完了しました。</p>
    <?php endif ?>
    <a href="./signup_form.php">戻る</a>
</body>
</html>
