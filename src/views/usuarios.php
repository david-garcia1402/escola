<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  $admin = isset($_SESSION['userAdmin']) ? $_SESSION['userAdmin'] : false;

  if (!$admin) {
      exit;
  }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de usuários</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
    </div>
    </div>
</div>