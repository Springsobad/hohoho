<?php
include_once "./User.php";
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    User::destroy($id);
    $_SESSION['message'] = "Delete success";
    header(header: "location:./");
} else {
    $_SESSION['message'] = "User not found with id=" . $id;
    header(header: "location:./");
}
