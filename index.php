<?php
session_start();
$logout = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    $logout = true;
}
include './templates/_dbconnect.php';

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>VHost</title>

</head>

<body>

    <!-- navbar -->
    <nav class="navbar has-shadow is-white is-fixed-top">
        <div class="navbar-brand py-4 px-2" style="margin-left: 40px;max-height : 60px">
            <a class="navbar-brand">
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
                <a href="#" class="navbar-item">
                    &nbsp; Home</a>

                <a href="./templates/about.php" class="navbar-item">
                    &nbsp; About</a>

                <a href="./templates/contactus.php" class="navbar-item">
                    &nbsp; Contact us</a>
                <a href="./templates/plans.php" class="navbar-item">
                    &nbsp; Plans </a>

            </div>
            <?php
            if ($logout) {
                echo '<div class="navbar-end" style="margin-right: 90px;">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-item">
                        SignUp
                    </a>

                    <div class="navbar-dropdown">
                        <a href="./templates/signin.php" class="navbar-item">
                            Create Account
                        </a>
                        <hr class="navbar-divider" value="or">
                        <a href="./templates/login.php" class="navbar-item">
                            Login
                        </a>
                    </div>
                </div>
            </div>';
            } else {
                echo '<div class="navbar-end " style="margin-right: 5px;">
                <a href="./templates/logout.php" class="navbar-item">
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
    <!-- NAVBAR ENDS HERE is-info style="background-color:hsl(204, 86%, 53%)" -->

    <section class="hero is-info is-fullheight" style="margin-top: 2%;">
        <div class="hero-head">
            <div class="container has-text-centered">
                <div class="column is-6 is-offset-3">
                    <h1 class="title is-spaced" style="margin-top:10%;">
                        VHost
                    </h1>
                    <h2 class="subtitle">
                        this is the best software platform for running an internet business
                    </h2>
                </div>
            </div>
        </div>

        <div class="hero-body" style="margin-top: -5%;">
            <div class="container has-text-centered">
                <div class="column is-6 is-offset-3">
                    <h2 class="subtitle">
                        search for your favorite domain,to check its Available / Not
                    </h2>
                    <div class="box">
                        <form action="" method="POST">
                            <div class="field has-addons">
                                <div class="control is-expanded">
                                    <input class="input" name="search" type="search" placeholder="search domain">
                                </div>
                                <div class="control">
                                    <button type="submit" class="button is-info" name="submit" value="search">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_POST['submit'])) {

                    $search = $_POST['search'];

                    $existssql = "SELECT * FROM `domain` WHERE domain_name ='$search'";
                    $result = mysqli_query($conn, $existssql);
                    $exists = mysqli_num_rows($result);

                    if ($exists > 0) {

                        $query = "SELECT d.domain_name,d.reg_date,o.owner_name,o.gender,s.server_loc  FROM domain d,owners o,server s WHERE d.own_id=o.owner_id AND d.server_id=s.server_id AND domain_name='$search'";

                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                            echo "
                            <div class='container has-text-centered'>
                                <div class='column is-3 is-offset-4'>
                                    <div class='card'>
                                        <div class='card-content'>
                                            <div class='content'>
                                               <strong> <p> " . $search . "</strong> is not available </p> 
                                            </div>
                                            <strong>Owner :</strong> " . $row['owner_name'] . "<br>
                                            <strong>Gender :</strong> " . $row['gender'] . "<br>
                                            <strong>server loc :</strong> " . $row['server_loc'] . "<br>
                                            <strong>Reg. date :</strong> " . $row['reg_date'] . "<br>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "
                            <div class='container has-text-centered'>
                                <div class='column is-3 is-offset-4'>
                                    <div class='card'>
                                        <div class='card-content'>
                                            <div class='content'>
                                               <strong> <p> " . $search . "</p></strong> is now available  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> ";
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- java script -->
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