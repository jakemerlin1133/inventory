<?php
include('function.php');
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
        <img class="mt-16 mx-auto rounded-full" src="img/udd-design.jpg" width="150" height="150">
        <h1 class="text-cyan-50 text-8xl mt-12" style="font-family: 'Alkatra', cursive;">Inventory System</h1>
    </div>
    <div class="flex w-[500px] mx-auto mt-12 rounded-2xl bg-black/25 shadow-xl">
        <form class=" mx-auto py-4 px-[20px]" method="POST">
            <h1 class="text-cyan-50 text-[50px]" style="font-family: 'Alkatra', cursive;">Log in Your Account</h1>

            <div class="flex mt-2">
                <div class="bg-sky-600 p-[13px] rounded-l-md"><i class="fa-solid fa-user"></i></div>
                <input type="text" name="username" class=" outline-none border-none rounded-r-md w-[380px] text-slate-500" placeholder="Username">
            </div>

            <?php if (isset($error)) { ?>
                <div class="text-center text-red-700 mt-2">
                    <h1><i class="fa-sharp fa-solid fa-circle-exclamation"></i><?php echo $error; ?></h1>
                </div>
            <?php } ?>

            <div class="flex mt-2 ">
                <div class="bg-sky-600 p-[12px] rounded-l-md"><i class="fa-solid fa-key"></i></div>
                <input type="password" name="login_password" class="outline-none border-none rounded-r-md w-[380px] text-slate-500" placeholder="Password">
            </div>

            <div>
                <button type="submit" name="login_submit" class=" flex text-base text-slate-800 bg-sky-600 mt-2 mx-auto py-2 px-8 rounded-md hover:bg-sky-500 hover:text-sky-200">Login</button>
            </div>

        </form>
    </div>
</body>

</html>