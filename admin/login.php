<?php
$is_invalid = false;

// Tjekker om POST er submitted. Hvis den er det så kører if funktionen.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// opretter forbindelse til databasen
	$mysqli = require __DIR__ . "/../database/config.php";
	// vælg alt fra tabellen users hvor email
	$sql = sprintf(
		"SELECT * FROM users WHERE email = '%s'",
		$mysqli->real_escape_string($_POST["email"])
	);

	$result = $mysqli->query($sql);
	$user = $result->fetch_assoc();

	// Hvis man er logget ind sker der nedenstående if funktion
	if ($user) {
		// Sikrer at ´hash matcher det indtastede kodeord. 
		if (password_verify($_POST["password"], $user["password_hash"])) {
			session_start();
			//regenererer session id. Det gør at siden ikke er sårbar. Fordi når man kommer ind på login siden vil sessionen allerede være startet fra index siden.
			session_regenerate_id();
			$_SESSION["user_id"] = $user["id"];
			header("Location: index.php");
			exit;
		}
	}
	//Variabel der viser at enten login eller kodeord er forkert
	//I body ses en if struktur hvis ens login ikke er valid
	$is_invalid = true;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../styles/global.css">
	<link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
	<link rel="stylesheet" href="./login.css">
	<link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
	<?php include('includes/navigation.php') ?>
	<!-- Hvis login er invalid -->
	<?php if ($is_invalid) : ?>
		<div class="flex error">
			<em>Invalid login</em>
		</div>
	<?php endif; ?>
	<!-- Hvis man ikke er logget ind ser man nedenstående main -->
	<main>
		<div id="main" class="content container mx-auto">
			<h1>Login</h1>
			<div id="main" class="content container mx-auto prose">
				<form method="post">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
					<input type="submit" name="submit" value="Log ind">
				</form>
			</div>
		</div>
	</main>
	<?php include('includes/footer_admin.php') ?>
</body>

</html>