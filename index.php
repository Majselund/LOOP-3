<?php
$mysqli = require __DIR__ . "/database/config.php";
$result = $mysqli->query("SELECT * FROM pages WHERE page = 'home'");

if ($result->num_rows > 0) {
    while ($page = $result->fetch_assoc()) {
        $title = $page['title'];
        $text1 = $page['text1'];
        $text2 = $page['text2'];
        $imageName = $page["image"];
        $imageURL = 'images/' . $page["image"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovationsdage</title>
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="icon" href="icon.svg">
    <script defer src="javascript/heroImage.js"></script>
</head>

<body>
    <div id="hero" class="hero">
        <img src="images/front_pic-10.webp" alt="">
        <div class="content">
            <div class="heroText">
                Velkommen
            </div>
            <a href="#main">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="3em" width="3em" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"></path>
                </svg>
            </a>
        </div>
    </div>
    <?php include('includes/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>
                <?php echo $title ?>
            </h1>
            <div class="prose mx-auto">
                <?php echo $text ?>
            </div><br>
            <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block mx-auto prose" />
        </div>
    </main>
    <?php include('includes/footer.php') ?>
</body>

</html>