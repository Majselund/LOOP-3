<!DOCTYPE html>
<html>

<head>
  <title>Side redigeret</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../styles/global.css">
  <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
  <?php include('includes/navigation.php') ?>
  <!-- Hvis man er logget ind kan man se nedenstående -->
  <?php if (isset($user)) : ?>
    <main>
      <div class="container mx-auto">
        <h1>Side redigeret</h1>
        <p>Siden er gemt</p>
      </div>
    </main>
    <!-- Hvis man ikke er logget ind kan man se nedenstående -->
  <?php else : ?>
    <main>
      <div class="container mx-auto">
        <p><a href="login.php">Log in</a></p>
      </div>
    </main>
  <?php endif; ?>
  <?php include('includes/footer_admin.php') ?>
</body>

</html>