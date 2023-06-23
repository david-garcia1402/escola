<?php
if (!empty($_POST)) {
    require('utils/pass.php');
    require('utils/conection.php');
    $idAluno = urldecode($_POST["idAluno"]) ? urldecode($_POST["idAluno"]) : "";
    $alunoNome = urldecode($_POST["alunoNome"]);
    $listNotas = urldecode($_POST["listNotas"]);
    $vetor = json_decode($listNotas, true);

    ini_set('display_errors', 1);

    $validacao = "select * from boletim where idAluno = '{$idAluno}'";
    $res = SmtConnection::getQuery($validacao);
    
    if (SmtConnection::getRows($res) == 0) {
        foreach ($vetor as $valores) {
            $idmat =  $valores['id'];
            $b1 = $valores['b1'];
            $b2 = $valores['b2'];
            $b3 = $valores['b3'];
    
            $sql = "insert into boletim (b1notas, b2notas, b3notas, idMate,  idAluno) 
                     values ('{$b1}', '{$b2}', '{$b3}', '{$idmat}', '{$idAluno}')";
            $res = SmtConnection::getQuery($sql);
            }

            header('HTTP/2.0 200 OK');
            $retorno['code']    = 200;
            $retorno['message'] = "Notas inseridas.";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            return;

    } else {
        $del = "delete from boletim where idAluno = '{$idAluno}'";
        $res = SmtConnection::getQuery($del);
        foreach ($vetor as $valores) {
            $idmat =  $valores['id'];
            $b1 = $valores['b1'];
            $b2 = $valores['b2'];
            $b3 = $valores['b3'];
        
            $sql1 = "insert into boletim (b1notas, b2notas, b3notas, idMate,  idAluno) 
            values ('{$b1}', '{$b2}', '{$b3}', '{$idmat}', '{$idAluno}')";
            $res = SmtConnection::getQuery($sql1);

            $update = "update boletim set b1notas = '{$b1}', b2notas = '{$b2}', b3notas = '{$b3}' where idAluno = '{$idAluno}' and idMate = '{$idmat}'";
            
            $res = SmtConnection::getQuery($update);
        }

        header('HTTP/2.0 200 OK');
        $retorno['code']    = 200;
        $retorno['message'] = "Notas inseridas.";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
    }

    // if (!empty($idAluno)) {
    //     $verificar = " AND materias.id != '{$idMat}'";
    // }
    // $sql = "SELECT nome from materias WHERE nome = '$matName'" . $verificar;
    // $result = SmtConnection::getQuery($sql);
    // if (SmtConnection::getRows($result) > 0) {
    //     header('HTTP/1.0 400 Bad Request');
    //     $retorno['code']    = 400;
    //     $retorno['message'] = "<strong>Matéria já cadastrada.</strong>";
    //     echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
    //     return;
    // }

    // if (empty($idMat)) {
    //     $sql = "INSERT into materias (nome) values ('{$matName}');";
    //     $result = SmtConnection::getQuery($sql);
    //     $lastidsql = "SELECT max(id) from materias";
    //     $listres = SmtConnection::getQuery($lastidsql);
    //     $row = mysqli_fetch_row($listres);
    //     $idMat = $row[0];
    // } else {
    //     $update = "UPDATE materias set nome = '{$matName}' where id = '{$idMat}' ";
    //     $res = SmtConnection::getQuery($update);
    // }
    // $sql = "DELETE from materiasProfessores where idMat = '{$idMat}'";
    // $res = SmtConnection::getQuery($sql);
    // foreach ($listProf as $idProf) {
    //     $sql = "insert into materiasProfessores (idProf, idMat) values ('{$idProf}', '{$idMat}')";
    //     $res = SmtConnection::getQuery($sql);
    // }
    // header('HTTP/1.0 200 OK');
    // $retorno['code']    = 200;
    // $retorno['message'] = "<strong>Matéria cadastrada com sucesso.</strong>";
    // echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
}

