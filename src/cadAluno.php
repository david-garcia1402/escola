<?php 
ini_set("display_errors", 1);
if(!empty($_POST)){
    require('utils/conection.php');
    $idAluno = urldecode($_POST["idAluno"]) ? urldecode($_POST["idAluno"]) : "";
    $alunoNome = urldecode($_POST["alunoNome"]);
    $turno = urldecode($_POST["turno"]);

    if (empty($alunoNome)) {
        header('HTTP/1.0 400 Bad Request');
        $retorno['code']    = 400;
        $retorno['message'] = "<strong>Insira o nome do aluno.</strong>";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
    }

    if ($turno == "escolha:") {
        header('HTTP/1.0 400 Bad Request');
        $retorno['code']    = 400;
        $retorno['message'] = "<strong>Insira o turno do aluno.</strong>";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
    }
    
    if (empty($idAluno)){
        $sql = "INSERT INTO alunos (nome, turno)";
        $sql .= " VALUES ('{$alunoNome}', '{$turno}')";
        $res = SmtConnection::getQuery($sql);
        if ($res) {
            header('HTTP/2.0 200 Bad Request');
            $retorno['code']    = 200;
            $retorno['message'] = "<strong>Aluno(a) cadastrado com sucesso.</strong>";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            return;
        }
    }else{
        $sql = "UPDATE alunos set nome = '{$alunoNome}', turno = '{$turno}' where id = '{$idAluno}'";
        $res = SmtConnection::getQuery($sql);
        if ($res) {
            header('HTTP/2.0 200 Bad Request');
            $retorno['code']    = 200;
            $retorno['message'] = "<strong>Aluno(a) editado com sucesso!</strong>";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            return;
        }else{
            header('HTTP/1.0 400 Bad Request');
            $retorno['code']    = 400;
            $retorno['message'] = "<strong>Erro na edição do aluno(a), tente novamente!</strong>";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}

?>