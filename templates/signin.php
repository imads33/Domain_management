<?php
include('_dbconnect.php');

$date = date("Y-m-d");

$showalert = false;
$showerror = false;

if (isset($_POST['signup'])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    $existssql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $existssql);
    $exists = mysqli_num_rows($result);
    if ($exists > 0) {
        $showerror = 'Email already exists';
    } else {
        if ($password1 === $password2) {

            // $passen = password_hash($password1, PASSWORD_BCRYPT);

            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `password`, `reg_date`) VALUES ('$username','$email','$password1','$date')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showalert = true;
            }
        } else {
            $showerror = 'passwords do not match';
        }
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

    <title>Sign up</title>
</head>

<body>
    <?php include('./navbar.php'); ?>

    <section class="section is-large" style="margin-top: -15%;">

        <div class=" container">
            <div class="columns mt-5 is-8 is-variable is-centered">
                <div class="column is-4-tablet is-mobile is-6-desktop">
                    <?php
                    if ($showalert) {
                        echo '
                        <div class="notification is-success">
                        <button class="delete"></button>
                        <strong> Success !</strong> " your account is created now you can login "
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
                    <h1 class="title is-1 is-spaced has-text-centered">Create Account</h1><br>
                    <form method="POST" action="">
                        <div class="register" id="tabs2">
                            <div class="field">
                                <label class="label">Username</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input name="username" class="input" type="text" placeholder="Username" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input name="email" class="input" type="email" placeholder="Email" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <p class="control has-icons-left">
                                    <input name="password1" class="input" type="password" placeholder="Password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">Confirm Password</label>
                                <p class="control has-icons-left">
                                    <input class="input" type="password" name="password2" placeholder="Confirm Password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                    <label class="has-text-right">
                                        <a href="./login.php" style="text-decoration: none;"> login --></a>
                                    </label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control mt-5">
                                    <input name="signup" class="button is-link mt-4 is-fullwidth" type="submit" value="Signup"></input>
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