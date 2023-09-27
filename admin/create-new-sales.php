<?php
session_start();
include('../function.php');
include('../sidebar/admin-sidebar.php');
if (!isset($_SESSION['auth'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/445aa1d2b6.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="../script.js"></script>

    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300">
    <div class="text-center pt-8">
        <img class="mx-auto rounded-full" src="../img/udd-design.jpg" width="200" height="200">
        <h1 class="text-cyan-50 text-7xl mt-4" style="font-family: 'Alkatra', cursive;">Create New Sales</h1>
    </div>

    <div class="text-center mt-[130px]">
        <a href="add-item.php">
            <button class="bg-sky-500 hover:bg-sky-700 text-white font-bold text-[50px] py-[30px] px-[40px] mx-8 border border-none rounded-xl" style="font-family: 'Alkatra', cursive;">
            Create Item
        </button>
        </a>

        <a href="add-size.php">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-[50px] py-[30px] px-[40px] mx-8 border border-none rounded-xl" style="font-family: 'Alkatra', cursive;">
                Create Size
            </button>
        </a>
    </div>

</body>

</html>