<?php
include('_dbconnect.php');
$login = false;
$showerror = false;
if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $existSql = "SELECT * FROM `users` WHERE user_email='$email' AND password='$password'";
    $result = mysqli_query($conn, $existSql);
    $exists = mysqli_num_rows($result);

    if ($exists == 1) {
        if (($email == 'vhost.admin@gmail.com') && ($password == 'vhost321')) {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location: _page_admin.php");
        } else {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location: plans.php");
        }
    } else {
        $showerror = "Invalid Credentials";
    }
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

    <title>login</title>
</head>

<body>

    <?php include('./navbar.php'); ?>


    <section class="section is-large" style="margin-top: -8%;">

        <div class="container ">
            <div class="columns mt-5 is-8 is-variable is-centered ">
                <div class="column is-4-tablet is-mobile is-6-desktop">
                    <?php
                    if ($login) {
                        echo '
                        <div class="notification is-success">
                        <button class="delete"></button>
                        <strong> Success !!</strong> " your now loggedin"
                        </div>';
                    }
                    if ($showerror) {
                        echo '
                        <div class="notification is-danger is-light">
                        <button class="delete"></button>
                        <strong>Error ! </strong> ' . $showerror . '
                        </div>';
                    }
                    ?>
                    <h1 class="title is-1 is-spaced has-text-centered">Login Here</h1><br>
                    <form action="" method="POST">
                        <div class="login" id="tabs1">
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input name="email" class="input grey-darker" type="email" placeholder="Email" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <p class="control has-icons-left">
                                    <input name="password" class="input" type="password" placeholder="Password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="checkbox">
                                    <a href="#">
                                        Forgot password ?
                                    </a>
                                </label>
                            </div>
                            <div class="field">
                                <div class="control mt-5">
                                    <input name="login" class="button is-success is-fullwidth" type="submit" value="Login"></input>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <?php include('./footer.php'); ?>
    <script>
        $(document).on('click', '.notification > button.delete', function() {
            $(this).parent().addClass('is-hidden');
            return false;
        });
    </script>
</body>

</html>