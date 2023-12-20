<?php
session_start();

if (isset($_SESSION["user_id"])) {
  $mysqli = require __DIR__ . "/../database/config.php";
  $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Opret bruger</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../styles/global.css">
  <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
  <?php include('includes/navigation.php') ?>
  <!-- det kontrollerer om man er logget ind. Hvis man er kan man se indholdet på siden "opret bruger" -->
  <?php if (isset($user)) : ?>
    <main>
      <div class="container mx-auto">
        <h1>Opret bruger</h1>
        <p>Bruger oprettet.</p>
      </div>
    </main>
  <?php else : ?>
    <!-- Hvis man ikke er logget ind kan man tilgå "login" -->
    <main>
      <div class="container mx-auto">
        <p><a href="login.php">Log in</a></p>
      </div>
    </main>
  <?php endif; ?>
  <?php include('includes/footer_admin.php') ?>
</body>

</html>