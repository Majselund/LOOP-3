<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="gallery.css">
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
                    echo "<figure>";
                    echo "<button id='imageButton" . $i . "'><img src='" . $imageURL . "' alt='Open' width='750'></button>";
                    echo "</figure>";
                    echo "<div id='imageModal" . $i . "' class='modal'>";
                    echo "<div id='modalContent" . $i . "' class='modal-content'><img id='bigImage" . $i . "' class='modal-image' src='" . $imageURL . "' alt='' width='1400'></div>";
                    echo "</div>";
                }
            }
            ?>
            <!-- The following element will be created for each image with JavaScript -->
            <!-- Creating figure component -->
            <!-- <figure>
                <button id="imageButton0">
                    <img src="../../images/IMG_0002.png" alt="Open" width="570">
                </button>
            </figure> -->
            <!-- Creating modal component -->
            <!-- <div id="imageModal0" class="modal">
                <div class="modal-content">
                    <img class="modal-image" src="../../images/IMG_0002.png" alt="" width="1400">
                </div>
            </div>  -->
        </div>
    </main>
    <?php include('../../includes/footer.php') ?>
</body>

</html>