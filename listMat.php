<?php 
    require('utils/conection.php');
    $filtro = isset($_REQUEST['filtro']) ? $_REQUEST['filtro'] : '';
    $where = "";

    if(!empty($filtro)){
        $where = " and materias.nome like  '%{$filtro}%'";
    }

    $sql = 'select materias.id, materias.nome, GROUP_CONCAT(professores.name_prof SEPARATOR ", ")'; 
    $sql .= 'from professores, materias, materiasProfessores ';
    $sql .=  'where materiasProfessores.idMat = materias.id ';
    $sql .=  'and materiasProfessores.idProf = professores.id ';
    $sql .= $where;
    $sql .= 'group by materias.id';
    $listres = SmtConnection::getQuery($sql);

    echo "<table class='table'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Matéria</th>";
        echo "<th>Professor(res) relacionado(s)</th>";
        echo "<th></th>";
        echo "</tr>";
    while($row = mysqli_fetch_row($listres)){ 
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>";
        echo "<div>";
        echo "<button type='button' class='btn btn-outline-danger btn-sm' style='max-width:30px; margin-right: 10px;' onclick='delMat(\"$row[0]\")' title='Excluir registro'><span class='fa fa-trash'></span></button>";
        echo "<button type='button' class='btn btn-outline-primary btn-sm' style='max-width:30px;' onclick='matEdit(\"$row[0]\")' title='Editar registro'><span class='fa fa-edit'></span></button>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
        }           
    echo "</table>";
    echo "</div>";
    echo "</div>";
    $num_linhas = SmtConnection::getRows($listres);
    if($num_linhas == 0){
        echo"<div class='alert alert-info'>";
        echo"<strong>Atenção!</strong> Não tem nenhum registro listado neste momento.";
        echo "<div class='button mx-auto'>";
        echo "</div>";
    }
?>
