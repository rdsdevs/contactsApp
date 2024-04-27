<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand font-weight-bold whatsapp" href="index.php">
      <img class="mr-2" src="./static/img/logo.png" />
      ContactsApp
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="d-flex justify-content-between w-100">
        <?php $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?>
        <?php if ($uri != '/contactsApp/bloquear.php'): ?>
          <ul class="navbar-nav">
            <?php if (isset($_SESSION["user"])): ?>
              <li class="nav-item">
                <a class="nav-link" href="inicio.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="agregar.php">Agregar contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bloquear.php">Bloquear sesión</a>
              </li>
              <li>
                <a class="nav-link" href="logout.php">Cerrar sesión</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="registrar.php">Registrate</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Iniciar sesión</a>
              </li>
            <?php endif ?>
          </ul>
        <?php endif ?>

        <?php if (isset($_SESSION["user"]) && $uri != '/contactsApp/bloquear.php'): ?>
          <div class="p-2">
            <i class="nf nf-fa-user_o whatsapp"></i>
            <?= $_SESSION["user"]["name"] ?>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</nav>
