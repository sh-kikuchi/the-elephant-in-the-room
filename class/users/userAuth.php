<?php

require_once '../../database/db_connect.php';

class UserAuth
{
  /**
   * ユーザを登録する
   * @param array $userData
   * @return bool $result
   */
  public static function register($userData)
  {
    $result = false;

    $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

    // ユーザデータを配列に入れる
    $arr = [];
    $arr[] = $userData['name'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

    try {
      $stmt = db_connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch(\Exception $e) {
      echo $e;
      error_log($e, 3, '../error.log');
      return $result;
    }
  }

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function signin($email, $password)
  {

    // 結果
    $result = false;

    // ユーザをemailから検索して取得
    $user = self::getUserByEmail($email);

    if (!$user) {
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    //　パスワードの照会
    if (password_verify($password, $user['password'])) {
      //ログイン成功
      session_regenerate_id(true);
      $_SESSION['signin_user'] = $user;
      $result = true;
      return $result;
    }

    $_SESSION['msg'] =  $password;
    return $result;
  }

  /**
   * Get User Data By Email
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getUserByEmail($email)
  {
    $sql = 'SELECT * FROM users WHERE email = ?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    try {
      $stmt = db_connect()->prepare($sql);
      $stmt->execute($arr);
      // SQLの結果を返す
      $user = $stmt->fetch();
      return $user;
    } catch(\Exception $e) {
      return false;
    }
  }
  /**
   * Sign-in Check
   * @param void
   * @return bool $result
   */
  public static function checkSign()
  {
    $result = false;
    // true if there is 'signin_user' in the session
    if (isset($_SESSION['signin_user']) && $_SESSION['signin_user']['id'] > 0) {
      return $result = true;
    }
    return $result;
  }

  /**
   * Logout
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();

    //Back to Sign-in Page.
    header('Location: ../../../../../the-elephant-in-the-room/page/user_auth/signin_form.php');
  }

}
