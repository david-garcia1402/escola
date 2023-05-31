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
        
    $sql = "SELECT id, nome from materias;";
    $res = SmtConnection::getQuery($sql);
      
    while($row = mysqli_fetch_row($res)) {
        $materia = array(
            "id" => $row[0],
            "nome" => $row[1],
            "b1" => "",
            "b2" => "",
            "b3" => ""
        );
        $retorno['materias'][] = $materia;
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>