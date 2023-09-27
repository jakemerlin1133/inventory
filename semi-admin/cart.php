<?php
session_start();
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

<body class="bg-gradient-to-r from-sky-200 via-blue-100 to-sky-200 ">

    <div class="relative mb-8 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-blue-400 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-gray-700">
                    <th scope="col" class="px-6 py-3">
                        <a href="sales.php"><i class="fa-solid fa-left-long align-left text-3xl"></i></a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Item Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Price
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (!empty($_SESSION['shopping_cart'])) {
                    $total = 0;
                    $total_quantity = 0;
                    foreach ($_SESSION['shopping_cart'] as $key => $value) {
                ?>
                        <tr class="border-b bg-white dark:bg-gray-800 dark:border-gray-700 text-md font-bold text-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium item-center whitespace-nowrap dark:text-white">
                                <div> <img class="mx-auto" src="../img/<?php echo $value['Item_Image'] ?>" height="80" width="80">
                            </th>
                            <td class="px-6 py-4 text-center">
                                <?php echo $value['Item_Name']; ?>
                                <input type="hidden" name="cart-Item_Name" value="<?php echo $value['Item_Name']; ?>">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php echo $value['Item_Size']; ?>
                                <input type="hidden" name="cart-Item_Size" value="<?php echo $value['Item_Size']; ?>">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php echo $value['Item_Quantity']; ?>
                                <input type="hidden" name="cart-Item_Quantity" value="<?php echo $value['Item_Quantity']; ?>">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php echo number_format($value['Item_Quantity'] * $value['Item_Price'], 2) ?>
                                <input type="hidden" name="cart-Item_Total_Price_Quantiy" value="<?php echo number_format($value['Item_Quantity'] * $value['Item_Price'], 2); ?>">
                            </td>
                            <td>
                                <a href="cart.php?action=delete&size=<?php echo $value['Item_Size'] ?>&ID=<?php echo $value['Item_ID'] ?>">
                                    <h1 class="text-center text-red-600 hover:text-red-900">Remove</h1>
                                </a>
                            </td>
                        </tr>

                        <?php
                        $total = $total + ($value['Item_Quantity'] * $value['Item_Price']);
                        $total_quantity = $total_quantity += $value['Item_Quantity'];
                        $_SESSION['total_quantity'] = $total_quantity;
                        ?>

                        <!-- Main modal -->
                        <div id="fill-out-customer-info" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="fill-out-customer-info">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="px-6 py-6 lg:px-8">
                                        <h3 class="mb-4 text-center text-xl font-medium text-gray-900 dark:text-white">Customer Information</h3>
                                        <form method="POST" class="space-y-6">

                                            <?php foreach ($_SESSION['shopping_cart'] as $key => $values) {
                                                $total_price = $values['Item_Price'] * $values['Item_Quantity'];
                                            ?>

                                                <input type="hidden" name="sold_item_name" value="<?php echo $values['Item_Name'] ?>">
                                                <input type="hidden" name="sold_item_size" value="<?php echo $values['Item_Size'] ?>">
                                                <input type="hidden" name="sold_item_quantity" value="<?php echo $values['Item_Quantity'] ?>">
                                                <input type="hidden" name="Item_price" value="<?php echo $value['Item_Price'] ?>">
                                                <input type="hidden" name="sold_total_price" value="<?php echo $total_price; ?>">
                                            <?php } ?>

                                            <div>
                                                <label for="firstname" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Firstname</label>
                                                <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white focus:border-gray-300 focus:outline-gray-300" placeholder="Firstname">
                                            </div>

                                            <div>
                                                <label for="lastname" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Lastname</label>
                                                <input type="text" name="lastname" id="lastname" placeholder="Lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white focus:border-gray-300 focus:outline-gray-300">
                                            </div>

                                            <div>
                                                <label for="status" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Percent of Discount</label>
                                                <input type="number" name="discount" id="discount" min="0" max="100" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white focus:border-gray-300 focus:outline-gray-300" value="0" placeholder="Discount %">
                                            </div>

                                            <button type="submit" name="submit-customer-info" class="w-full mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
        
                        </div>
                    <?php
                    }
                    ?>

                    <tr class="h-12 bg-blue-300">
                        <td class="text-center" colspan="3">
                            <?php
                            if (isset($errors)) {
                            ?>
                                <div class="text-red-700 text-[15px]">
                                    <h1 style="font-family: 'Alkatra', cursive;"><?php echo $errors; ?></h1>
                                </div>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center text-black font-semibold"><span class="font-bold ">Total Quantity: </span><?php echo number_format($_SESSION['total_quantity']) ?> </td>
                        <td class="text-center text-black font-semibold"><span class="font-bold ">Total Price: </span><?php echo number_format($total, 2) ?> </td>
                        <td class="text-center"><button type="button" class=" bg-blue-500 hover:bg-blue-700 text-white font-bold w-32 py-2 border border-blue-700 rounded" data-modal-target="fill-out-customer-info" data-modal-toggle="fill-out-customer-info">Next</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
            </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>