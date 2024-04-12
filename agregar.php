<?php

require "conexion.php";

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

<div>
  <div>Agregar nuevo contacto</div>
  <div>
    <?php if ($error): ?>
      <p style="color:darkred">
        <?= $error ?>
      </p>
    <?php endif ?>
    <form method="POST" action="agregar.php">
      <div style="margin-bottom: 1rem;">
        <input type="text" name="name" placeholder="Nombre del contacto" autocomplete="name" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <input type="tel" name="phone_number" placeholder="Número de teléfono" autocomplete="phone_number" autofocus>
      </div>

      <div style="margin-bottom: 1rem;">
        <div class="col-md-6 offset-md-4">
          <input type="submit" value="Agregar">
        </div>
      </div>
    </form>
  </div>
</div>


<?php require "partials/footer.php" ?>
