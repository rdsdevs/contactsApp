<nav>
  <div>
    <a href="index.php">
      ContactsApp
    </a>
    <div>
      <ul>
        <?php if (isset($_SESSION["user"])): ?>
          <li>
            <a href="inicio.php">Inicio</a>
          </li>
          <li>
            <a href="agregar.php">Agregar contacto</a>
          </li>
          <li>
            <a href="logout.php">Cerrar sesión</a>
          </li>
        <?php else: ?>
          <li>
            <a href="registrar">Registrate</a>
          </li>
          <li>
            <a href="login.php">Iniciar sesión</a>
          </li>
        <?php endif ?>
      </ul>
      <?php if (isset($_SESSION["user"])): ?>
        <div class="p-2">
          <?= $_SESSION["user"]["email"] ?>
        </div>
      <?php endif ?>
    </div>
  </div>
</nav>
