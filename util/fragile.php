<?php
/**
 * XSS対策：エスケープ処理
 * @param string $str 対象の文字列
 * @return string 処理された文字列
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
/**
 * トークン生成
 * フォ―ムからトークンを生成。
 * 送信後の画面でそのトークンを照会
 */
function setToken(){
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}

?>
