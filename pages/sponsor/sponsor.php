<?php

$page = 'sponsor';
// Henter mysqli variablen fra database config filen.
$mysqli = require __DIR__ . "/../../database/config.php";
// Det er en SQL-dataforespørgsel til databasen
//vælger alt fra tabellen pages hvor page = sponsor
$result = $mysqli->query("SELECT * FROM pages WHERE page = '" . $page . "'");

// Henter første række fra databasen.
$page = $result->fetch_assoc();

// nedenstående inkluderer variabeldeklarationer, hvor værdierne hentes fra hver enkelt kolonne¨
$title = $page['title'];
$text1 = $page['text1'];
$text2 = $page['text2'];
$imageName = $page["image"];
$image2Name = $page["image2"];
$imageURL = '/../../images/' . $page["image"];
$image2URL = '/../../images/' . $page["image2"];
$showImage = $page['showImage'];
$showImage2 = $page['showImage2'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovationsdage</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('../../includes/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>
                <!-- henter title fra databasen -->
                <?php echo $title ?>
            </h1>

            <div class="prose mx-auto">
                <!-- henter tekstfelt 1 fra databasen -->
                <?php echo $text1 ?>
            </div>

            <!-- Hvis 'showimage' er sand vises billedet -->
            <?php if ($showImage) { ?>
                <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block mx-auto prose" width="100%" />
            <?php } ?>

            <div class="prose mx-auto">
                <!-- Henter tekstfelt 2 -->
                <?php echo $text2 ?>
            </div>

            <!-- Henter billede 2 hvis 'showimage2' er sandt -->
            <?php if ($showImage2) { ?>
                <img src="<?php echo $image2URL; ?>" alt="<?php echo $image2Name; ?>" class="block mx-auto prose" width="100%" />
            <?php } ?>

        </div>
    </main>
    <?php include('../../includes/footer.php') ?>
</body>

</html>