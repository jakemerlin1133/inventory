<?php
session_start();
include('../function.php');
include('../sidebar/semi-admin-sidebar.php');
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <script defer src="../script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300">
    <div id="logo" class="text-center">
        <img class="mt-2 mx-auto rounded-full" src="../img/udd-design.jpg" width="140" height="140">
        <h1 class="text-cyan-50 text-6xl mt-4" style="font-family: 'Alkatra', cursive;">Customer List</h1>
    </div>


    <div class=" mt-6 relative overflow-x-auto mx-auto w-[90%] bg-white p-8 rounded-lg">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer FirstName</th>
                <th>Customer LastName</th>
                <th>Operated By</th>
               <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            do{
            ?>
            <tr>
                <td><?php echo date("F-d-Y: h:i:s A", strtotime($customers_row['date'])) ?></td>     
                <td><?php echo $customers_row['customer_FN']?></td>
                <td><?php echo $customers_row['customer_LN']?></td>
                <td><?php echo $customers_row['operated_by']?></td>
                <td id="hide"><form method="POST" action="ordered-record.php?ID=<?php echo $customers_row['customer_ID']?>"><button class="text-green-600 hover:text-green-700 font-bold" name="view-customer">View Customer Order</button></form></td>
            </tr>
            <?php
            }while($customers_row = mysqli_fetch_assoc($customers_query))
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Date</th>
            <th>Customer FirstName</th>
                <th>Customer LastName</th>
                <th>Operated By</th>
                <th></th>
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