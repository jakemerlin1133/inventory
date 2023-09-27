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
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://kit.fontawesome.com/445aa1d2b6.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-blue-300 via-sky-300 to-cyan-400">
    <div class="text-center">
        <img class="mt-6 mx-auto rounded-full" src="img/udd-design.jpg" width="150" height="150">
        <h1 class="text-cyan-50 text-7xl mt-2" style="font-family: 'Alkatra', cursive;">Create an Account </h1>
    </div>

    <div class="relative text-center mx-auto mt-4 bg-black/25 p-5 w-[400px] h-auto rounded-2xl">
        <a href="account-list.php"><i class="absolute left-5 top-[10px] text-3xl fa-sharp fa-solid fa-arrow-left text-cyan-900 hover:text-sky-200"></i></a>
        <form method="POST">

            <div class="mt-4">
                <label class="text-md text-slate-800 font-semibold" for="firstname">Firstname:</label>
                <input class="rounded-md outline-none border-none ml-2" name="firstname" id="firstname" type="text" placeholder="Enter Firstname">
                <?php if (isset($firstname_error)) { ?>
                    <div class="text-center text-red-700 mt-2">
                        <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $firstname_error; ?></h1>
                    </div>
                <?php } ?>
            </div>

            <div class="mt-4">
                <label class="text-md text-slate-800 font-semibold" for="lastname">Lastname:</label>
                <input class="rounded-md outline-none border-none ml-2" name="lastname" id="lastname" type="text" placeholder="Enter Lastname">
                <?php if (isset($lastname_error)) { ?>
                    <div class="text-center text-red-700 mt-2">
                        <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $lastname_error; ?></h1>
                    </div>
                <?php } ?>
            </div>

            <div class="mt-4">
                <label class="text-md text-slate-800 font-semibold ml-4" for="status">Status:</label>
                <select name="status" id="status" class=" rounded-md outline-none border-none ml-4 h-[40px] w-[57%] pl-2">
                    <option value="seller">seller</option>
                    <option value="semi-admin">semi-admin</option>
                </select>
            </div>

            <div class="mt-4">
                <label class="text-md text-slate-800 font-semibold" for="username">Username:</label>
                <input class="rounded-md outline-none border-none ml-1" name="username" id="username" type="text" placeholder="Enter New Username">
                <?php if (isset($username_already_error)) { ?>
                    <div class="text-center text-red-700 mt-2">
                        <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $username_already_error; ?></h1>
                    </div>
                <?php } ?>
                <?php if (isset($username_error)) { ?>
                    <div class="text-center text-red-700 mt-2">
                        <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $username_error; ?></h1>
                    </div>
                <?php } ?>
            </div>

            <div class="mt-4">
                <label class="text-md text-slate-800 font-semibold" for="password">Password:</label>
                <input class="rounded-md outline-none border-none ml-2" name="password" id="password" type="password" placeholder="Enter New Password">
                <?php if (isset($password_error)) { ?>
                    <div class="text-center text-red-700 mt-2">
                        <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $password_error; ?></h1>
                    </div>
                <?php } ?>
            </div>

            <button type="submit" class="flex mt-4 text-lg text-white bg-sky-700 font-semi bold mt-2 mx-auto py-2 px-8 rounded-md hover:bg-sky-500 hover:text-sky-200" name="create">Create</button>
        </form>
    </div>

</body>

</html>