<?php 
    require('utils/conection.php');
    $idUser = $_GET["idUser"]; 
    $editsql = "SELECT id, name_prof, email_prof FROM professores WHERE id = '$idUser'"; //query para deletar o usuário do banco de dados através do ID
    $res = SmtConnection::getQuery($editsql);

    $user_data = mysqli_fetch_assoc($res);
    echo json_encode($user_data);
?>