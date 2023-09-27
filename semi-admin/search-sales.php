<?php
session_start();
include('../sidebar/semi-admin-sidebar.php');
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="../script.js"></script>
    <link rel="stylesheet" href="../sidebar.css">
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300 ">
    <div class="flex pt-4 px-4">
        <div class="mx-auto">
            <form method="POST" action="search-sales.php">
                <input name="search" id="search-bar" class="text-slate-400 font-semibold w-[1600px] h-[50px] outline-none border-none rounded-l-xl pl-6" type="text" placeholder="Search">
                <button name="search-button" class="text-slate-100 bg-sky-600 w-[50px] h-[50px] rounded-r-xl hover:opacity-[0.3]"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="relative hover:opacity-50">
        <div id="shopping-cart" class="fixed right-[25px] top-[15px]">
            <a href="cart.php"><i class="relative fa-solid fa-cart-shopping rounded-full bg-sky-600 text-white p-4 text-3xl"></i>
                <?php
                if (isset($_SESSION['total_quantity'])) {
                ?>
                    <div class="absolute w-8 text-center rounded-full top-[-10px] right-[-6px] bg-red-700 px-1 py-1 text-[15px] text-white"><?php echo $_SESSION['total_quantity']; ?></div>
                <?php

                }
                ?>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-5 mx-4">
        <?php
        while ($search_item_row = mysqli_fetch_assoc($search_item_query)) {
            $search_item_id = $search_item_row['Item_ID'];
             // Select the total stocks of the current item
             $total_stocks_query = "SELECT SUM(Stocks) AS total_stocks FROM inventory WHERE Item_ID = $search_item_id";
             $total_stocks_result = mysqli_query($con, $total_stocks_query);
             $total_stocks_row = mysqli_fetch_assoc($total_stocks_result);
        ?>
            <div class="mt-4">
                <div class="bg-sky-600 p-2 rounded-xl m-2 z-[-3] m-4 visible">
                    <input type="hidden" name="Item_ID" value="<?php echo $search_item_id ?>">
                    <div class="h-full w-full mx-auto">
                        <img class="rounded-[35px] mx-auto p-6 h-[320px] w-[320px]" src="../img/<?php echo $search_item_row['Item_Image'] ?>">
                    </div>
                    <div class="mx-auto text-center">
                        <div class="h-full w-full">
                            <h1 class="text-center text-zinc-100 text-3xl mt-2 w-full" style="font-family: 'Secular One', sans-serif;"><?php echo $search_item_row['Item_Name'] ?></h1>
                            <input type="hidden" name="Item_Name" value="<?php echo $search_item_row['Item_Name'] ?>">
                        </div>
                        <div class="h-full w-full">
                            <h6 class="text-center text-md text-slate-700 font-semibold">Total Stocks: <?php echo $total_stocks_row['total_stocks'] ?></h6>
                        </div>
                    </div>

                    <div class="flex text-right mt-2 w-full">
                        <div class="text-zinc-100 text-4xl py-2 mx-auto font-extralight" style="font-family: 'Secular One', sans-serif;"> ₱ <?php echo $search_item_row['Item_Price'] ?>
                            <input type="hidden" name="Item_Price" value="<?php echo $search_item_row['Item_Price'] ?>">
                        </div>
                        <div class="my-auto">
                            <button data-modal-target="cart-<?php echo $search_item_id ?>" data-modal-toggle="cart-<?php echo $search_item_id ?>" class="block font-semibold text-white bg-cyan-950 hover:bg-cyan-950 focus:outline-none rounded-lg text-md px-6 py-2.5 text-center mr-2 hover:opacity-75" type="submit">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <!-- Main modal -->
                <form method="POST" action="cart.php?ID=<?php echo $search_item_id ?>">
                    <div id="cart-<?php echo $search_item_id ?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="cart-<?php echo $search_item_id ?>">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <input type="hidden" name="Item_Name" value="<?php echo $search_item_row['Item_Name'] ?>">
                                <input type="hidden" name="Item_Price" value="<?php echo $search_item_row['Item_Price'] ?>">
                                <input type="hidden" name="Item_Image" value="<?php echo $search_item_row['Item_Image'] ?>">

                                <div class="px-6 py-6 lg:px-8">
                                    <div>
                                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white focus:border-gray-300 focus:outline-gray-300" value="1" min="1">
                                    </div>

                                    <div>
                                        <label for="size-<?php echo $search_item_id ?>" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                                        <select name="size" id="size-<?php echo $search_item_id ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-300 focus:outline-gray-300 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            <?php foreach ($size_rows as $size_row) { ?>
                                                <option value="<?php echo $size_row['Size_Name'] ?>"><?php echo $size_row['Size_Name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="proceed-to-cart" class="w-full mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proceed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>