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
        <img class="mx-auto rounded-full" src="../img/udd-design.jpg" width="140" height="140">
        <h1 class="text-cyan-50 text-6xl mt-4" style="font-family: 'Alkatra', cursive;">Add Stocks History</h1>
    </div>

    <div class=" mt-6 mb-6 relative overflow-x-auto mx-auto w-[90%] bg-white p-8 rounded-lg">
        <table id="example" class="display nowrap">
            <thead>
                <tr>
                    <th>Date Added</th>
                    <th>Item Name</th>
                    <th>Item Size</th>
                    <th>Stocks</th>
                    <th>Added By</th>
                </tr>

            </thead>
            <tbody>
                <?php
               do {
                ?>
                    <tr>
                        <td><?php echo date("F-d-Y: h:i:s A", strtotime($inventory_history_row['Dates'])) ?></td>
                        <td><?php echo $inventory_history_row['Item_name'] ?></td>
                        <td><?php echo $inventory_history_row['Size_name'] ?></td>
                        <td><?php echo $inventory_history_row['Stocks'] ?></td>
                        <td><?php echo $inventory_history_row['added_by'] ?></td>
                    </tr>
                <?php
                } while ($inventory_history_row = mysqli_fetch_assoc($add_inventory_history_query))
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>Date Added</th>
                    <th>Item Name</th>
                    <th>Item Size</th>
                    <th>Stocks</th>
                    <th>Added By</th>
                </tr>
            </tfoot>
        </table>
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
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>

</html>