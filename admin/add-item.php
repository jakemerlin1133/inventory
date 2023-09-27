<?php
session_start();
include('../function.php');
if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
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
    <link rel="stylesheet" href="sidebar.css">
    <script defer src="../script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300">
    <div id="logo" class="text-center pt-8">
        <img class="mx-auto rounded-full" src="../img/udd-design.jpg" width="200" height="200">
        <h1 class="text-cyan-50 text-7xl mt-4" style="font-family: 'Alkatra', cursive;">Add Item</h1>
    </div>
    <a href="create-new-sales.php"><i class="absolute left-5 top-[10px] text-5xl fa-sharp fa-solid fa-arrow-left text-cyan-900 hover:text-sky-200"></i></a>

    <div class="mx-auto">
       qweqweqwq
    </div>


</body>

</html>