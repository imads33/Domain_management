<?php
include('_dbconnect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deletesql = "DELETE FROM `users` WHERE user_id='$id'";
    $result = mysqli_query($conn, $deletesql);
    if ($result) {
        header('location:./_page_admin.php');
    } else {
        die(mysqli_error($conn));
    }
}
