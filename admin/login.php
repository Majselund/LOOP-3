<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$mysqli = require __DIR__ . "/../database/config.php";

	$sql = sprintf(
		"SELECT * FROM users WHERE email = '%s'",
		$mysqli->real_escape_string($_POST["email"])
	);

	$result = $mysqli->query($sql);
	$user = $result->fetch_assoc();

	if ($user) {
		if (password_verify($_POST["password"], $user["password_hash"])) {
			session_start();
			session_regenerate_id();
			$_SESSION["user_id"] = $user["id"];
			header("Location: index.php");
			exit;
		}
	}

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
</head>

<body>
	<?php include('includes/navigation.php') ?>
	<?php if ($is_invalid) : ?>
		<div class="flex error">
			<em>Invalid login</em>
		</div>
	<?php endif; ?>
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