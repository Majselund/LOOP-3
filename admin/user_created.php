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
</head>

<body>
  <?php include('includes/navigation.php') ?>
  <main>
    <div class="container mx-auto">
      <h1>Opret bruger</h1>
      <p>Bruger oprettet.</p>
    </div>
  </main>
  <?php include('includes/footer_admin.php') ?>
</body>

</html>