function matRegistered() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //   var retorno = JSON.parse(this.responseText);
          var message =
            '<div class="alert alert-success alert-dismissible fade show" id="msg-alert">' +
            'Registrado com sucesso!' +
            "</div>";
          document.getElementById("alert").innerHTML = message;
  
          $("#msg-alert")
            .fadeTo(2000, 500)
            .slideUp(500, function () {
              $("#msg-alert").slideUp(500);
            });
        }
        if (this.readyState == 4 && this.status == 400) {
          var retorno = JSON.parse(this.responseText);
          var message =
            '<div class="alert alert-warning alert-dismissible fade show" id="msg-alert">' +
            retorno.message +
            "</div>";
            console.log(message)
          document.getElementById("alert").innerHTML = message;
  
          $("#msg-alert")
            .fadeTo(2000, 500)
            .slideUp(500, function () {
              $("#msg-alert").slideUp(500);
            });
        }
      
    };
    
    var idMat = document.getElementById("idMat").value;
    var matName = document.getElementById("matName").value;
  
    var profStorage = [];
    var listProf = "";
    if (localStorage.profStorage) {
      profStorage = JSON.parse(localStorage.profStorage);
    }
    if (profStorage.length > 0) {
      profStorage.forEach((prof) => {
        if(listProf != "" ){
          listProf += ",";
        }
        listProf += prof.ID;
      });
    }
  
    var params =
      "idMat=" +
      encodeURIComponent(idMat) +
      "&matName=" +
      encodeURIComponent(matName)  +
      "&listProf=" +
      encodeURIComponent(listProf);
      console.log(params)
  
    xmlhttp.open("POST", "cadMat.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
  }
  
  function cadastroMatView() {
    profLoad();
    prepareCadMat();
    $("#exampleModal").modal("toggle");
    document.getElementById("titleEdit").setAttribute("hidden", true);
  }
  
  function delMat(idMat) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        alert("Matéria deletada com sucesso!");
        location.reload();
      }
    };
  
    xmlhttp.open("GET", "delMat.php?idMat=" + idMat, true);
    xmlhttp.send();
  }
  
  async function matEdit(idMat) {
    if (idMat == "" || idMat == 0) {
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
            console.log(retorno);
            document.getElementById("idMat").value = retorno.id;
            document.getElementById("matName").value = retorno.nome;
            localStorage.profStorage = JSON.stringify(retorno.items);
            listProfStorage();
            document.getElementById("titleRegister").setAttribute("hidden", true);
            document.getElementById("titleEdit").removeAttribute("hidden");
            document.getElementById("hiddenRowID").setAttribute("hidden", true);
            profLoad();
            $("#exampleModal").modal("toggle");
        }
      }
    };
  
    xmlhttp.open("GET", "matEdit.php?idMat=" + idMat, true);
    xmlhttp.send();
  }
  
  async function matFilter() {
    var filtro = document.getElementById("userSearch").value;
  
    matList(filtro);
  }
  
  async function matList(filtro = "") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("listMat").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "listMat.php?filtro=" + filtro, true);
    xmlhttp.send();
  }
  
  async function matFilterClear() {
    document.getElementById("userSearch").value = "";
    matList();
  }
  
  function prepareCadMat() { 
    profStorage = [];
    if(localStorage.profStorage){
      profStorage = JSON.parse(localStorage.profStorage);
      localStorage.clear();
    }
  }

  function profLoad() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("profList").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "getProf.php", true);
    xmlhttp.send();
  }

  function addProfList() {
    var idProf = document.getElementById("cbProfessor").value;
    var texto =
      document.getElementById("cbProfessor").children[
        document.getElementById("cbProfessor").selectedIndex
      ];
    var profName = texto.textContent;
    console.log(idProf);
    console.log(profName);
  
    if (idProf == 0) {
      var message =
        '<div class="alert alert-danger alert-dismissible fade show" id="msg-alert">' +
        "<strong>Erro,</strong> escolha pelo menos um professor para dar a matéria!" +
        "</div>";
  
      document.getElementById("alert").innerHTML = message;
  
      $("#msg-alert")
        .fadeTo(2000, 500)
        .slideUp(500, function () {
          $("#msg-alert").slideUp(500);
        });
    } else {
      var profStorage = [];
      if (localStorage.profStorage) {
        profStorage = JSON.parse(localStorage.profStorage);
      }
      var profAdd = false;
      profStorage.forEach((prof) => {
        if (prof.NAME == profName) {
          profAdd = true;
        }
      });
  
      var index = profStorage[idProf];
      if (!profAdd && index) {
        prof.NAME = profName;
        profAdd = true;
      }
  
      if (!profAdd) {
        profStorage.push({
          NAME: profName,
          ID: idProf,
        });
      }
  
      localStorage.profStorage = JSON.stringify(profStorage);
      listProfStorage();
    }
    profLoad();
  }
  
  //Listar os professores do localstorage
  function listProfStorage() {
    var profStorage = [];
    var listProf = "";
    if (localStorage.profStorage) {
      profStorage = JSON.parse(localStorage.profStorage);
    }
    if (profStorage.length > 0) {
      listProf += "<ul class='list-group mb-3' style='width: 100%;'>";
      profStorage.forEach((prof, index) => {
        listProf += "<li class='list-group-item' id='" + index + "'><span>" + prof.NAME + "</span><span title='Deletar professor relacionado.' onclick='delListProf("+ index +")' class='fa fa-times-circle position-absolute top-50 end-0 translate-middle-y mx-2'></span></li>";
      });
      listProf += "</ul>";
    }
  
    document.getElementById("listProf").innerHTML = listProf;
  }
  
  function delListProf(index){
    var profStorage = [];
    if (localStorage.profStorage) {
      profStorage = JSON.parse(localStorage.profStorage);
    }
    profStorage.splice(index, 1);
    localStorage.profStorage = JSON.stringify(profStorage);
    listProfStorage();
  }