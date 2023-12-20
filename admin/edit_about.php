<?php
session_start();

$page = 'about';
// Henter mysqli variablen fra database config filen.
$mysqli = require __DIR__ . "/../database/config.php";

//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    //vælger alt fra tabellen users hvor id = user_id
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}

//vælger alt fra tabellen pages hvor page = about
$getPage = $mysqli->query("SELECT * FROM pages WHERE page = '" . $page . "'");

$page = $getPage->fetch_assoc();

//læser alt det der står i row for siden "about"
$title = $page['title'];
$text1 = $page['text1'];
$text2 = $page['text2'];
$imageName = $page["image"];
$image2Name = $page["image2"];
$imageURL = '/../images/' . $page["image"];
$image2URL = '/../images/' . $page["image2"];
$showImage = $page['showImage'];
$showImage2 = $page['showImage2'];

$statusMsg = '';

// Hvis der submittes en POST (altså indhold fra edit siden), så sendes der indhold for hver variabel til databasen
if (isset($_POST['submit'])) {
    $page = 'about';
    $title = $_POST['title'];
    $text1 = $_POST['page_editor1'];
    $text2 = $_POST['page_editor2'];
    // hvis vi prøver at sende 1 så sender den 1, ellers så sender den 0. Normalt sender et input type=checked ikke nogen værdi hvis den ikke er checked.
    // Det vil sige at når slideren bliver blå så er det = 1, og dermed vises billedet på siden.
    $showImage = isset($_POST['showImage']) && $_POST['showImage'] == '1' ? 1 : 0;
    $showImage2 = isset($_POST['showImage2']) && $_POST['showImage2'] == '1' ? 1 : 0;

    $targetDir = '/var/www/innovationsdage.dk/public_html/images/';

    // Håndtering af billede 1
    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetImagePath = $targetDir . $imageName;
        $imageType = pathinfo($targetImagePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'avif', 'webp');
        if (in_array($imageType, $allowTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImagePath)) {
                // Update database for Image 1
                $sql = "UPDATE pages SET title=?, text1=?, text2=?, image=?, showImage=?, showImage2=? WHERE page=?";
                $stmt = $mysqli->stmt_init();

                if (!$stmt->prepare($sql)) {
                    die("SQL error: " . $mysqli->error);
                }

                $stmt->bind_param(
                    "ssssiis",
                    $title,
                    $text1,
                    $text2,
                    $imageName,
                    $showImage,
                    $showImage2,
                    $page
                );

                if ($stmt->execute()) {
                    $statusMsg = "The editor content has been inserted successfully.";
                } else {
                    $statusMsg = "Some problem occurred, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        // Updater database uden at ændre billedet
        $sql = "UPDATE pages SET title=?, text1=?, text2=?, showImage=?, showImage2=? WHERE page=?";
        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param(
            "sssiis",
            $title,
            $text1,
            $text2,
            $showImage,
            $showImage2,
            $page
        );

        if ($stmt->execute()) {
            $statusMsg = "The editor content has been inserted successfully.";
        } else {
            $statusMsg = "Some problem occurred, please try again.";
        }
    }

    // behandler billede 2
    if (!empty($_FILES["image2"]["name"])) {
        $image2Name = basename($_FILES["image2"]["name"]);
        $targetImage2Path = $targetDir . $image2Name;
        $image2Type = pathinfo($targetImage2Path, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'avif', 'webp');
        if (in_array($image2Type, $allowTypes)) {
            if (move_uploaded_file($_FILES["image2"]["tmp_name"], $targetImage2Path)) {
                // Updater database for billede 2
                $sql = "UPDATE pages SET image2=? WHERE page=?";
                $stmt = $mysqli->stmt_init();

                if (!$stmt->prepare($sql)) {
                    die("SQL error: " . $mysqli->error);
                }

                $stmt->bind_param(
                    "ss",
                    $image2Name,
                    $page
                );

                if ($stmt->execute()) {
                    $statusMsg = "The second image has been inserted successfully.";
                } else {
                    $statusMsg = "Some problem occurred, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your second file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
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
                <h1>Rediger siden: Om Innovationsdagene</h1>
                <?php include('includes/second_nav.php') ?>
                <div id="main" class="content container mx-auto prose">
                    <?php if (!empty($statusMsg)) { ?>
                        <p class="stmsg"><?php echo $statusMsg; ?></p>
                    <?php } ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <label for="about">Skift overskrift</label><br>
                        <input type="text" id="title" name="title" value="<?php echo $title ?>">
                        <textarea name="page_editor1" id="page_editor"><?php echo $text1 ?></textarea>

                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">

                        <?php if ($imageName) { ?>
                            <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block prose" height="300px" />
                            <!-- Checkboksen til om billedet skal vises på siden eller ikke -->
                            <div class="showImage">
                                <p>Vis billede</p>
                                <label class="switch">
                                    <!-- hvis showimage er 1 så skal den vise checked -->
                                    <input type="checkbox" name="showImage" value="1" <?php if ($showImage) echo "checked"; ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        <?php } else { ?>
                            <p>Intet billede sat</p>
                        <?php } ?>

                        <textarea name="page_editor2" id="page_editor"><?php echo $text2 ?></textarea>

                        <label for="image2">Image 2</label>
                        <input type="file" name="image2" id="image2">

                        <?php if ($image2Name) { ?>
                            <img src="<?php echo $image2URL; ?>" alt="<?php echo $image2Name; ?>" class="block prose" height="300px" />
                            <!-- Checkboksen til om billedet skal vises på siden eller ikke -->
                            <div class="showImage">
                                <p>Vis billede</p>
                                <label class="switch">
                                    <!-- hvis showimage2 er 1 så skal den vise checked -->
                                    <input type="checkbox" name="showImage2" value="1" <?php if ($showImage2) echo "checked"; ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        <?php } else { ?>
                            <p>Intet billede sat</p>
                        <?php } ?>

                        <input type="submit" name="submit" value="GEM">
                    </form>
                </div>
            </div>
        </main>
    <?php else : ?>
        <main>
            <div class="container mx-auto flex">
                <p><a href="login.php">Log in</a></p>
            </div>
        </main>
    <?php endif; ?>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>