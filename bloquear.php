<?php
session_start();
session_destroy();

require_once "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["password"])) {
  } else {
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_COOKIE["user"]);
    $statement->execute();

    if ($statement->rowCount() == 0) {
      $error = "Credenciales no válidas.";
    } else {
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($_POST["password"], $user["password"])) {
        $error = "Credenciales no válidas.";
      } else {
        session_start();

        unset($user["password"]);
        $_SESSION["user"] = $user;

        header("Location: inicio.php");
      }
    }
  }
}
?>
<?php require "partials/header.php" ?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><i class="nf nf-fa-user_lock whatsapp"></i> Recuperar sesión</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="bloquear.php">
            <div class="mb-3">
              <p class="h4 text-center"><?php echo $_COOKIE['name']; ?></p>
            </div>

            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Contraseña"
                autocomplete="password" autofocus>
            </div>

            <button type="submit" class="btn btn-outline-success float-end">Iniciar sesión</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "partials/footer.php" ?>
