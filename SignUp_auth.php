<?php 
    include("connect.php");

    if (isset($_FILES["uimg"])) {
        $image = $_FILES["uimg"];
    
        // Check if file is uploaded successfully
        if ($image["error"] === UPLOAD_ERR_OK) {
            // Read file contents
            $imageData = file_get_contents($image["tmp_name"]);
    
            // Prepare and bind the INSERT statement
            $stmt = $con->prepare("INSERT INTO tbl_image (imageData) VALUES (?)");
            $stmt->bind_param("s", $imageData);
    
            // Execute the statement
            if ($stmt->execute()) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
    
            // Close statement and database connection
            $stmt->close();
            $con->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded.";
    }
    
?>