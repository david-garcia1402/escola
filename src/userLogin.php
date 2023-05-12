<?php
  $logged = false;
  $GLOBALS['loginError'] = false;

  if (!empty($_POST) && (!empty($_POST['Login']) && !empty($_POST['Pass']))) {
    require_once('utils/pass.php');
    require_once('utils/conection.php');

    $login = $_POST['Login'];
    $pass  = $_POST['Pass'];

    // $sql  = " SELECT users.id, ";
    // $sql .=        " users.name, ";
    // $sql .=        " users.password, ";
    // $sql .=        " users.email ";
    // $sql .=   " FROM users";
    // $sql .=  " WHERE UPPER(users.email) = UPPER('{$login}') ";

    // $result = SmtConnection::getQuery($sql);
    // $user   = SmtConnection::getData($result);

    // if (SmtPass::verifyHash($pass, $user['password'])) 
    if ($login == "admin@gmail.com") {
      if (!isset($_SESSION)) {
        session_start();
      }

      $logged = true;

      $_SESSION['userId']    = "1"; //$user['id'];
      $_SESSION['userName']  = "admin"; //$user['name'];
      $_SESSION['userEmail'] = $login;// $user['email'];
    }
  }

  if ($logged) {
    header("Location: index.php");
  } else {
    $GLOBALS['loginError'] = true;

    session_destroy();
    header("Location: login.php?error=true");
  }
?>