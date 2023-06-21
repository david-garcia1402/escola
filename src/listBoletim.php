<?php 
    require("utils/conection.php");
    
    $idAluno = $_GET["idAluno"];
    
    $sqlaluno = "select id, nome, turno from alunos where id = '{$idAluno}'";
    $resaluno = SmtConnection::getQuery($sqlaluno);
    
    $user_data = mysqli_fetch_assoc($resaluno);
    $retorno['id']    = $user_data['id']; 
    $retorno['nome']    = $user_data['nome'];
    $retorno['turno']    = $user_data['turno'];
    $retorno['materias'] = array();
        
    $sql = "select alunos.id as 'id do aluno', alunos.nome as 'aluno', materias.nome as 'materia', boletim.b1notas, boletim.b2notas, boletim.b3notas 
            from boletim, alunos, materias 
            where boletim.idAluno = alunos.id and boletim.idMate = materias.id 
            order by alunos.id asc;;";
    $res = SmtConnection::getQuery($sql);
      
    while($row = mysqli_fetch_row($res)) {
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