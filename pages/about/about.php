<?php
$mysqli = require __DIR__ . "/../../database/config.php";
$result = $mysqli->query("SELECT * FROM pages WHERE page = 'about'");

if ($result->num_rows > 0) {
    while ($page = $result->fetch_assoc()) {
        $title = $page['title'];
        $text1 = $page['text1'];
        $text2 = $page['text2'];
        $imageName = $page["image"];
        $imageURL = '/../../images/' . $page["image"];
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
</head>

<body>
    <?php include('../../includes/navigation.php') ?>
    <main>
        <div class="content container mx-auto">
            <h1>
                <?php echo $title ?>
            </h1>
            <div class="prose mx-auto">
                <?php echo $text1 ?>
            </div>

            <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block mx-auto prose" width="100%" />

            <div class="prose mx-auto">
                <?php echo $text2 ?>
            </div>

            <img src="<?php echo $image2URL; ?>" alt="<?php echo $image2Name; ?>" class="block mx-auto prose" width="100%" />
        </div>
    </main>
    <?php include('../../includes/footer.php') ?>
</body>

</html>