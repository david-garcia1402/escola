function cadastroAlunoView(){
    $("#exampleModal").modal("toggle");
    document.getElementById("titleEdit").setAttribute("hidden", true);
}

function alunoRegistered(){
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
  
    var idAluno = document.getElementById("idAluno").value;
    var alunoNome = document.getElementById("alunoNome").value;
    var turno =
      document.getElementById("turno").children[
        document.getElementById("turno").selectedIndex
      ];
    var turnoContent = turno.textContent.toLowerCase();
  
    var params =
      "idAluno=" +
      encodeURIComponent(idAluno) +
      "&alunoNome=" +
      encodeURIComponent(alunoNome) +
      "&turno=" +
      encodeURIComponent(turnoContent);
  
    console.log(params);
  
    xmlhttp.open("POST", "cadAluno.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}

async function alunoList(filtro = "") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("listAluno").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "listAluno.php?filtro=" + filtro, true);
    xmlhttp.send();
  }

function delAluno(idAluno){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Aluno excluído com sucesso"); 
            location.reload();
        }
    };
    xmlhttp.open("GET", "delAluno.php?idAluno=" + idAluno, true);
    xmlhttp.send();
}


async function alunoFilterClear() {
    document.getElementById("userSearch").value = "";
    alunoList();
  }

  async function alunoFilter() {
    var filtro = document.getElementById("userSearch").value;
  
    alunoList(filtro);
  }

  function alunoEdit(idAluno){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            var retorno = JSON.parse(this.responseText)
            if (retorno) {
                document.getElementById("idAluno").value = retorno.id;
                document.getElementById("alunoNome").value = retorno.nome;
                document.getElementById("turno").value = retorno.turno;
                document.getElementById("titleRegister").setAttribute("hidden", true);
                document.getElementById("titleEdit").removeAttribute("hidden");
                $("#exampleModal").modal("toggle");
            }

        }
    }
    xmlhttp.open("GET", "alunoEdit.php?idAluno=" + idAluno, true);
    xmlhttp.send();

}