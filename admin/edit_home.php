<?php
session_start();

$page = 'home';
$mysqli = require __DIR__ . "/../database/config.php";

if (isset($_SESSION["user_id"])) {
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}

$getPage = $mysqli->query("SELECT * FROM pages WHERE page = '" . $page . "'");
if ($getPage->num_rows > 0) {
    while ($page = $getPage->fetch_assoc()) {
        $title = $page['title'];
        $text1 = $page['text1'];
        $text2 = $page['text2'];
        $imageName = $page["image"];
        $imageURL = '/../images/' . $page["image"];
    }
}


$statusMsg = '';

if (isset($_POST['submit'])) {

    $page = 'home';
    $title = $_POST['title'];
    $text1 = $_POST['page_editor1'];
    $text2 = $_POST['page_editor2'];

    $targetDir = '/var/www/innovationsdage.dk/public_html/images/';

    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetImagePath = $targetDir . $imageName;
        $imageType = pathinfo($targetImagePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'avif', 'webp');
        if (in_array($imageType, $allowTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetImagePath)) {
                $sql = "UPDATE pages SET title=?, text1=?, text2=?, image=? WHERE page=?";
                $stmt = $mysqli->stmt_init();

                if (!$stmt->prepare($sql)) {
                    die("SQL error: " . $mysqli->error);
                }

                $stmt->bind_param(
                    "sssss",
                    $title,
                    $text1,
                    $text2,
                    $imageName,
                    $page
                );

                if ($stmt->execute()) {
                    $statusMsg = "The editor content has been inserted successfully.";
                } else {
                    $statusMsg = "Some problem occurred, please try again.";
                    // die($mysqli->error . " " . $mysqli->errno);
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $sql = "UPDATE pages SET title=?, text1=?, text2=? WHERE page=?";
        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param(
            "ssss",
            $title,
            $text1,
            $text2,
            $page
        );

        if ($stmt->execute()) {
            $statusMsg = "The editor content has been inserted successfully.";
        } else {
            $statusMsg = "Some problem occurred, please try again.";
            // die($mysqli->error . " " . $mysqli->errno);
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
    <link rel="stylesheet" href="./edit_page.css">
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/i2q56l2uu4wsqfm78zlcivot3qxhn06jbgpapqk5b0h1o3vd/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <?php if (isset($user)) : ?>
        <main>
            <div id="main" class="content container mx-auto">
                <h1>Rediger siden: Hjem</h1>
                <?php include('includes/second_nav.php') ?>
                <div id="main" class="content container mx-auto prose">
                    <?php if (!empty($statusMsg)) { ?>
                        <p class="stmsg"><?php echo $statusMsg; ?></p>
                    <?php } ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <label for="home">Skift overskrift</label><br>
                        <input type="text" id="title" name="title" value="<?php echo $title ?>">
                        <textarea name="page_editor1" id="page_editor"><?php echo $text1 ?></textarea>
                        <?php if ($imageName) { ?>
                            <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageName; ?>" class="block prose" height="300px" />
                        <?php } else { ?>
                            <p>Intet billede sat</p>
                        <?php } ?>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                        <textarea name="page_editor2" id="page_editor"><?php echo $text2 ?></textarea>
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