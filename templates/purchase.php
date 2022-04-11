<?php
session_start();
// $logout = false;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ./login.php");
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

    <title>Purchase</title>
</head>

<body>

    <?php

    include '_dbconnect.php';
    $showerror = false;
    $success = false;

    $start_date = date("Y-m-d");
    $end_date = date('Y-m-d', strtotime("+0 days +0 months +1 years"));

    $id = $_GET['planid'];
    $query = mysqli_query($conn, "SELECT * from `plans` WHERE plan_id='$id'");
    $row = mysqli_fetch_assoc($query);
    $planid = $row['plan_id'];
    $planname = $row['plan_title'];
    $amount = $row['ammount'];


    if (isset($_POST['submit'])) {

        $domain_name = $_POST['domainname'];
        $location = $_POST['location'];
        $user_email = $_POST['useremail'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['Gender'];

        $existssql = "SELECT * FROM `domain` WHERE domain_name ='$domain_name'";
        $result = mysqli_query($conn, $existssql);
        $exists = mysqli_num_rows($result);

        if ($exists > 0) {

            $showerror = 'domain name already exists';
        } else {

            if ($_SESSION['email'] == $user_email) {

                $result = mysqli_query($conn, "SELECT * FROM `users` WHERE user_email='$user_email'");
                $exist = mysqli_fetch_assoc($result);
                $userid = $exist['user_id'];

                //<---------------- inserting values into owner table ------------>
                $owner_sql = "INSERT INTO `owners` (`owner_name`, `owner_mail`, `phone`, `address`,`gender`,`user_id`) VALUES ('$fullname','$email','$phone','$address','$gender','$userid')";

                $result2 = mysqli_query($conn, $owner_sql);

                //<---------------- retrieving owner id ------------>
                $result1 = mysqli_query($conn, "SELECT * FROM `owners` WHERE user_id ='$userid'");
                $exist1 = mysqli_fetch_assoc($result1);

                $ownerid = $exist1['owner_id'];

                //<---------------- inserting values into Server table  ------------>
                $sql1 = "INSERT INTO `server` (`server_loc`, `start_date`, `end_date`, `own_id`) VALUES ('$location','$start_date','$end_date','$ownerid')";
                $result3 = mysqli_query($conn, $sql1);

                //<---------------- retrieving server id ------------>
                $result3 = mysqli_query($conn, "SELECT * FROM `server` WHERE own_id ='$ownerid'");
                $exist2 = mysqli_fetch_assoc($result3);

                $serverid = $exist2['server_id'];

                //<---------------- inserting values into Domain table  ------------>
                $sql2 = "INSERT INTO `domain` (`domain_name`, `reg_date`, `own_id`, `plan_id`,`server_id`) VALUES ('$domain_name','$start_date','$ownerid','$planid','$serverid')";
                $result4 = mysqli_query($conn, $sql2);

                $success = true;
                header("refresh:5;url=contactus.php");
            } else {
                $showerror = ' Wrong user Email';
                // header("refresh:5;url=purchase.php");
            }
        }
    }
    ?>


    <section class="section">
        <div class=" container ">
            <?php if ($showerror) {
                echo '
                    <div class="notification is-danger is-light">
                    <button class="delete"></button>
                    <strong>Error ! </strong> ' . $showerror . '
                    </div>';
            } ?>
            <?php if ($success == true) {
                echo '
                    <div class="notification is-success is-light">
                    <button class="delete"></button>
                    <strong>Woo Hoo ! </strong>your purchase is successfull..
                    </div>';
            } ?>
            <form method="POST" action="">
                <div class="columns mt-3 is-8 is-variable is-centered ">
                    <div class="column is-4-tablet is-mobile is-6-desktop">
                        <h1 class="title is-1 is-spaced has-text-centered">Domain Information</h1><br>
                        <div class="register">

                            <div class="field">
                                <label class="label">Domain name</label>
                                <div class="control">
                                    <input name="domainname" class="input" type="text" placeholder="ex : xyz.com" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Plan</label>
                                <div class="control">
                                    <input name="planname" class="input" type="text" disabled value="<?php echo $planname; ?>" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Amount</label>
                                <div class="control">
                                    <input name="planamount" class="input" type="text" disabled value="<?php echo $amount; ?>" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Server Location</label>
                                <div class="select is-normal is-fullwidth">
                                    <select name="location">
                                        <option disabled>
                                            Select nearest
                                        </option>
                                        <option value="AUSTRALIA">AUSTRALIA</option>
                                        <option value="BRAZIL">BRAZIL</option>
                                        <option value="FRANCE">FRANCE</option>
                                        <option value="ITALY">ITALY</option>
                                        <option value="INDIA">INDIA</option>
                                        <option value="LONDON">LONDON</option>
                                        <option value="PARIS">PARIS</option>
                                        <option value="ROME">ROME</option>
                                        <option value="USA">USA</option>
                                        <option value="UAE">UAE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">User Email</label>
                                <div class="control">
                                    <input name="useremail" class="input" type="email" placeholder="login Email" required>
                                </div>
                            </div>
                            <div class="field" required>
                                <label class="checkbox">
                                    <input type="checkbox" required>
                                    I agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="column is-4-tablet is-mobile is-6-desktop ">
                        <h1 class="title is-1 is-spaced has-text-centered">Personal Information</h1><br>
                        <div class="register">
                            <div class="field">
                                <label class="label">Full Name</label>
                                <div class="control">
                                    <input name="fullname" class="input" type="text" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control">
                                    <input name="email" class="input" type="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Phone</label>
                                <p class="control">
                                    <input name="phone" class="input" type="number" placeholder="123-456-7890" required>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">Address</label>
                                <textarea class="textarea" name="address" placeholder="e.g. 123 Main Street, New York, NY 10030" required></textarea>
                            </div>
                            <div class="field">
                                <label class="label">Gender</label>
                                <div class="control">
                                    <label class="radio is-normal">
                                        <input type="radio" name="Gender" value="Male">
                                        Male
                                    </label>
                                    <label class="radio is-normal">
                                        <input type="radio" name="Gender" value="Female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="control mt-5">
                        <button name="submit" class="button is-success mt-4 is-fullwidth  is-medium is-outlined has-text-dark" type="submit" value="Proceed">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>