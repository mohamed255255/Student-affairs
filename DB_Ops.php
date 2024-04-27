<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $fullname = $_POST["name"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];


    $check_query = "SELECT * FROM user WHERE email = ? OR username = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $email, $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "User with this email or username already exists.";
    } else {
        $insert_query = "INSERT INTO user (email, fullname, username, password, birthdate, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("sssssss", $email, $fullname, $username, $password, $birthdate, $phone, $address);

        if ($insert_stmt->execute()) {
            echo "User registered successfully.";
            // Redirect to home.php
            header("Location: http://127.0.0.1/web-project/home.php");
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
