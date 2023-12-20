<?php
//start en session
session_start();

//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    //opretter forbindelse til databasen
    $mysqli = require __DIR__ . "/../../database/config.php";
    //Henter alt data fra tabellen users hvor id = bruger id fra sessionen
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    //henter data på den pågældende bruger
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
            //Opretter forbindelse til databasen
            $mysqli = require __DIR__ . "/../../database/config.php";
            //vælger alt fra galleriet
            $result = $mysqli->query("SELECT * FROM gallery");

            // Hvis der er mere end 0 rækker udføres if funktionen
            if ($result->num_rows > 0) {
                // Variablen i oprettes som 0
                $i = 0;
                // løkke funktion kører for at gå igennem alle rækker og retunerer alle kolonner for hver række i variablen row
                while ($row = $result->fetch_assoc()) {
                    // variablen i bliver 1 større for hver række løkke funktionen kører igennem.
                    $i++;

                    // Variablen imageURL bliver her sat til stien til galleriet + billede navn fra kolonnen image.
                    $imageURL = '/../../images/gallery/' . $row["image"];
                    // Variablen thumbnailURL bliber her sat til stien + billede navn fra kolonnen image.
                    $thumbImageURL = '/../../images/thumbnails/thumb_' . $row["image"];
                    // Opretter figur , button og thumbnail billede samt delete knap som kan ses hvis logget ind.
                    echo "<figure>";
                    echo "<button id='imageButton" . $i . "'><img src='" . $thumbImageURL . "' alt='Open' width='750'></button>";
                    if (isset($user)) echo "<a class='delete' href='delete.php?id=" . $row['id'] . "'><button><svg stroke='currentColor' fill='currentColor' stroke-width='0' viewBox='0 0 24 24' height='1em' width='1em' xmlns='http://www.w3.org/2000/svg'><path d='M7 4V2H17V4H22V6H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V6H2V4H7ZM6 6V20H18V6H6ZM9 9H11V17H9V9ZM13 9H15V17H13V9Z'></path></svg></button></a>";
                    echo "</figure>";
                    // Opretter div med stort billede med class modal. modal er sat til display=none i css.
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