<?php

require "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Por favor complete todos los campos.";
    var_dump(!str_contains($_POST["email"], "@"));
    die();
  } else if (!str_contains($_POST["email"], "@")) {
    $error = "El formato del correo electrónico es incorrecto.";
  } else {
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $statement->bindParam(":email", $_POST["email"]);
    $statement->execute();

    if ($statement->rowCount() > 0) {
      $error = "Este correo electrónico está en uso.";
    } else {
      $conn
        ->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)")
        ->execute([
          ":name" => $_POST["name"],
          ":email" => $_POST["email"],
          ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
        ]);

      $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      session_start();
      $_SESSION["user"] = $user;

      header("Location: inicio.php");
    }
  }
}
?>

<?php require "partials/header.php" ?>

<div>
  <div>Registrate aquí</div>
  <div>
    <?php if ($error): ?>
      <p style="color:darkred">
        <?= $error ?>
      </p>
    <?php endif ?>
    <form method="POST" action="registrar">
      <!-- Nombre -->
      <div style="margin-bottom: 1rem;">
        <input type="text" name="name" placeholder="Nombre" autocomplete="nombre" autofocus>
      </div>
      <!-- Correo -->
      <div style="margin-bottom: 1rem;">
        <input type="text" name="email" placeholder="Correo" autocomplete="email" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <input type="password" name="password" placeholder="Contraseña" autocomplete="password" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <input type="submit" value="Registar">
      </div>
    </form>
  </div>
</div>

<?php require "partials/footer.php" ?>
