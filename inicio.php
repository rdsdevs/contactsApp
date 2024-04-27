<?php

require_once "conexion.php";

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
          <p>Aún no tienes contactos guardados</p>
          <a href="agregar.php">Agrega uno!</a>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($contacts as $contact): ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize"><i class="nf nf-fa-user whatsapp h5"></i> <?= $contact["name"] ?>
            </h3>
            <p class="m-2"><i class="nf nf-md-phone_classic whatsapp h5"></i> <?= $contact["phone_number"] ?></p>
            <a href="editar.php?id=<?= $contact["id"] ?>" class="btn btn-outline-warning mb-2">Editar</a>
            <a href="eliminar.php?id=<?= $contact["id"] ?>" class="btn btn-outline-danger mb-2">Eliminar</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
<?php require "partials/footer.php" ?>
