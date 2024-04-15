<?php
session_start();
session_destroy();

require_once "conexion.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["password"])) {
  } else {
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement->bindParam(":email", $_COOKIE["user"]);
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
<div>
  <div>Recuperar sesión</div>
  <div>
    <?php if ($error): ?>
      <p style="color: darkred">
        <?= $error ?>
      </p>
    <?php endif ?>
    <form method="POST" action="bloquear.php">
      <div style="margin-bottom: 1rem;">
        <span style="font-weight: bold;"><?php echo $_COOKIE['name']; ?></span>
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
