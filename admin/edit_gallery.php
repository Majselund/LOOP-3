<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../database/config.php";
    $result = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $result->fetch_assoc();
}

$targetDir = '/var/www/innovationsdage.dk/public_html/images/gallery/';
$thumbnailDir = '/var/www/innovationsdage.dk/public_html/images/thumbnails/';
$statusMsg = '';

if (isset($_POST['submit'])) {

    if (!empty($_FILES["image"]["name"]) && is_array($_FILES["image"]["name"])) {
        $imageNames = $_FILES["image"]["name"];
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        $uploadStatus = [];

        foreach ($imageNames as $key => $imageName) {
            // Check if the file type is allowed
            $imageType = pathinfo($imageName, PATHINFO_EXTENSION);
            if (in_array($imageType, $allowTypes)) {
                $targetImagePath = $targetDir . $imageName;

                // Attempt to move the uploaded file
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetImagePath)) {
                    // Insert the image into the database
                    $sql = "INSERT INTO gallery (image) VALUES (?)";
                    $stmt = $mysqli->stmt_init();

                    if (!$stmt->prepare($sql)) {
                        $uploadStatus[] = "SQL error for $imageName: " . $mysqli->error;
                    } else {
                        $stmt->bind_param("s", $imageName);
                        if ($stmt->execute()) {
                            $uploadStatus[] = "File $imageName uploaded successfully.";

                            // Generate and save thumbnail
                            $thumbnailPath = $thumbnailDir . 'thumb_' . $imageName;
                            list($width, $height) = getimagesize($targetImagePath);

                            // Determine thumbnail dimensions based on aspect ratio
                            $thumbWidth = 750;
                            $thumbHeight = floor($height * ($thumbWidth / $width));

                            $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
                            $source = imagecreatefromjpeg($targetImagePath);
                            imagecopyresized($thumb, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                            imagejpeg($thumb, $thumbnailPath);

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
    <link rel="stylesheet" href="./edit_page.css">
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/i2q56l2uu4wsqfm78zlcivot3qxhn06jbgpapqk5b0h1o3vd/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
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