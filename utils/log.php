<?php
  class SmtLog {
    public static function log($_data) {
      echo "<script>console.log('{$_data}');</script>";
    }
  }
?>