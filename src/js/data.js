function cadastroView() {
  $("#exampleModal").modal("toggle");
  document.getElementById("titleEdit").setAttribute("hidden", true);
}

function userRegistered() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        var retorno = JSON.parse(this.responseText);
        var message =
          '<div class="alert alert-success alert-dismissible fade show" id="msg-alert">' +
          retorno.message +
          "</div>";

        document.getElementById("alert").innerHTML = message;

        $("#msg-alert")
          .fadeTo(2000, 500)
          .slideUp(500, function () {
            $("#msg-alert").slideUp(500);
          });
      }
      if (this.status == 400) {
        var retorno = JSON.parse(this.responseText);
        var message =
          '<div class="alert alert-warning alert-dismissible fade show" id="msg-alert">' +
          retorno.message +
          "</div>";

        document.getElementById("alert").innerHTML = message;

        $("#msg-alert")
          .fadeTo(2000, 500)
          .slideUp(500, function () {
            $("#msg-alert").slideUp(500);
          });
      }
    }
  };

  var idUser = document.getElementById("idUser").value;
  var nome = document.getElementById("userName").value;
  var email = document.getElementById("userEmail").value;
  var senha = document.getElementById("password").value;
  var valoradm = document.getElementById("selectAdmin").value;

  var params =
    "idUser=" +
    encodeURIComponent(idUser) +
    "&userName=" +
    encodeURIComponent(nome) +
    "&userEmail=" +
    encodeURIComponent(email) +
    "&pass=" +
    encodeURIComponent(senha) +
    "&selectAdmin=" +
    encodeURIComponent(valoradm);
  console.log(params);

  xmlhttp.open("POST", "cadUser.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(params);
}

async function userList(filtro = "") {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("listUsers").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "listUsers.php?filtro=" + filtro, true);
  xmlhttp.send();
}

async function userFilter() {
  var filtro = document.getElementById("userSearch").value;
  console.log(filtro);

  userList(filtro);
}
async function userFilterClear() {
  document.getElementById("userSearch").value = "";
  userList();
}

async function userEdit(idUser) {
  if (idUser == "" || idUser == 0) {
    var message =
      '<div class="alert alert-danger alert-dismissible fade show" id="msg-alert">' +
      '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
      "<strong>Error!</strong> Pick one item!" +
      "</div>";

    document.getElementById("alert").innerHTML = message;

    $("#msg-alert")
      .fadeTo(2000, 500)
      .slideUp(500, function () {
        $("#msg-alert").slideUp(500);
      });

    return;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var retorno = JSON.parse(this.responseText); //this responseText tem os valores da coluna do SQL selecionados no PHP
      if (retorno) {
        document.getElementById("idUser").value = retorno.id;
        document.getElementById("userName").value = retorno.name;
        document.getElementById("userEmail").value = retorno.user;
        document.getElementById("selectAdmin").value = retorno.admin;
        document.getElementById("titleRegister").setAttribute("hidden", true);
        document.getElementById("titleEdit").removeAttribute("hidden");
        document.getElementById("label-edit-admin").removeAttribute("hidden");
        document.getElementById("password").removeAttribute("required");
        document.getElementById("hiddenRowID").setAttribute("hidden", true);
        document.getElementById("label-cad-admin").setAttribute("hidden", true);
        document.getElementById("divPassword").setAttribute("hidden", true);
        $("#exampleModal").modal("toggle");
      }
    }
  };

  xmlhttp.open("GET", "userEdit.php?idUser=" + idUser, true);
  xmlhttp.send();
}

function delUser(idUser) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      alert("Usuário deletado com sucesso!");
      location.reload();
    }
  };

  xmlhttp.open("GET", "delUser.php?idUser=" + idUser, true);
  xmlhttp.send();
}
