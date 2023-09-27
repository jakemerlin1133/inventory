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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../sidebar.css">
    <script defer src="../script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300 ">
    <div class="text-center">
        <img class="mt-2 mx-auto rounded-full" src="../img/udd-design.jpg" width="140" height="140">
        <h1 class="text-cyan-50 text-6xl mt-4" style="font-family: 'Alkatra', cursive;">Sales Report</h1>
    </div>

    <div class="ml-4">
        <form action="">
            <div date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                </div>
                <button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Select</button>
            </div>
        </form>
    </div>


    <div class="w-[95%] mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">

        <?php
        do {

            // Item ID
            $Item_ID = $item_record_row['Item_ID'];

            // select all size of the item in the record
        $select_sales = "SELECT item.Item_Name, size.Size_Name, inventory.Stocks FROM size INNER JOIN inventory ON size.Size_ID = inventory.Size_ID INNER JOIN item ON item.Item_ID = inventory.Item_ID GROUP BY size.Size_Name, inventory.Item_ID, item.Item_Name ORDER BY `item`.`Item_Name` ASC";
        $select_sales_query = mysqli_query($con,$select_sales);
        $select_sales_row = mysqli_fetch_assoc($select_sales_query);


        ?>
            <table class="mt-6 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center bg-sky-500">
                        <th class="py-4 text-white text-[20px]" colspan="5"><?php echo $item_record_row['Item_Name'] ?></th>
                    </tr>
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            Item Sizes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. of Sales
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Remaining Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    do {
                    ?>
                        <tr class="bg-white text-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <?php echo $select_sales_row['Size_Name'] ?>
                            </td>
                            <td class="px-6 py-4">
                                24
                            </td>
                            <td class="px-6 py-4">
                                25
                            </td>
                            <td class="px-6 py-4">
                                25,000
                            </td>
                            <td class="px-6 py-4">
                                2
                            </td>
                        </tr>
                    <?php
                    } while ($select_sales_row = mysqli_fetch_assoc($select_sales_query))
                    ?>
                </tbody>
            </table>
        <?php
        } while ($item_record_row = mysqli_fetch_assoc($item_record_query))
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/datepicker.min.js"></script>

</body>

</html>