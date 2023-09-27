<?php 
include('../function.php');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../print.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="../sidebar.css">
    <title>Document</title>
</head>

<body>
    <div class="flex">
        <div class="flex z-50">
            <div id="sidebar" class="fixed left-[-240px] w-[240px] h-screen rounded-md bg-gradient-to-r from-cyan-500 via-sky-400 to-blue-400">
                <div class="flex mt-5 ml-2 py-8">
                    <div><img class="rounded-full" src="../img/udd-design.jpg" width="70" height="70"></div>
                    <div class="my-auto text-[30px] ml-2 text-cyan-50" style="font-family: 'Alkatra', cursive;"> Inventory</div>
                </div>

                <ul>
                    <a href="sales.php">
                        <li class="text-white font-semibold text-[25px] font-normal border-b-[1px] p-2 hover:bg-slate-200 hover:text-gray-100"><i class="fa-solid fa-house mr-4"></i><span class="text-[18px]">Dashboard</li>
                    </a>
                    <a href="item-stocks.php">
                        <li class="text-white font-semibold text-[25px] font-normal border-b-[1px] p-2 hover:bg-slate-200 hover:text-gray-100"><i class="fa-solid fa-cart-shopping mr-3"></i><span class="text-[18px]">View Item Stocks</li>
                    </a>
                    <a href="customer.php">
                        <li class="text-white font-semibold text-[25px] font-normal border-b-[1px] p-2 hover:bg-slate-200 hover:text-gray-100"><i class="fa-sharp fa-solid fa-user mr-4"></i><span class="text-[18px]">View Customer</li>
                    </a>
                    <a href="sold.php">
                        <li class="text-white font-semibold text-[25px] font-normal border-b-[1px] p-2 hover:bg-slate-200 hover:text-gray-100"><i class="fa-solid fa-table mr-4"></i><span class="text-[18px]">View Sold Item</li>
                    </a>
                    <a href="../logout.php">
                        <li class="text-white font-semibold text-[25px] font-normal border-b-[1px] p-2 hover:bg-slate-200 hover:text-gray-100"><i class="fa-sharp fa-solid fa-power-off mr-4"></i><span class="text-[18px]">Logout</li>
                    </a>

                </ul>
            </div>
            <div class="text-4xl m-2">
                <i id="hamburger" class="fixed left-[5px] bg-sky-600 text-slate-200 pt-1 pb-1 pr-2 pl-2 rounded-md fa-sharp fa-solid fa-bars"></i>
            </div>

        </div>

        <div class="content">

        </div>

    </div>


</body>

</html>