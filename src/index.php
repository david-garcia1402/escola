<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['userId'])) {
      session_destroy();
      header("Location: login.php");
      exit;
  }
?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <meta name="theme-color" content="#712cf9">
  </head>

  <body>
    <?php include_once('includes/header.php');?>

    <div id="content">
      <div class="container-fluid">
        <div class="row">
          <?php include_once('includes/sidebar.php');?>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <?php 
                $page  = $_REQUEST['page'];
                switch ($page) {
                  case 'alunos':
                    include_once('views/alunos.php');
                    break;                  
                  case 'usuarios':
                    include_once('views/usuarios.php');
                    break;
                  
                  default:
                    include_once('views/dashboard.php');
                    break;
                }
            ?>

          </main>
        </div>
      </div>

      <?php include_once('includes/footer.php');?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  </body>
</html>

