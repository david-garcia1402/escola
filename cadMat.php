<?php
if (!empty($_POST)) {
    require('utils/pass.php');
    require('utils/conection.php');
    $idMat = urldecode($_POST["idMat"]) ? urldecode($_POST["idMat"]) : "";
    $matName = urldecode($_POST["matName"]);
    $listProf = urldecode($_POST["listProf"]) ? explode(",", urldecode($_POST["listProf"])) : array();

    if (count($listProf) == 0) {
        header('HTTP/1.0 400 Bad Request');
        $retorno['code']    = 400;
        $retorno['message'] = "<strong>Necessário ter ao menos um professor.</strong>";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
    }

    $verificar = "";

    if (!empty($idMat)) {
        $verificar = " AND materias.id != '{$idMat}'";
    }
    $sql = "SELECT nome from materias WHERE nome = '$matName'" . $verificar;
    $result = SmtConnection::getQuery($sql);
    if (SmtConnection::getRows($result) > 0) {
        header('HTTP/1.0 400 Bad Request');
        $retorno['code']    = 400;
        $retorno['message'] = "<strong>Matéria já cadastrada.</strong>";
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        return;
    }

    if (empty($idMat)) {
        $sql = "INSERT into materias (nome) values ('{$matName}');";
        $result = SmtConnection::getQuery($sql);
        $lastidsql = "SELECT max(id) from materias";
        $listres = SmtConnection::getQuery($lastidsql);
        $row = mysqli_fetch_row($listres);
        $idMat = $row[0];
    } else {
        $update = "UPDATE materias set nome = '{$matName}' where id = '{$idMat}' ";
        $res = SmtConnection::getQuery($update);
    }
    $sql = "DELETE from materiasProfessores where idMat = '{$idMat}'";
    $res = SmtConnection::getQuery($sql);
    foreach ($listProf as $idProf) {
        $sql = "insert into materiasProfessores (idProf, idMat) values ('{$idProf}', '{$idMat}')";
        $res = SmtConnection::getQuery($sql);
    }
    header('HTTP/1.0 200 OK');
    $retorno['code']    = 200;
    $retorno['message'] = "<strong>Matéria cadastrada com sucesso.</strong>";
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
}
