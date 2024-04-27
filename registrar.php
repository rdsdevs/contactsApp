<?php

require_once "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Por favor complete todos los campos.";
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

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><i class="nf nf-fa-user_plus whatsapp"></i> Registrate aquí</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="registrar.php">
            <!-- Nombre -->
            <div class="mb-3">
              <input type="text" class="form-control" name="name" placeholder="Nombre" autocomplete="nombre" autofocus>
            </div>
            <!-- Correo -->
            <div class="mb-3">
              <input type="text" class="form-control" name="email" placeholder="Correo" autocomplete="email" autofocus>
            </div>

            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Contraseña"
                autocomplete="password" autofocus>
            </div>

            <button type="submit" class="btn btn-outline-success float-end">Registar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>
