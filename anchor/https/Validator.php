<?php 
namespace app\anchor\https;

class Validator {
    private $errors = [];
    private $customMessages = [];

    public function setCustomMessages(array $customMessages) {
        $this->customMessages = $customMessages;
    }

    public function getErrors() {
        return $this->errors;
    }

    protected function addError($field, $message) {
        $this->errors[$field] = $message;
    }

    protected function getCustomMessage($field, $defaultMessage) {
        return isset($this->customMessages[$field]) ? $this->customMessages[$field] : $defaultMessage;
    }

    public function mailFormat($email, $field = 'email') {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $message = $this->getCustomMessage($field, 'Invalid email address');
            $this->addError($field, $message);
            return false;
        }
        return true;
    }

    public function required($value, $field = 'value') {
        if (empty($value)) {
            $message = $this->getCustomMessage($field, $field. ' is required');
            $this->addError($field, $message);
        }
    }

    public function passwordFormat($password, $field = 'password') {
        if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
            $message = $this->getCustomMessage($field, 'The password must be at least 8 alphanumeric characters and no more than 100 characters.');
            $this->addError($field, $message);
        }
    }

    public function passwordConfirm($password, $password_conf) {
        if ($password !== $password_conf) {
            $message = $this->getCustomMessage($field, 'Password and confirmation password do not match.');
            $this->addError($field, $message);
        }
    }

    public function validateString($value, $field = 'input', $required = false, $minLength = null, $maxLength = null) {

      // 入力が必須であり、空文字列の場合はエラー
      if ($required && empty($value)) {
          $message = $this->getCustomMessage($field, $field. ' is required');
          $this->addError($field, $message);
      }

      // 最小文字数のチェック
      if ($minLength !== null && mb_strlen($value) < $minLength) {
          $message = $this->getCustomMessage($field, "Minimum length is $minLength characters");
          $this->addError($field, $message);
      }

      // 最大文字数のチェック
      if ($maxLength !== null && mb_strlen($value) > $maxLength) {
          $message = $this->getCustomMessage($field, "Maximum length is $maxLength characters");
          $this->addError($field, $message);
        
      }
      return $this->getErrors();
  }
}