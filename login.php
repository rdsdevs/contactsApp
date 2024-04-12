<?php

require "conexion.php";

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

        unset($user["password"]);

        $_SESSION["user"] = $user;

        header("Location: inicio.php");
      }
    }
  }
}
?>

<?php require "partials/header.php" ?>

<div>
  <div>Inicia sesión para gestionar tus contactos</div>
  <div>
    <?php if ($error): ?>
      <p style="color: darkred">
        <?= $error ?>
      </p>
    <?php endif ?>
    <form method="POST" action="login.php">
      <div style="margin-bottom: 1rem;">
        <input type="email" name="email" placeholder="Correo" autocomplete="email" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <input type="password" name="password" placeholder="Contraseña" autocomplete="password" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <input type="submit" value="Iniciar sesión">
      </div>
    </form>
  </div>
</div>

<?php require "partials/footer.php" ?>
