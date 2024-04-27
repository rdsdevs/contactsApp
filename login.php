<?php

require_once "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Por favor complete todos los campos.";
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "El formato del correo electrónico es incorrecto.";
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

        setcookie("user", $user["email"], time() + 20 * 24 * 60 * 60);
        setcookie("name", $user["name"], time() + 20 * 24 * 60 * 60);
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
        <div class="card-header"><i class="nf nf-fa-user_shield whatsapp"></i> Inicia sesión para gestionar tus
          contactos
        </div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="login.php">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Correo" autocomplete="email" autofocus>
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
