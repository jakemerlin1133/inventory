<?php
$con = mysqli_connect("localhost", "root", "", "uddesign_inventory");

if (isset($_POST['approve'])) {

    $id = $_GET['ID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $activation = $_POST['approve'];

    $activation = "SELECT `activation` FROM `user` WHERE username = '$username' AND first_name = '$firstname' AND lastname = '$lastname'";
    $activation_query = mysqli_query($con, $activation);
    $activation_row = mysqli_fetch_assoc($activation_query);
    $active = $activation_row['activation'];

    if ($active == "active") {
        $deactive = "deactive";
        $activation_account = "UPDATE `user` SET `activation`='$deactive' WHERE username = '$username' AND first_name = '$firstname' AND lastname = '$lastname'";
        $activation_account_query = mysqli_query($con, $activation_account);
        header("Location: account-list.php");
    } else {
        $actives = "active";
        $activation_account = "UPDATE `user` SET `activation`='$actives' WHERE username = '$username' AND first_name = '$firstname' AND lastname = '$lastname'";
        $activation_account_query = mysqli_query($con, $activation_account);
        header("Location: account-list.php");
    }
}
?>
