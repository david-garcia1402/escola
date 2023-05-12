<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Tamba">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

    <meta name="theme-color" content="#161717">
    <style>
      html, body {
        height: 100%;
      }

      body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #3b3d3f;
      }

      .form-signin {
        max-width: 350px;
        padding: 15px;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }

      .btn-login {
        background-color: #222425;
        color: #fefefe;
      }

      .btn-login:hover {
        background-color: #161717;
        color: #fefefe;
      }
    </style>

    <script>
      function alertMessage() {
        var message =
          '<div class="alert alert-danger alert-dismissible" role="alert" id="msg-alert">'+
          '   <div>Login e/ou senha inválidos!</div>'+
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
          '</div>';

        document.getElementById("alert").innerHTML = message;

        $("#msg-alert").fadeTo(4000, 500).slideUp(500, function () {
          $("#msg-alert").slideUp(500);
        });

        return;
      }      

      function showMessage() {
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error')

        if (error) {
          this.alertMessage()
        }
      }
    </script>
  </head>

  <body class="text-center" onload="showMessage()">
    <main class="form-signin w-100 m-auto">
      <form action="userLogin.php" method="post">
        <img class="mb-4" src="/assets/logo.png" alt="" width="100%">
      <div id="alert"></div>
        <div class="form-floating">
          <input type="email" class="form-control" id="Login" name="Login" placeholder="kkkk">
          <label for="Login">Usuário</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="Pass" name="Pass" placeholder="Senha">
          <label for="Pass">Senha</label>
        </div>
        <div class="row">
          <div class="col-6">
            <button class="w-100 btn btn-lg btn-login mt-2" type="submit">Entrar</button>
          </div>
      </form>
        <div class="col-6">   
          <form action="userCad.php" method="post">    
              <button class="w-100 btn btn-lg btn-login mt-2" type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>

