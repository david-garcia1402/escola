<?php 
if (!empty($_POST)) {
        require('utils/pass.php');
        require('utils/conection.php');
        $idUser = urldecode($_POST["idUser"]) ? urldecode($_POST["idUser"]) : "";
        $profName = urldecode($_POST["profName"]);
        $profEmail = urldecode($_POST["profEmail"]);

        $verificar = "";
        if(!empty($idUser)){
            $verificar = " AND professores.id != '{$idUser}'";
        }
        $sql = "SELECT email_prof from professores WHERE email_prof = '$profEmail'" . $verificar;
        $result = SmtConnection::getQuery($sql);
        if(SmtConnection::getRows($result) > 0){
            header('HTTP/1.0 400 Bad Request');
            $retorno['code']    = 400;
            $retorno['message'] = "<strong>E-mail já cadastrado.</strong>";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        }else{
            if(empty($idUser)){
                    $sql = "INSERT into professores (name_prof, email_prof)
                    values ('{$profName}', '{$profEmail}');";
                    $result = SmtConnection::getQuery($sql);
                    header('HTTP/1.0 200 OK');
                    $retorno['code']    = 200;
                    $retorno['message'] = "<strong>Professor cadastrado com sucesso.</strong>";
                    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            }else{
                $sql = "UPDATE professores SET name_prof = '{$profName}', email_prof = '{$profEmail}' WHERE id = '{$idUser}'";
                $res = SmtConnection::getQuery($sql);
                header('HTTP/1.0 200 OK');
                $retorno['code']    = 200;
                $retorno['message'] = "<strong>Atualizado com sucesso.</strong>";
                echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>
