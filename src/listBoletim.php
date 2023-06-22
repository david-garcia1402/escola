<?php 
    require("utils/conection.php");
    ini_set('display_errors', 1);
    $idAluno = $_GET["idAluno"];
    
    $sqlaluno = "select id, nome, turno from alunos where id = '{$idAluno}'";
    $resaluno = SmtConnection::getQuery($sqlaluno);
    
    $user_data = mysqli_fetch_assoc($resaluno);
    $retorno['id']    = $user_data['id']; 
    $retorno['nome']    = $user_data['nome'];
    $retorno['turno']    = $user_data['turno'];
    $retorno['materias'] = array();
        
    $sql = "select alunos.id as 'idaluno', alunos.nome as 'idmat', materias.nome, boletim.b1notas, boletim.b2notas, boletim.b3notas 
            from boletim, alunos, materias 
            where boletim.idAluno = alunos.id and boletim.idMate = materias.id 
            order by alunos.id asc;";
    $ressql = SmtConnection::getQuery($sql);
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

    $sql2 = "select alunos.id as 'idaluno', alunos.nome as 'idmat', materias.nome, boletim.b1notas, boletim.b2notas, boletim.b3notas 
    from boletim, alunos, materias 
    where boletim.idAluno = alunos.id and boletim.idMate = materias.id 
    order by alunos.id asc;";
    $res2 = SmtConnection::getQuery($sql2);
    while($row = mysqli_fetch_row($res2)) {
        $materia = array(
            "id" => $row[0],
            "nome" => $row[2],
            "b1" => $row[3],
            "b2" => $row[4],
            "b3" => $row[5]
        );
        $retorno['materias'][] = $materia;
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>