<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="gallery.css">
    <script defer src="../../javascript/modal.js"></script>
</head>

<body>
    <?php include('../../includes/navigation.php') ?>
    <main>
        <div class="content " container mx-auto">
            <h1>Galleri</h1>
        </div>
        <div id="masonry" class="masonry">
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