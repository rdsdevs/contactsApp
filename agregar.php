<?php

require_once "conexion.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"]) || empty($_POST["phone_number"])) {
    $error = "Por favor llene todos los campos.";
  } else if (strlen($_POST["phone_number"]) < 10) {
    $error = "El número de teléfono debe tener al menos 10 caracteres.";
  } else {
    $name = $_POST["name"];
    $phoneNumber = $_POST["phone_number"];

    $statement = $conn->prepare("INSERT INTO contacts (user_id, name, phone_number) VALUES ({$_SESSION['user']['id']}, :name, :phone_number)");
    $statement->bindParam(":name", $_POST["name"]);
    $statement->bindParam(":phone_number", $_POST["phone_number"]);
    $statement->execute();

    $_SESSION["flash"] = ["message" => "Contacto {$_POST['name']} agregad@."];

    header("Location: inicio.php");
    return;
  }
}
?>

<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><i class="nf nf-fa-users whatsapp"></i> Agregar nuevo contacto</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="agregar.php">
            <div class="mb-3">
              <input type="text" class="form-control" name="name" placeholder="Nombre del contacto" autocomplete="name"
                autofocus>
            </div>

            <div class="mb-3">
              <input type="tel" class="form-control" name="phone_number" placeholder="Número de teléfono"
                autocomplete="phone_number" autofocus>
            </div>
            <button type="submit" class="btn btn-outline-success float-end">Agregar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>
