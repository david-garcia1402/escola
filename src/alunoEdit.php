<?php 
    require('utils/conection.php');
    $idAluno = $_GET["idAluno"]; 
    $editsql = "SELECT id, nome, turno FROM alunos WHERE id = '$idAluno'"; //query para deletar o usuário do banco de dados através do ID
    $res = SmtConnection::getQuery($editsql);

    $user_data = mysqli_fetch_assoc($res);
    echo json_encode($user_data);
?>