<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        <?php include 'CSS/header.css'; ?>
        <?php include 'CSS/home.css'; ?>
    </style>
</head>
<body>

<?php include 'upload.php';?>

<nav>
    <div class="logo"><i class="fab fa-algolia" style="margin-right: 5px;"></i>FCI</div>
    <ul class="ul_nav">
        <li class="li_nav" id="current_tab"><i class="fas fa-home"></i>Home</li>
        <li class="li_nav"><i class="fas fa-address-card"></i>About us</li>
        <li class="li_nav"><i class="fas fa-user"></i>Account</li>
        <li class="li_nav">
            <div class="frame">
                <label for="input-file">
                    <img src="blankpfp.jpeg" id="profilePicture" alt="Profile Picture Icon">
                </label>
                <input type="file" accept="image/jpeg, image/png, img/jpeg" id="input-file" style="display: none;">
            </div>
        </li>
    </ul>
</nav>

<footer>
    <p>Your Website. All rights reserved.</p>
</footer>

<script src="./JS/upload.js"></script>

</body>
</html>
