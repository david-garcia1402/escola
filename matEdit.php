<?php 
    require('utils/conection.php');
    $idMat = $_GET["idMat"]; 
    $editsql = "select materias.id, materias.nome, professores.name_prof, professores.id AS id_prof ";
    $editsql .= "from materias, professores, materiasProfessores ";
    $editsql .= "where materiasProfessores.idMat = materias.id ";
    $editsql .= "and materiasProfessores.idProf = professores.id ";
    $editsql .= "and materias.id = '{$idMat}'";
    $res = SmtConnection::getQuery($editsql);

    $id = "";
    $nome = "";
    $professores = array();
    while($row = mysqli_fetch_row($res)){
        $id = $row[0];
        $nome = $row[1];
        $professor = array(
            "NAME" => $row[2],
            "ID" => $row[3]
        );
        array_push($professores, $professor);
    }
    $user_data = array(
        "id" => $id,
        "nome" => $nome,
        "items" => $professores,
    );
    echo json_encode($user_data);
?>


