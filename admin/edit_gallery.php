<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../database/config.php";
    $result = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $result->fetch_assoc();
}

$targetDir = '/var/www/innovationsdage.dk/public_html/images/gallery/';
$statusMsg = '';

if (isset($_POST['submit'])) {

    if (!empty($_FILES["image"]["name"]) && is_array($_FILES["image"]["name"])) {
        $imageNames = $_FILES["image"]["name"];
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'avif', 'webp');
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
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/i2q56l2uu4wsqfm78zlcivot3qxhn06jbgpapqk5b0h1o3vd/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>Rediger Galleri</h1>
            <div id="main" class="content container mx-auto prose">
                <form method="post" action="" enctype="multipart/form-data">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" multiple>
                    <input type="submit" name="submit" value="GEM">
                </form>
            </div>
    </main>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>