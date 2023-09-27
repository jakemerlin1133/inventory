<?php
session_start();
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['auth']);
unset($_SESSION['shopping_cart']);
unset($_SESSION['total_quantity']);
header("Location: index.php");
?>