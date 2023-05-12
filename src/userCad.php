<?php 
    $registered = false;
    if (!empty($_POST) && (!empty($_POST['Login']) && !empty($_POST['Pass']))) {
        require_once('utils/pass.php');
        require_once('utils/conection.php');
        
        $login = $_POST['Login'];
        $pass  = $_POST['Pass'];

        $sql = "INSERT into users (user, pass) values ('{$login}', '{$pass}')";
        $result = SmtConnection::getQuery($sql);
        $user   = SmtConnection::getData($result);
    if($registered){
        $GLOBALS['loginError'] = true;
        header("Location: login.php?error=true");
    }
    }
?>