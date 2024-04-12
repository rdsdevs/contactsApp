<?php

require "conexion.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$contacts = $conn->query("SELECT * FROM contacts WHERE user_id = {$_SESSION['user']['id']}");

?>

<?php require "partials/header.php" ?>

<div class="container pt-4 p-3">
  <div class="row">

    <?php if ($contacts->rowCount() == 0): ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p style="color:darkviolet">Aún no hay contactos guardados</p>
          <a href="agregar.php">Agrega uno!</a>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($contacts as $contact): ?>
      <div style="margin-bottom: 1rem;">
        <h3 class="card-title text-capitalize"><?= $contact["name"] ?></h3>
        <p style="margin: 1rem;"><?= $contact["phone_number"] ?></p>
        <div>
          <a href="editar.php?id=<?= $contact["id"] ?>" style="color:darkorange; margin-bottom: 1rem;">Editar</a>
          <a href="eliminar.php?id=<?= $contact["id"] ?>" style="color:darkred; margin-bottom: 1rem;">Eliminar</a>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>

<?php require "partials/footer.php" ?>
