<?php
include('_dbconnect.php');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['email'] !== 'vhost.admin@gmail.com') {
    header("location: ./pagenotfound.php");
    exit;
}
?>

<!-- ADDING USERS  -->
<?php
include('_dbconnect.php');
$date = date("Y-m-d");
$showalert = false;
$showerror = false;

if (isset($_POST['signup'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $existssql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $existssql);
    $exists = mysqli_num_rows($result);
    if ($exists > 0) {
        $showerror = 'Email already exists';
    } else {
        $sql = "INSERT INTO `users` (`user_name`, `user_email`, `password`, `reg_date`) VALUES ('$username','$email','$password','$date')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showalert = 'user aded';
            header("refresh:5;url=./_page_admin.php");
        }
    }
}
// <!-- END OF ADDING USERS -->

// <!-- UPDATING USER DETAILS -->
if (isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $username = $_POST['editName'];
    $usermail = $_POST['editMail'];
    $userpass = $_POST['editPass'];

    $existssql = "UPDATE `users` SET `user_name` = '$username', `user_email` = '$usermail', `password` = '$userpass', `reg_date` = '$date' WHERE `users`.`user_id` = $sno";
    $result = mysqli_query($conn, $existssql);
    if ($result) {
        header('location:./_page_admin.php');
        $showalert = 'details are updated';
    }
}
// <!-- UPDATING USER DETAILS END -->

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pageadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <title>Link Hover | Coderider</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <ul class="nav justify-content-center">
            </ul>
            <form class="d-flex">
                <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="./logout.php" class="navbar-item"><button type="button" class="btn btn-danger">Logout</button></a>
        </div>
    </nav>
    <nav class="sidebar">
        <a href="#users">users &nbsp;<i class="far fa-user"></i></a>
        <a href="#owners">owners &nbsp;<i class="far fa-address-card"></i></a>
        <a href="#domain">domain &nbsp;<i class="fas fa-globe"></i></a>
        <a href="#plans">plans &nbsp;<i class="far fa-file"></i></a>
        <a href="#trigger">Trigger&nbsp;<i class="far fa-file"></i></a>
        <a href="#view">View&nbsp;<i class="far fa-file"></i></a>
        <a href="#stored">StoredProc&nbsp;<i class="far fa-file"></i></a>
    </nav>





    <!-- USERS DETAILS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='users'>
            <?php
            if ($showalert) {
                echo '
                    <div class="notification is-success">
                        <button class="delete"></button>
                        <strong> Success !</strong>
                    </div>';
            } ?>
            <?php
            if ($showerror) {
                echo '
                    <div class="notification is-danger is-light">
                        <button class="delete"></button>
                        <strong>Error ! </strong> ' . $showerror . '
                    </div>';
            }
            ?>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>Users Information</b>
                        <div class="d-grid col-2 mx-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add user </button>
                        </div>
                    </h1>
                    <hr>
                    <!-- <div class="container is-max-widescreen is-centered"> -->
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Registered Date</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = "SELECT * FROM `users` ";
                            $result = mysqli_query($conn, $users);
                            $number = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['user_id'];
                                    echo "
                                <tr>
                                    <td>" . $number . "</td>
                                    <td>" . $row['user_name'] . "</td>
                                    <td>" . $row['user_email'] . "</td>
                                    <td>" . $row['password'] . "</td>
                                    <td>" . $row['reg_date'] . "</td>
                                    <td>
                                        <button class='edit btn btn-warning' id=" . $row['user_id'] . ">Edit</button>
                                        &nbsp;
                                        <button type='button' class='btn btn-danger'><a href='./_delete.php?id=" . $row['user_id'] . "' style='text-decoration:none;' class='text-dark'>Delete</a></button>
                                    </td>
                                </tr>  ";
                                    $number++;
                                }
                            } else {
                                echo "records  not found";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </section>
    </div>
    <!-- USERS DETAILS ENDS HERE-->




    <!-- OWNERS DETAILS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='owners'>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>Owners Information</b>
                    </h1>
                    <hr>
                    <!-- <div class="container is-max-widescreen is-centered"> -->
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $owners = "SELECT * FROM `owners` ";
                            $result = mysqli_query($conn, $owners);
                            $number = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['owner_id'];
                                    echo "
                                <tr>
                                    <td>" . $number . "</td>
                                    <td>" . $row['owner_name'] . "</td>
                                    <td>" . $row['owner_mail'] . "</td>
                                    <td>" . $row['phone'] . "</td>
                                    <td>" . $row['address'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                </tr>  ";
                                    $number++;
                                }
                            } else {
                                echo "records  not found";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </section>
    </div>
    <!-- OWNERS DETAILS ENDS HERE-->




    <!-- DOMAIN DETAIS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='domain'>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>Domain Details</b></h1>
                    <hr>
                    <!-- <div class="container is-max-widescreen is-centered"> -->
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">Domain name</th>
                                <th scope="col">Owner name</th>
                                <th scope="col">server</th>
                                <th scope="col">Registered on</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include '_dbconnect.php';

                            $query = "SELECT d.domain_name,d.reg_date,o.owner_name,s.server_loc  FROM domain d,owners o,server s WHERE d.own_id=o.owner_id AND d.server_id=s.server_id";

                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "
                                <tr>
                                    <td>" . $row['domain_name'] . "</td>
                                    <td>" . $row['owner_name'] . "</td>
                                    <td>" . $row['server_loc'] . "</td>
                                    <td>" . $row['reg_date'] . "</td>
                                </tr>";
                                }
                            }
                            ?>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </section>
    </div>
    <!-- DOMAIN DETAILS ENDS HERE-->





    <!-- PLANS DETAILS START -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='plans'>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>Domain Plans</b></h1>
                    <hr>
                    <!-- <div class="container is-max-widescreen is-centered"> -->
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">Plan ID</th>
                                <th scope="col">Plan Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include '_dbconnect.php';

                            $query = "SELECT * from plans";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "
                                <tr>
                                    <td>" . $row['plan_id'] . "</td>
                                    <td>" . $row['plan_title'] . "</td>
                                    <td>" . $row['ammount'] . "</td>
                                    <td>
                                        <div class='card' style='width: 50%;'>
                                            <div class='card-content'>
                                                <div class='content'>
                                                    <ul>
                                                       <li> " . $row['description'] . "</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
                                }
                            }
                            ?>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </section>
    </div>
    <!-- PLANS DETAILS END -->






    <!-- TRIGGER  STRATS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='trigger'>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>Deleted users</b>
                    </h1>
                    <hr>
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">User Id</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = "SELECT * FROM `deleted_users` ";
                            $result = mysqli_query($conn, $users);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                <tr>
                                    <td>" . $row['user_id'] . "</td>
                                    <td>" . $row['user_name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['password'] . "</td>
                                </tr>  ";
                                }
                            } else {
                                echo "records  not found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b>updated users</b>
                    </h1>
                    <hr>
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">User Id</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = "SELECT * FROM `updated_users` ";
                            $result = mysqli_query($conn, $users);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                <tr>
                                    <td>" . $row['user_id'] . "</td>
                                    <td>" . $row['user_name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['password'] . "</td>
                                </tr>  ";
                                }
                            } else {
                                echo "records  not found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- TRIGGER ENDS HERE -->








    <!-- VIEW STRATS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='view'>
            <div class="container-fluid">
                <div class="card card-body">
                    <h1><b> VIEW ON DOMAIN INFORMATION</b>
                    </h1>
                    <hr>
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">sl.NO</th>
                                <th scope="col">Domain name</th>
                                <th scope="col">Plan and Amount</th>
                                <th scope="col">server</th>
                                <th scope="col">Registered on</th>
                                <th scope="col">Started on</th>
                                <th scope="col">Ends on</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $slno = 1;
                            $view = "SELECT * FROM `domain_info`";
                            $result = mysqli_query($conn, $view);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                <tr>
                                    <td>" . $slno . "</td>
                                    <td>" . $row['domain_name'] . "</td>
                                    <td>" . $row['plan_title'] . "--" . $row['ammount'] . "</td>
                                    <td>" . $row['server_loc'] . "</td>
                                    <td>" . $row['reg_date'] . "</td>
                                    <td>" . $row['start_date'] . "</td>
                                    <td>" . $row['end_date'] . "</td>
                                </tr>  ";
                                    $slno++;
                                }
                            } else {
                                echo "records  not found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- VIEW ENDS HERE -->





    <!-- STORED PROCEDURE STRATS -->
    <div class="container is-centered" style="margin-top: 15vh;">
        <section id='stored'>
            <div class="container-fluid">
                <div class="container" style="margin-top: 10vh;">
                    <div class="row align-items-start">
                        <div class="d-grid gap-2 col-4 mx-auto">
                            <form class="d-flex" action="" method="POST">
                                <input class="form-control me-3" name="search" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" name="submit" value="search" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <table class="table table-hover">
                        <thead class="table">
                            <tr>
                                <th scope="col">sl.No</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['submit'])) {
                                $search = $_POST['search'];
                                $slno = 1;

                                $existssql = "SELECT * FROM `plans` WHERE plan_id ='$search'";
                                $result = mysqli_query($conn, $existssql);
                                $exists = mysqli_fetch_array($result);

                                if ($exists) {
                                    $sql = "CALL `getMembers`($search)";
                                    $result1 = mysqli_query($conn, $sql);
                                    // $row = mysqli_fetch_assoc($result);
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row = mysqli_fetch_array($result1)) {
                                            echo "
                                            <tr>
                                                <td>" . $slno . "</td>
                                                <td>" . $row['plan_title'] . "</td>
                                                <td>" . $row['ammount'] . "</td>
                                                <td>" . $row['owner_name'] . "</td>
                                                <td>" . $row['owner_mail'] . "</td>
                                                <td>" . $row['phone'] . "</td>
                                                <td>" . $row['address'] . "</td>
                                            </tr>";
                                            $slno++;
                                        }
                                    }
                                } else {
                                    echo "
                                        <tr>
                                        <strong><b>Search unsuccessfull :(</b></strong>
                                        </tr>";
                                }
                            }
                            ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- STORED PROCEDURE ENDS HERE -->








    <!-- Add user MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new user here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
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
                                <input name="password" class="input" type="password" placeholder="Password" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="modal-footer d-block">
                            <button type="reset" class="btn btn-danger float-end">Clear</button>
                            <button type="submit" name="signup" class="btn btn-success float-end"> + Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- add user end MODAL  -->


    <!-- UPDATING USER MODAL-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./_page_admin.php">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="editName" id="editName" class="input" type="text" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left has-icons-right">
                                <input name="editMail" id="editMail" class="input" type="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <p class="control has-icons-left">
                                <input name="editPass" id="editPass" class="input" type="" placeholder="Password" required>
                            </p>
                        </div>
                        <div class="modal-footer d-block">
                            <button type="submit" name="update" class="btn btn-success float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- UPDATING USER ENDS HERE -->


    <script>
        //edit user details
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[1].innerText;
                email = tr.getElementsByTagName("td")[2].innerText;
                password = tr.getElementsByTagName("td")[3].innerText;
                console.log(name, email);
                editName.value = name;
                editMail.value = email;
                editPass.value = password;
                snoEdit.value = e.target.id;
                console.log(e.target.id);

                var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                    keyboard: false
                })
                myModal.toggle();
            })
        })

        $(document).on('click', '.notification > button.delete', function() {
            $(this).parent().addClass('is-hidden');
            return false;
        });
    </script>
</body>

</html>