<?php
include '_dbconnect.php';
session_start();

$logout = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    $logout = true;
}

if (isset($_SESSION['loggedin'])) {
    $email = $_SESSION['email'];
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE user_email='$email'");
    $exist = mysqli_fetch_assoc($result);
    $userid = $exist['user_id'];
    $username = $exist['user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title></title>
</head>

<body>
    <nav class="navbar has-shadow is-white is-fixed-top">
        <div class="navbar-brand py-4 px-2" style="margin-left: 40px;max-height : 60px">
            <a href="../index.php" class="navbar-brand">
                <span class="icon is-brand" alt="brand">
                    <i class="fas fa-globe fa-3x"></i>
                </span> &nbsp; &nbsp; &nbsp; VHost
            </a>
            <a class="navbar-burger is-black" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

        <div class="navbar-menu" id=nav-links>
            <div class="navbar-start" style="margin-left: 50%;">
                <a href="../index.php" class="navbar-item">
                    Home</a>

                <a href="../templates/about.php" class="navbar-item">
                    About</a>

                <a href="./contactus.php" class="navbar-item">
                    Contact us</a>
                <a href="./plans.php" class="navbar-item">
                    Plans </a>

            </div>
            <?php
            if ($logout) {
                echo '<div class="navbar-end" style="margin-right: 90px;">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-item">
                        SignUp
                    </a>

                    <div class="navbar-dropdown">
                        <a href="./signin.php" class="navbar-item">
                            Create Account
                        </a>
                        <hr class="navbar-divider" value="or">
                        <a href="./login.php" class="navbar-item">
                            Login
                        </a>
                    </div>
                </div>
            </div>';
            } else {
                echo '
                <div class="navbar-end " style="margin-right: 5px;">
                    <a href="./logout.php" class="navbar-item">
                   Logout</a>
                </div>
                <div class="navbar-end " style="margin-right: 20px;margin-top: 10px;">
                    <a href="./userprofile.php" style="text-decoration:none;">
                        <span class="icon is-medium is-left">
                            <i class="fas fa-user fa-2x"></i> 
                        </span>Hello, ' . $username . '
                    </a>
                </div>';
            }
            ?>
        </div>
    </nav>

    <script>
        //mobile menu
        const burgerIcon = document.querySelector('#burger');
        const navbarMenu = document.querySelector('#nav-links');

        burgerIcon.addEventListener('click', () => {
            navbarMenu.classList.toggle('is-active');
        });
        //end
    </script>

</body>

</html>