<?php

  $logged = false;
  $GLOBALS['loginError'] = false;

  if (!empty($_POST) && (!empty($_POST['Login']) && !empty($_POST['Pass']))) {
    require_once('utils/pass.php');
    require_once('utils/conection.php');

    $login = $_POST['Login'];
    $pass  = $_POST['Pass'];

     $sql  = " SELECT users.id, ";
     $sql .=        " users.name, ";
     $sql .=        " users.pass, ";
     $sql .=        " users.user, ";
     $sql .=        " users.admin ";
     $sql .=   " FROM users";
     $sql .=  " WHERE UPPER(users.user) = UPPER('{$login}') ";

     $result = SmtConnection::getQuery($sql);
     $user   = SmtConnection::getData($result);

    if (SmtPass::verifyHash($pass, $user['pass'])) {
      if (!isset($_SESSION)) {
        session_start();
      }

      $logged = true;

      $_SESSION['userId']    = $user['id'];
      $_SESSION['userName']  = $user['name'];
      $_SESSION['userEmail'] = $user['email'];
      $_SESSION['userAdmin'] = $user['admin'];
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