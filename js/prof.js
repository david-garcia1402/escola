function cadastroUserView() {;
    $("#exampleModal").modal("toggle");
    document.getElementById("titleEdit").setAttribute("hidden", true);
  }

function profRegistered() {
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
    var nome = document.getElementById("profName").value;
    var email = document.getElementById("profEmail").value;
  
    var params =
      "idUser=" +
      encodeURIComponent(idUser) +
      "&profName=" +
      encodeURIComponent(nome) +
      "&profEmail=" +
      encodeURIComponent(email);
  
    console.log(params);
  
    xmlhttp.open("POST", "cadProf.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
  }
  
  function delProf(idUser) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var retorno = JSON.parse(this.responseText);
        var message =
          '<div class="alert  alert-success alert-dismissible fade show" id="msg-alert">' +
          retorno.message +
          "</div>";
        console.log(message);
        document.getElementById("alertDel").innerHTML = message;
  
        $("#msg-alert")
          .fadeTo(2000, 500)
          .slideUp(500, function () {
            $("#msg-alert").slideUp(500);
            location.reload();
          });
      }
      if (this.readyState == 4 && this.status == 400) {
        var retornoError = JSON.parse(this.responseText);
        var message =
          '<div class="alert alert-warning alert-dismissible fade show " id="msg-alert">' +
          retornoError.message +
          "</div>";
        document.getElementById("alertDel").innerHTML = message;
  
        $("#msg-alert")
          .fadeTo(2000, 500)
          .slideUp(500, function () {
            $("#msg-alert").slideUp(500);
          });
      }
    };
  
    xmlhttp.open("GET", "delProf.php?idUser=" + idUser, true);
    xmlhttp.send();
  }
  
  async function profEdit(idUser) {
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
          document.getElementById("profName").value = retorno.name_prof;
          document.getElementById("profEmail").value = retorno.email_prof;
          document.getElementById("titleRegister").setAttribute("hidden", true);
          document.getElementById("titleEdit").removeAttribute("hidden");
          document.getElementById("hiddenRowID").setAttribute("hidden", true);
          $("#exampleModal").modal("toggle");
        }
      }
    };
  
    xmlhttp.open("GET", "profEdit.php?idUser=" + idUser, true);
    xmlhttp.send();
  }
  
  async function profFilter() {
    var filtro = document.getElementById("userSearch").value;
  
    profList(filtro);
  }
  
  async function profList(filtro = "") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("listProf").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "listProf.php?filtro=" + filtro, true);
    xmlhttp.send();
  }
  
  async function profFilterClear() {
    document.getElementById("userSearch").value = "";
    profList();
  }
  
