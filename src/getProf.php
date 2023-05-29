<?php 
//função profLoad()
    require('utils/conection.php');
    $sql = "SELECT id, name_prof from professores";
    $result = SmtConnection::getQuery($sql);

    if(mysqli_num_rows($result) > 0){
        $selectProf = "<select class='form-select' id='cbProfessor' name='cbProfessor'>";
        $selectProf .=  "<option selected value='0'>Escolha:</option>";
        while($row = mysqli_fetch_row($result)){
            $selectProf .= "<option value='{$row[0]}'>{$row[1]}</option>";
        }
        $selectProf .= "</select>";
        $selectProf .= "<button type='button' class='btn btn-secondary' onclick='addProfList()' title='Cadastrar registro'><span class='fa fa-plus'></span></button>";
        echo $selectProf;
    }
?>