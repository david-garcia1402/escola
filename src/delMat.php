<?php 
    if(!empty($_GET)){
        require('utils/conection.php');
        $idMat = $_GET["idMat"]; 
        $sql = "DELETE from materiasProfessores where idMat = '{$idMat}'";
        $res = SmtConnection::getQuery($sql);
        $delsql = "DELETE FROM materias WHERE id = '{$idMat}'"; //query para deletar o usuário do banco de dados através do ID
        $res = SmtConnection::getQuery($delsql);
    }
?>