<?php
/**
 * Anti-XSS measures: escaping process.
 * @param string  $str
 * @return string htmlspecialchars($str)
 */
function h($str) :string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
/**
 * token generation
 * @param  void
 * @return $csrf_token
 */
function setToken() :string {
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}
?>
