<?php 
if (!empty($_POST)) {
        require('utils/pass.php');
        require('utils/conection.php');
        $idUser = urldecode($_POST["idUser"]) ? urldecode($_POST["idUser"]) : "";
        $userName = urldecode($_POST["userName"]);
        $userEmail = urldecode($_POST["userEmail"]);
        $selectAdmin = urldecode($_POST["selectAdmin"]);
        $normalpass = urldecode($_POST["pass"]);
        $pass = SmtPass::passHash($normalpass);

        $verificar = "";
        if(!empty($idUser)){
            $verificar = " AND users.id != '{$idUser}'";
        }
        $sql = "SELECT user from users WHERE user = '$userEmail'" . $verificar;
        $result = SmtConnection::getQuery($sql);
        if(SmtConnection::getRows($result) > 0){
            header('HTTP/1.0 400 Bad Request');
            $retorno['code']    = 400;
            $retorno['message'] = "<strong>E-mail já cadastrado.</strong>";
            echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
        }else{
            if(empty($idUser)){
                    $sql = "INSERT into users (user, pass, name, admin, date_register)
                    values ('{$userEmail}', '{$pass}', '{$userName}', '{$selectAdmin}', CURRENT_TIMESTAMP);";
                    $result = SmtConnection::getQuery($sql);
                    header('HTTP/1.0 200 OK');
                    $retorno['code']    = 200;
                    $retorno['message'] = "<strong>Usuário cadastrado com sucesso.</strong>";
                    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            }else{
                $sql = "UPDATE users SET name = '{$userName}', user = '{$userEmail}', admin = '{$selectAdmin}' WHERE id = '{$idUser}'";
                $res = SmtConnection::getQuery($sql);
                header('HTTP/1.0 200 OK');
                $retorno['code']    = 200;
                $retorno['message'] = "<strong>Atualizado com sucesso.</strong>";
                echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>
