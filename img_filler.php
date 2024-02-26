<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image = $_FILES["image"];

    // Check if file is uploaded successfully
    if ($image["error"] === UPLOAD_ERR_OK) {
        // Read file contents
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
    // Get file type
        $fileType = $_FILES["image"]["type"];

        // Establish database connection
        

        $conn = new mysqli('localhost', 'root', '', 'collab_hub');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO tbl_image (imageData, imageType) VALUES (?, ?)");
        $stmt->bind_param("ss", $imageData, $fileType);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file uploaded.";
}
?>
