<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Contacts App</title>
</head>

<body>
  <?php require "navbar.php" ?>
  <?php if (isset($_SESSION["flash"])): ?>
    <div>
      <?= $_SESSION["flash"]["message"] ?>
    </div>
    <?php unset($_SESSION["flash"]) ?>
  <?php endif ?>
  <main>
    <!-- Content Here -->
