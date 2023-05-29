<?php 
    if(!empty($_GET)){
        require('utils/conection.php');
        $idAluno = $_GET["idAluno"]; 
        $sql = "DELETE from alunos where id = '{$idAluno}'";
        $res = SmtConnection::getQuery($sql);

        header('HTTP/2.0 200 Bad Request');
        $retorno['code']    = 200;
        return;
    }
?>