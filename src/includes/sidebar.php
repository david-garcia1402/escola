<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?page=dashboard">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?page=alunos">
              <span data-feather="home" class="align-text-bottom"></span>
              Alunos
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?page=professores">
              <span data-feather="home" class="align-text-bottom"></span>
              Professores
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?page=materias">
              <span data-feather="home" class="align-text-bottom"></span>
              Matérias
            </a>
          </li>
          <?php 
              $admin = isset($_SESSION['userAdmin']) ? $_SESSION['userAdmin'] : false;
              if ($admin) {
                echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=usuarios">
                          <span data-feather="home" class="align-text-bottom"></span>
                          Usuários
                        </a>
                      </li>';
              }
          ?>          
        </ul>
      </div>
    </nav>