<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/mat.js"></script>
</head>

<body onload="matList()">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12">
                <h1 class="h2">Cadastro de matérias</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-12">
                <div class="input-group">
                    <button type="button" class="btn btn-primary" onclick="cadastroMatView()" title="Cadastrar registro"><span class="fa fa-plus"></span></button>
                    <input type="text" class="form-control" placeholder="Pesquisar matéria" id="userSearch">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="matFilter()" title="Pesquisar registro"><span class="fa fa-search"></span></button>
                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="matFilterClear()" title="Limpar filtro"><span class="fa fa-trash"></span></button>
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
                    <h2 class="modal-title" id="titleEdit">EDITAR MATÉRIA:</h2>
                </div>
                <div class="modal-body">
                    <div id="alert"></div>
                    <form class="was-validated">
                        <input type="hidden">
                        <div class="container">
                            <div class="row" hidden id="hiddenRowID">
                                <div class="col-12">
                                    <label for="idUser" class="form-label">ID:</label>
                                    <input type="text" class="form-control mb-3" id="idMat" name="idMat">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name" class="form-label">Matéria:</label>
                                    <input type="text" class="form-control" id="matName" name="name" placeholder="Insira a matéria" required>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="profList" class="form-label">Professor:</label>
                                    <div id="profList" class="input-group">
                                        
                                    </div>
                            </div>
                        </div>
                        <div class="row" >
                            <label for="listProf" class="form-label">Professor(res) selecionado(s):</label>
                                <div id="listProf">
                                    
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-primary btn-block" onclick="matRegistered()">Salvar</button>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-3">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" onclick="location.reload()" style="margin-left: 20px;">Fechar</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    <!--Lista-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="listMat"></div>
            </div>
        </div>
    </div>

</body>

</html>