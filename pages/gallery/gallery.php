<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../../database/config.php";
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="gallery.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
    <script defer src="../../js/gallery.js"></script>
</head>

<body>
    <?php include('../../includes/navigation.php') ?>
    <main>
        <div class="content " container mx-auto">
            <h1>Galleri</h1>
        </div>
        <div id="masonry" class="masonry">
            <?php
            $mysqli = require __DIR__ . "/../../database/config.php";
            $result = $mysqli->query("SELECT * FROM gallery");

            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    $imageURL = '/../../images/gallery/' . $row["image"];
                    $thumbImageURL = '/../../images/thumbnails/thumb_' . $row["image"];
                    echo "<figure>";
                    echo "<button id='imageButton" . $i . "'><img src='" . $thumbImageURL . "' alt='Open' width='750'></button>";
                    if (isset($user)) echo "<a class='delete' href='delete.php?id=" . $row['id'] . "'><button><svg stroke='currentColor' fill='currentColor' stroke-width='0' viewBox='0 0 24 24' height='1em' width='1em' xmlns='http://www.w3.org/2000/svg'><path d='M7 4V2H17V4H22V6H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V6H2V4H7ZM6 6V20H18V6H6ZM9 9H11V17H9V9ZM13 9H15V17H13V9Z'></path></svg></button></a>";
                    echo "</figure>";
                    echo "<div id='imageModal" . $i . "' class='modal'>";
                    echo "<div id='modalContent" . $i . "' class='modal-content'><img id='bigImage" . $i . "' class='modal-image' src='" . $imageURL . "' alt='' width='1980'></div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </main>
    <?php include('../../includes/footer.php') ?>
</body>

</html>