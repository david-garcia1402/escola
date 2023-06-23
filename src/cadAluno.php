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
        //Inserir o aluno no sistema//
        $sql = "INSERT INTO alunos (nome, turno)";
        $sql .= " VALUES ('{$alunoNome}', '{$turno}')";
        $res = SmtConnection::getQuery($sql);
            
        //Inserir o boletim padrão dele com os zeros//
        $sqlmax = "select MAX(id) from alunos";
        $res = SmtConnection::getQuery($sqlmax);
        if ($res) {
            $row = mysqli_fetch_row($res);
            $idAluno = $row[0];
        }

        
        $sql1 = "
        select materias.id as 'idmat', materias.nome, boletim.b1notas, boletim.b2notas, boletim.b3notas 
            from materias, boletim 
            where boletim.idMate  = materias.id and boletim.idAluno = '{$idAluno}'; ";
        $ressql = SmtConnection::getQuery($sql1);
        $res = mysqli_num_rows($ressql);
        if ($res == 0) {
            $sqlmat = "select id, nome from materias";
            $resultmat = SmtConnection::getQuery($sqlmat);
            while ($vetmat = mysqli_fetch_assoc($resultmat)) {
                $idMateria = $vetmat['id'];
                $sqlnotas = "insert into boletim (b1notas, b2notas, b3notas, idMate, idAluno) values (0, 0, 0, '{$idMateria}' , '{$idAluno}')";
                $res = SmtConnection::getQuery($sqlnotas);
            }        
        }

        header('HTTP/2.0 200 Bad Request');
        $retorno['code']    = 200;
        $retorno['message'] = "<strong>Aluno(a) cadastrado com sucesso.</strong>";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
        
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