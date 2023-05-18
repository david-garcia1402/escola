<?php 
    if(!empty($_GET)){
        require('utils/conection.php');
        $idUser = $_GET["idUser"]; 
        $delsql = "DELETE FROM users WHERE id = '$idUser'"; //query para deletar o usuário do banco de dados através do ID
        $res = SmtConnection::getQuery($delsql);
    }

?>