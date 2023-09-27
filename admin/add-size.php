<?php
session_start();
include('../function.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="sidebar.css">
    <script defer src="../script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Size</title>
</head>

<body class="bg-gradient-to-r from-sky-300 via-blue-200 to-sky-300">
    <div id="logo" class="text-center pt-8">
        <img class="mx-auto rounded-full" src="../img/udd-design.jpg" width="200" height="200">
        <h1 class="text-cyan-50 text-8xl mt-12" style="font-family: 'Alkatra', cursive;">Add Size</h1>
    </div>

        <a href="create-new-sales.php"><i class="absolute left-5 top-[10px] text-5xl fa-sharp fa-solid fa-arrow-left text-cyan-900 hover:text-sky-200"></i></a>


    <div class="text-center mt-8">
        <form method="POST">
            <input type="text" name="add-size" class="rounded-l-lg py-4 px-2 w-[400px] text-center text-gray-500 font-semibold focus:outline-none" placeholder="Add Size">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" name="show-add-stocks" class="text-base text-white font-bold bg-blue-500 mt-2 mx-auto py-4 px-12 rounded-r-lg hover:bg-sky-500 hover:text-sky-200 focus:outline-none">Add</button>


            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <i class="fa-solid fa-question rounded-full font-semibold bg-blue-600 py-3 px-4 text-2xl text-white"></i>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to add new Size?</h3>
                            <button name="add-size-submit" data-modal-hide="popup-modal" type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 px-[10%]">Yes</button>
                            <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600 px-[10%]">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>