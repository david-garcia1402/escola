<?php
  class SmtPass {
    public static function passHash($password) {
      $options = [
        'cost' => 11
      ];

      return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function verifyHash($password, $passhashed) {
      return password_verify($password, $passhashed);
    }
  }
?>