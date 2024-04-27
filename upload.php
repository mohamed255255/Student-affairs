<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the image data URL was sent
    if(isset($_POST["image_data_url"])) {
        $dataUrl = $_POST["image_data_url"];

        // Database credentials
        $dbHost = 'localhost';
        $dbName = 'assignment';
        $dbUser = 'root';
        $dbPass = '';

        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert data URL into the 'user' table
            $stmt = $pdo->prepare("INSERT INTO user (img) VALUES (:img)");
            $stmt->bindParam(':img', $dataUrl, PDO::PARAM_STR);
            $stmt->execute();

            echo "Image inserted into the 'user' table successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error uploading image.";
    }
}
?>
