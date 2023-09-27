<?php
session_start();
include('activation.php');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../button.css">

    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300">
    <div class="text-center pt-8">
        <img class="mx-auto rounded-full" src="../img/udd-design.jpg" width="140" height="140">
        <h1 class="text-cyan-50 text-6xl mt-4" style="font-family: 'Alkatra', cursive;">Account List</h1>
    </div>

    <div class="flex pt-4 px-4 mb-6">
        <div class="mx-auto">
            <form method="POST" action="search-account-list.php">
                <input name="search-account" id="search-bar" class="text-slate-400 font-semibold w-[800px] h-[50px] outline-none border-none rounded-l-xl pl-6" type="text" placeholder="Search">
                <button name="search-account-button" class="text-slate-100 bg-sky-600 w-[50px] h-[50px] rounded-r-xl hover:opacity-[0.3]"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="relative">
        <a href="registration.php"><i class="absolute right-[4%] bottom-[20%] mb-3 fa-solid fa-user-plus text-zinc-100 text-[40px] hover:text-blue-900"></i></a>
    </div>

    <table class="w-[95%] mb-8 mt-2 mx-auto font-semibold text-center text-md text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-blue-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="rounded-tl-xl px-6 py-3">
                    Account Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Password
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Firstname
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Lastname
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Created
                </th>

                <th scope="col" class="px-6 py-3">
                    
                </th>

                <th scope="col" class="rounded-tr-xl px-6 py-3">

                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $status = $not_approve_account_row['user_status'];
            do {
                $activation = $not_approve_account_row['activation'];
            ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        <?php echo $not_approve_account_row['username'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php echo $not_approve_account_row['password'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php echo $not_approve_account_row['user_status'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php echo $not_approve_account_row['first_name'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php echo $not_approve_account_row['lastname'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php echo date("F-d-Y: h:i:s A", strtotime($not_approve_account_row['date_created'])) ?>
                    </td>
                        
                    <?php
                        if($activation == "activate"){  
                    ?>
                    <td class="px-6 py-4 text-green-600 font-bold px-2"><?php echo $not_approve_account_row['activation'] ?></td>
                    <?php
                        }else{
                    ?>
                        <td class="px-6 py-4 text-red-600 font-bold"><?php echo $not_approve_account_row['activation'] ?></td>
                        <?php
                        }
                        ?>
                    <td class="px-6 py-4 ">
                        <div>
                            <form method="POST" action="activation.php?ID=<?php echo $not_approve_account_row['user_ID'] ?>">
                                <input type="hidden" name="firstname" value="<?php echo $not_approve_account_row['first_name'] ?>">
                                <input type="hidden" name="lastname" value="<?php echo $not_approve_account_row['lastname'] ?>">
                                <input type="hidden" name="username" value="<?php echo $not_approve_account_row['username'] ?>">
                                <input type="hidden" name="activation" value="<?php echo $not_approve_account_row['activation'] ?>">
                                <?php
                                if ($activation == 'activate') {
                                ?>
                                    <button id="approval" name="approve" class="text-[100%] bg-red-700 text-white w-[80%] font-bold py-2 rounded">Deactivate</button>
                                <?php
                                } else {
                                ?>
                                    <button id="approval" name="approve" class="text-[100%] bg-green-700 text-white w-[80%] font-bold py-2 px-2 rounded">Activate</button>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
                
            } while ($not_approve_account_row = mysqli_fetch_assoc($not_approve_account_query));
            ?>

        </tbody>
    </table>
    <script defer src="../script.js"></script>


</body>


</html>