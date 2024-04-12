<?php

require "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Por favor complete todos los campos.";
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "Email format is incorrect.";
  } else {
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_POST["email"]);
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
        <div class="card-header">Inicia sesión para gestionar tus contactos</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="login.php">
            <div style="margin-bottom: 1rem;">
              <input id="email" type="email" name="email" placeholder="Correo" autocomplete="email" autofocus>
            </div>

            <div style="margin-bottom: 1rem;">
              <input id="password" type="password" name="password" placeholder="Contraseña" autocomplete="password"
                autofocus>
            </div>

            <div style="margin-bottom: 1rem;">
              <input type="submit" value="Iniciar sesión">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>
