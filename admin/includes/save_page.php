<?php
// Include the database configuration file
$mysqli = require __DIR__ . "/../../database/config.php";

$editorContent = $statusMsg = '';

// If the form is submitted
if (isset($_POST['submit'])) {
    // Get editor content
    $editorContent = $_POST['page_editor'];

    // Check whether the editor content is empty
    if (!empty($editorContent)) {
        // Insert editor content in the database
        $insert = $mysqli->query("INSERT INTO pages (page, title, text, image) VALUES (?, '" . $editorContent . "', ?, ?);

        // If database insertion is successful
        if ($insert) {
            $statusMsg = "The editor content has been inserted successfully.";
        } else {
            $statusMsg = "Some problem occurred, please try again.";
        }
    } else {
        $statusMsg = 'Please add content in the editor.';
    }
}
