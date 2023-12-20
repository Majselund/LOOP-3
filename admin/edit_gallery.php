<?php
//start en session
session_start();

//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    //opretter forbindelse til databasen
    $mysqli = require __DIR__ . "/../database/config.php";
    //Henter alt data fra tabellen users hvor id = bruger id fra sessionen
    $result = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    //henter data på den pågældende bruger
    $user = $result->fetch_assoc();
}

$targetDir = '/var/www/innovationsdage.dk/public_html/images/gallery/';
$thumbnailDir = '/var/www/innovationsdage.dk/public_html/images/thumbnails/';
$statusMsg = '';

//Hvis et eller flere billeder er sendt som post via formen når brugeren har trykket på submit knappen kører følgende if struktur
if (isset($_POST['submit'])) {

    // Tjekker om der er et billede uploaded og om dette er sendt som array. Hvis ikke returnerer vi en fejl.
    if (!empty($_FILES["image"]["name"]) && is_array($_FILES["image"]["name"])) {
        $imageNames = $_FILES["image"]["name"];
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        $uploadStatus = [];

        // Looper igennem array'et imageNames og sætter hver enkelte billede navn til imageName
        foreach ($imageNames as $key => $imageName) {
            // Tjekker filtypen på det billede der er uploaded og gemmer det i variablen imageType
            $imageType = pathinfo($imageName, PATHINFO_EXTENSION);
            // Tjekker om fil typen for billedet er en del af array'et for tilladte filtyper. I så fald går vi videre ellers returnerer vi en fejl.
            if (in_array($imageType, $allowTypes)) {
                $targetImagePath = $targetDir . $imageName;

                // Forsøger at flytte det uploadede billede til targetImagePath som er placeringen hvor billedet skal ligge på filserveren samt billedenavn og type.
                // Lykkedes det at flytte billedet fortsætter vi videre ellers returnerer vi en fejl.
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetImagePath)) {
                    // Nedenfor definerer vi først vores sql query hvor vi fortæller at imageName skal indsættes i tabellen gallery
                    $sql = "INSERT INTO gallery (image) VALUES (?)";

                    // Derefter klargør vi vores statement for at kunne binde vores imageName til sql querien 
                    $stmt = $mysqli->stmt_init();
                    if (!$stmt->prepare($sql)) {
                        $uploadStatus[] = "SQL error for $imageName: " . $mysqli->error;
                    } else {
                        $stmt->bind_param("s", $imageName);
                        // Til sidst kører vi execute for at indsætte billede navnet i databasen. Lykkedes dette går vi videre til at lave vore thumbnail billede.
                        if ($stmt->execute()) {
                            $uploadStatus[] = "File $imageName uploaded successfully.";

                            // Her definerer vi vores fulde thumbnail path som består af vores directory path samt billedenavn som vi prefixer med thumb_.
                            $thumbnailPath = $thumbnailDir . 'thumb_' . $imageName;
                            // Her aflæser vi bredde og højde for vores originale billede
                            list($width, $height) = getimagesize($targetImagePath);

                            // For at vores galleri ser pænt ud har vi valgt at hvert thumbnail billede skal have en bredde på 750px.
                            $thumbWidth = 750;
                            // Da alle billeder ikke har samme aspect ratio og gerne vil have en fixed bredde bliver vi nød til at beregne højden for hvert thumbnail billede.
                            $thumbHeight = floor($height * ($thumbWidth / $width));

                            // Her laver vi et nyt blankt true color image i vores server hukommelse med den bredde og højde vi gerne vil have vores thumbnail billede til at være.
                            $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
                            // For at lave billede manipulation bliver vi nød til at have vores originale billede i server hukommelsen. Det gør vi nedenfor ved imagecreatefromjpeg funktionen. 
                            $source = imagecreatefromjpeg($targetImagePath);
                            // Nu kan vi tage vores billede og kopierer det ind på vores true color image i den rigtige størrelse. Alt foregår stadig i server hukommelsen.
                            imagecopyresized($thumb, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                            // Her gemmer vi det nye thumbnail billede som jpeg.
                            imagejpeg($thumb, $thumbnailPath);

                            // Vi har nu vores thumbnail billede og har ikke længere brug for vores true color image og originale billede og fjerner det der for fra vores server hukommelse.
                            imagedestroy($thumb);
                            imagedestroy($source);
                        } else {
                            $uploadStatus[] = "Error inserting $imageName into the database.";
                        }
                    }
                } else {
                    $uploadStatus[] = "Error uploading $imageName.";
                }
            } else {
                $uploadStatus[] = "Invalid file type for $imageName.";
            }
        }

        // Combine upload status messages into one message
        $statusMsg = implode("<br>", $uploadStatus);
    } else {
        $statusMsg = "No images selected.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediger side</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="stylesheet" href="./edit_page.css">
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/i2q56l2uu4wsqfm78zlcivot3qxhn06jbgpapqk5b0h1o3vd/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <?php if (isset($user)) : ?>
        <main>
            <div id="main" class="content container mx-auto">
                <h1>Upload billeder til galleri</h1>
                <?php include('includes/second_nav.php') ?>
                <div id="main" class="content container mx-auto prose">
                    <?php if (!empty($statusMsg)) { ?>
                        <p class="stmsg"><?php echo $statusMsg; ?></p>
                    <?php } ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <label for="image">Image</label>
                        <input type="file" name="image[]" id="image" multiple>
                        <input type="submit" name="submit" value="GEM">
                    </form>
                    <p>Gå til galleri siden for at slette billeder.</p>
                </div>
        </main>
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