<?php

require_once "conexion.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$id = $_GET["id"];

$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
$statement->execute([":id" => $id]);

if ($statement->rowCount() == 0) {
  http_response_code(404);
  echo ("HTTP 404 NOT FOUND");
  return;
}

$contact = $statement->fetch(PDO::FETCH_ASSOC);

if ($contact["user_id"] !== $_SESSION["user"]["id"]) {
  http_response_code(403);
  echo ("HTTP 403 UNAUTHORIZED");
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

    $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id = :id");
    $statement->execute([
      ":id" => $id,
      ":name" => $_POST["name"],
      ":phone_number" => $_POST["phone_number"],
    ]);

    $_SESSION["flash"] = ["message" => "Contacto {$_POST['name']} actualizado."];

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
        <div class="card-header"><i class="nf nf-fa-user_pen text-warning"></i> Editar contacto</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="editar.php?id=<?= $contact['id'] ?>">
            <div class="mb-3">
              <input value="<?= $contact['name'] ?>" type="text" class="form-control" name="name" autocomplete="name"
                autofocus>
            </div>

            <div class="mb-3">
              <input value="<?= $contact['phone_number'] ?>" type="text" class="form-control" name="phone_number"
                autocomplete="phone_number" autofocus>
            </div>

            <button type="submit" class="btn btn-outline-warning float-end">Editar contacto</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>
