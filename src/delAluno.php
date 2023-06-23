<?php 
    if(!empty($_GET)){
        ini_set('display_errors', 1);
        require('utils/conection.php');
        $idAluno = $_GET["idAluno"]; 
        
        
        //Delete da tabela boletim
        $sqlboletim = "DELETE from boletim where idAluno = '{$idAluno}'";
        $resboletim = SmtConnection::getQuery($sqlboletim);
        
        //Delete da tabela alunos
        $sql = "DELETE from alunos where id = '{$idAluno}'";
        $res = SmtConnection::getQuery($sql);



        header('HTTP/2.0 200 Bad Request');
        $retorno['code']    = 200;
        return;


    }
?>