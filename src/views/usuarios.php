<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  $admin = isset($_SESSION['userAdmin']) ? $_SESSION['userAdmin'] : false;

  if (!$admin) {
      exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/data.js"></script>
</head>
    <body onload="userList()">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12">
                    <h1 class="h2">Cadastro de usuários</h1>
                </div>
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="input-group">
                        <button type="button" class="btn btn-primary" onclick="cadastroUserView()" title="Cadastrar registro"><span class="fa fa-plus"></span></button>
                        <input type="text" class="form-control" placeholder="Pesquisar registro" id="userSearch">
                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="userFilter()" title="Pesquisar registro"><span class="fa fa-search"></span></button>
                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="userFilterClear()" title="Limpar filtro"><span class="fa fa-trash"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title " id="titleRegister">CADASTRO:</h2>
                <h2 class="modal-title" id="titleEdit">EDITAR USUÁRIO:</h2>
            </div>
        <div class="modal-body">
            <div id="alert"></div>
            <form class="was-validated"> 
                <input type="hidden">  
                <div class ="container">
                    <div class="row" hidden id="hiddenRowID">
                        <div class="col-12">
                            <label for="idUser" class="form-label">ID:</label>
                            <input type="text" class="form-control mb-3" id="idUser" name="idUser">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">  
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="userName" name="name" placeholder="Insira seu nome" required>
                        </div>
                    </div>
                    <div class="row">               
                        <div class="col-12 mb-3">  
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" id="userEmail" name="userEmail" class="form-control" placeholder = "Insira seu e-mail"required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1" id="divPassword">  
                            <label for="password">Senha:</label>
                            <input type="password" id = "password" name="password" class="form-control mb-3" required>
                        </div>
                    </div>                    
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label" hidden id="label-edit-admin">Cargo atual:</label>
                            <label class="form-label" id="label-cad-admin">Cargo:</label>
                                <select id="selectAdmin">
                                        <option value="1">Admin</option>
                                        <option value="0">Não admin</option>
                                </select>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-block" onclick="userRegistered()">Salvar</button>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-3">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" onclick="location.reload()" style="margin-left:20px">Fechar</button>
                    </div>    
                    </div>
                </div>
                </div>
            </div>
            </form>
        </div>
        </div>
        <!--Lista-->
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div id="listUsers"></div>
            </div>
            </div>
        </div>
        
    </body>
</html>