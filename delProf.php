<?php 
ini_set("display_errors", 1);
    if(!empty($_GET)){
        require('utils/conection.php');
        $idUser = $_GET["idUser"]; 
        $checksql = "SELECT * FROM materiasProfessores where idProf = '{$idUser}'";
        $res = SmtConnection::getQuery($checksql);
        if (SmtConnection::getRows($res) > 0) {
            header('HTTP/1.0 400 Bad Request');
            $retornoError['code']    = 400;
            $retornoError['message'] = "Professor vinculado à uma ou mais matérias cadastrada.";
            echo json_encode($retornoError, JSON_UNESCAPED_UNICODE);
        }else{
            $delsql = "DELETE FROM professores WHERE id = '$idUser'"; //query para deletar o usuário do banco de dados através do ID
            $res = SmtConnection::getQuery($delsql);
            header('HTTP/1.0 200 OK');
            $retorno['code']    = 200;
            $retorno['message'] = "Professor deletado com sucesso.";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        }

    }else{
        $sql = "DELETE from materiasProfessores where idProf = '{$idUser}'";
        $res = SmtConnection::getQuery($sql);
        echo $sql;
        $delsql = "DELETE FROM professores WHERE id = '{$idUser}'"; //query para deletar o usuário do banco de dados através do ID
        $res = SmtConnection::getQuery($delsql);
    }
?>