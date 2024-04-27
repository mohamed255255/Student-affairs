<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/index.css">
    <script src="https://kit.fontawesome.com/8b6dba93f9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
    $(document).ready(function() {
        $('#fetchActorsButton').click(function(event) {
            event.preventDefault();

            var birthdate = $('[name="birthdate"]').val();

            $.ajax({
                type: 'POST',
                url: 'API_Ops.php',
                data: {birthdate: birthdate},
                success: function(response) {
                    $('.actor-items').html(response);
                    $('.actor-items').css('display', 'flex');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('.actor-items').html('<p>Error occurred. Please try again later.</p>');
                }
            });
        });


        var box = document.getElementById('response_container');
        var button = document.getElementById('fetchActorsButton');
        function displayContainer() {
            box.classList.toggle('show');
        }
        button.addEventListener('click', displayContainer);
    });

</script>


</head>
<body>


<div class="validaion">
    <?php
    function validpassword()
    {
        $pass=$_POST['password'];
        $confirmpass=$_POST['confirm_password'];

        if (strlen($pass) > 0) {
            if (strlen($pass) > 0 && strlen($pass) < 8) {
                return "the password is too short";
            } else if ($pass != $confirmpass) {
                return "the passwords not matched";
            }
            $patternspecial = "/[$!^(){}?\[\]<>~%@#&*+=_-]{1,}/i";
            $patternchar = "/[a-z]{1,}/i";
            $patternnums = "/\d{1,}/";
            if (!preg_match($patternspecial, $pass)) {
                return "The password must <br> contains at least 1 special character";
            } else if (!preg_match($patternchar, $pass)) {
                return "The password must <br> contains at least 1 characters";
            } else if (!preg_match($patternnums, $pass)) {
                return "The password must <br> contains at least 1 number";
            }
        }
    }
    ?>
</div>

<?php include 'header.php'; ?>
<?php include 'footer.php'; ?>

<div class="main">
    <form action="DB_Ops.php" id="myForm" method="post">
        <div class="form_container">
            <section class="half_form">
                <span>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required><br>
                </span>
                <span>
                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                    <div class="hover-container"><button type="button" id="fetchActorsButton"><i class="fa-solid fa-circle-user"></i></button>
                        <div class="tip-box">Discover shared celebrity birthdays!</div>
                    </div><br>
                </span>
                <span>
                    <label for="phone">Phone</label>
                     <input type="tel" id="phone" name="phone" placeholder="123-454-678-47" pattern="[0-9]{3}(-?)[0-9]{3}(-?)[0-9]{3}(-?)[0-9]{2}" required><br>
                </span>
                <span>
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required ><br>
                </span>
            </section>
            <section class="half_form">
                <span>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required><br>
                </span>
                <span>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required><br>
                </span>
                <span>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required><br>
                </span>
                <span>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br>
                    <h5 style="color: #37ff00">
                        <?php
                            if(isset($_POST['submit'])){
                                echo validpassword();
                            }
                        ?>
                    </h5>
                </span>
            </section>
        </div>

        <div class="button">
            <input type = "submit" name = "submit" value = "Submit">
        </div>
    </form>
    <div class="actor-list" id="response_container">


        <ul class="actor-items">
           <li><div class="loadingio-spinner-spinner-2by998twmg8"><div class="ldio-yzaezf3dcmj">
</div></div></li>
        </ul>
    </div>
</div>

</body>
</html>

