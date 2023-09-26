<?php
  class SmtConnection {
    private static function getConnection() {
      require('conf.php');
      $connection = mysqli_connect($conf['dbHost'], $conf['dbUser'], $conf['dbPass'], $conf['dbDatabase']);

      return $connection;
    }

    public static function getQuery($_sql) {
      $connection = SmtConnection::getConnection();

      $result = mysqli_query($connection, $_sql);

      return $result;
    }

    public static function getData($_result) {
      return mysqli_fetch_assoc($_result);
    }

    public static function getRows($_result) {
      return mysqli_num_rows($_result);
    }
  }
?>