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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../sidebar.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ORDER LIST</title>
</head>

<body id="body" class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300 ">
    <div id="logo">
        <img class="text-center mt-2 mx-auto rounded-full" src="../img/udd-design.jpg" width="140" height="140">
        <h1 class="text-center text-cyan-50 text-6xl mt-4" style="font-family: 'Alkatra', cursive;">Ordered List</h1>
        <a href="customer.php"><i class="ml-[5.2%] fa-solid fa-left-long align-left text-5xl text-sky-800 hover:opacity-50"></i></a>
    </div>

    <div id="print-body" class=" relative overflow-x-auto mx-auto w-[90%] bg-white p-8 rounded-lg">
        <div class=" mb-8 text-center text-2xl font-bold text-gray-600">
            Customer Information
        </div>
        <table class="w-[100%] mb-12 text-center mx-auto text-sm text-gray-500 dark:text-gray-400">
            <thead class="font-bold text-gray-600 uppercase dark:bg-gray-700 dark:text-gray-400">

                <tr>
                    <th class="px-2 py-3">
                        Customer First Name
                    </th>
                    <th class="px-2 py-3">
                        Customer Last Name
                    </th>
                </tr>
                

            </thead>
            <tbody>
                <?php
                do {
                ?>
                    <tr class="font-medium bg-white uppercase border-b-2 border-gray-400 dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-2 py-4 font-bold">
                            <?php echo $customers_ordered_row['customer_FN'] ?>
                        </td>
                        <td class="px-2 py-4 font-bold">
                            <?php echo $customers_ordered_row['customer_LN'] ?>
                        </td>
                    </tr>
                <?php
                } while ($customers_ordered_row = mysqli_fetch_assoc($customers_query))
                ?>
            </tbody>
        </table>

        <div class=" mb-2 text-center text-2xl font-bold text-gray-600">
            LIST OF ORDER
        </div>

        <table id="example" class="display nowrap" style="width:100%">
        <thead>
        <tr>
                <th>Item Name</th>
                <th>Item Size</th>
                <th>Item Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Discount</th>
                <th>Discounted Price</th>
            </tr>   
            
        </thead>
        <tbody>

        <?php
            $percent = "%";
        do{ ?>
            <tr>
                <td><?php echo $customer_order_query_row['Item_Name']?></td>
                <td><?php echo $customer_order_query_row['Item_Size']?></td>
                <td><?php echo $customer_order_query_row['Item_Price']?></td>
                <td><?php echo $customer_order_query_row['quantity']?></td>
                <td><?php echo $customer_order_query_row['Total_Price']?></td>
                <td><?php echo $customer_order_query_row['Discount'],$percent?></td>
                <td><?php echo $customer_order_query_row['Discounted_Price']?></td> 
            </tr>
            <?php }while($customer_order_query_row = mysqli_fetch_assoc($customer_order_query))?>
        </tbody>
        <tfoot>
        <tr>
                <th>Item Name</th>
                <th>Item Size</th>
                <th>Item Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Discount</th>
                <th>Discounted Price</th>
            </tr>
        </tfoot>
    </table>

        <div class="relative overflow-x-auto sm:rounded-lg">
            
        </div>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
</body>

</html>