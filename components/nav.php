<nav class="navbar navbar-expand-lg bg-primary mb-5">
  <div class="container-fluid">
    <a href="../animais/"><img style="width: 70px; " src="../img/Logo.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light fs-5" aria-current="page" href="../animais/">Animais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fs-5" href="../habitat/">Habitats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light fs-5" href="../usuarios/">Usuários</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php
          require_once '../helpers.php';
          if (!usuarioEstaLogado()) {
            echo '<a href="../login/">
                    <button type="button" class="btn btn-outline-light fs-5">Login</button>
                  </a>';
          } else {
            echo '<p class="text-light m-auto px-3 d-none d-md-flex ">'.$_SESSION['usuario_logado'].'</p>';
            echo '<a href="../login/logout.php">
                    <button type="button" class="btn btn-outline-danger fs-5">Logout</button>
                  </a>';
          }
        ?>
      </div>
    </div>
  </div>
</nav>