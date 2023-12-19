<?php
// Opretter forbindelse til database
$mysqli = require __DIR__ . "/../../database/config.php";
// Der hentes data fra databasen. Der hentes alt fra pages hvor page er = about
$result = $mysqli->query("SELECT * FROM pages WHERE page = 'about'");

// Behandler data der er hentet fra databasen fra page = about
if ($result->num_rows > 0) {
    // løkkefunktion 
    while ($page = $result->fetch_assoc()) {
        $title = $page['title'];
        $text1 = $page['text1'];
        $text2 = $page['text2'];
        $imageName = $page["image"];
        $image2Name = $page["image2"];
        $imageURL = '/../../images/' . $page["image"];
        $image2URL = '/../../images/' . $page["image2"];
        $showImage = $page['showImage'];
        $showImage2 = $page['showImage2'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('../../includes/navigation.php') ?>
    <main>
        <div class="content container mx-auto">
            <h1>
                <!-- Viser titlen der er lavet på admin siden -->
                <?php echo $title ?>
            </h1>
            <!-- Viser titlen der er lavet på admin siden -->
            <div class="prose mx-auto">
                <?php echo $text1 ?>
            </div>
            <!-- Viser billedet der er valgt på admin siden -->
            <?php if ($showImage) { ?>
                <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block mx-auto prose" width="100%" />
            <?php } ?>

            <div class="prose mx-auto">
                <?php echo $text2 ?>
            </div>
            <!-- Viser billedet der er valgt på admin siden -->
            <?php if ($showImage2) { ?>
                <img src="<?php echo $image2URL; ?>" alt="<?php echo $image2Name; ?>" class="block mx-auto prose" width="100%" />
            <?php } ?>
        </div>
    </main>
    <?php include('../../includes/footer.php') ?>
</body>

</html>