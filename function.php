<?php
// Connecto to database
$con = mysqli_connect("localhost", "root", "1234", "uddesign_inventory");

// login_in function
if (isset($_POST['login_submit'])) {

    $username = $_POST['username'];
    $password = $_POST['login_password'];
    $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    $login_row = mysqli_fetch_assoc($result);
    $error = "";

    if (mysqli_num_rows($result) == 1) {
        $activation = $login_row['activation'];
        if ($activation == "activate") {
            if ($login_row['user_status'] == "admin") {
                session_start();
                $_SESSION['firstname'] = $login_row['first_name'];
                $_SESSION['lastname'] = $login_row['lastname'];
                $_SESSION['auth'] = 'true';
                header('Location: admin/account-list.php');
            } else if ($login_row['user_status'] == "semi-admin") {
                session_start();
                $_SESSION['firstname'] = $login_row['first_name'];
                $_SESSION['lastname'] = $login_row['lastname'];
                $_SESSION['auth'] = 'true';
                header('Location: semi-admin/sales.php');
            } else {
                session_start();
                $_SESSION['firstname'] = $login_row['first_name'];
                $_SESSION['lastname'] = $login_row['lastname'];
                $_SESSION['auth'] = 'true';
                header('Location: seller/sales.php');
            }
        } else {
            $error = " Invalid Username or Password.";
        }
    } else {
        $error = " Invalid Username or Password.";
    }
}

// registration function
if (isset($_POST['create'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $activation = "active";
    $status = $_POST['status'];
    $submit = true;

    $select_sql = "SELECT `username` FROM `user` WHERE `username` = '$username'";
    $select_query = mysqli_query($con, $select_sql);
    $select_row = mysqli_fetch_assoc($select_query);

    if (!empty($username)) {
        if (isset($select_row['username']) == $_POST['username']) {
            $username_already_error = " The username is already used.";
            $submit = false;
        }
    } else if (empty($username)) {
        $username_error = " Username is Required.";
        $submit = false;
    }
    if (empty($password)) {
        $password_error = " Password is Required.";
        $submit = false;
    }
    if (empty($firstname)) {
        $firstname_error = " Firstname is Required.";
        $submit = false;
    }
    if (empty($lastname)) {
        $lastname_error = " Lastname is Required.";
        $submit = false;
    }
    if ($submit) {
        $sql = "INSERT INTO `user`(`username`, `password`, `user_status`, `first_name`, `lastname`,`activation`) VALUES ('$username','$password','$status','$firstname','$lastname','$activation')";
        $query = mysqli_query($con, $sql);
        echo '<script>alert("Registered Successfully!"); window.location.replace("account-list.php")</script>';
    }
}

// Select all the item from the Databas
$item_sql = "SELECT * FROM `item` ORDER BY Item_ID ASC";
$item_query = mysqli_query($con, $item_sql);
$item_row = mysqli_fetch_assoc($item_query);
$item = $item_row['Item_ID'];

// Select all the size from the Databases
$size_sql = "SELECT * FROM `size`";
$size_query = mysqli_query($con, $size_sql);
$size_rows = mysqli_fetch_all($size_query, MYSQLI_ASSOC);

// Add the Item to cart
if (isset($_POST['proceed-to-cart'])) {
    if (isset($_SESSION['shopping_cart'])) {

        $exist = false;
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
            if ($value['Item_Name'] == $_POST['Item_Name'] && $value['Item_Size'] == $_POST['size']) {
                $_SESSION['shopping_cart'][$key]['Item_Quantity'] = $value['Item_Quantity'] + intval($_POST['quantity']);
                $exist = true;
                break;
            }
        }

        if (!$exist) {

            $item_array = array(
                'Item_ID' => $_GET['ID'],
                'Item_Image' => $_POST['Item_Image'],
                'Item_Name' => $_POST['Item_Name'],
                'Item_Size' => $_POST['size'],
                'Item_Quantity' => intval($_POST['quantity']),
                'Item_Price' => $_POST['Item_Price'],
            );
            array_push($_SESSION['shopping_cart'], $item_array);
        }
    } else {

        $item_array = array(
            'Item_ID' => $_GET['ID'],
            'Item_Image' => $_POST['Item_Image'],
            'Item_Name' => $_POST['Item_Name'],
            'Item_Size' => $_POST['size'],
            'Item_Quantity' => intval($_POST['quantity']),
            'Item_Price' => $_POST['Item_Price'],
        );
        $_SESSION['shopping_cart'][0] = $item_array;
    }
}

// Remove the Item in the cart
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
            if ($value['Item_ID'] == $_GET['ID'] && $value['Item_Size'] == $_GET['size']) {
                unset($_SESSION['shopping_cart'][$key]);
                unset($_SESSION['total_quantity']);
            }
        }
    }
}

// Add to cart quantity
if (isset($_SESSION['total_quantity'])) {
    $cart_quantity = $_SESSION['total_quantity'];
    $plus = "";
    if ($cart_quantity > 99) {
        $cart_quantity = 99;
        $plus = "+";
    }
}

// Search button function
if (isset($_POST['search-button'])) {
    $search = $_POST['search'];
    $search_item_sql = "SELECT * FROM `item` WHERE Item_Name LIKE '%$search%' ORDER BY Item_ID ASC";
    $search_item_query =  mysqli_query($con, $search_item_sql);
}

// CART FORM VALIDATION AND SUBMIT THE FORM
if (isset($_POST['submit-customer-info'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $discount = $_POST['discount'];
    $valid = true;
    $errors = "";

    if (empty($firstname)) {
        $errors = " Please Fill out the Firstname properly.";
        $valid = false;
    }

    if (empty($lastname)) {
        $errors = " Please Fill out the Lastname properly.";
        $valid = false;
    }

    if (empty($lastname) && empty($firstname)) {
        $errors = " Please Fill out the Form properly.";
        $valid = false;
    }

    if ($valid) {

        $transaction_status = true; // Initialize transaction status
        $errors = "The stocks of the chosen item are not available.";

        foreach ($_SESSION['shopping_cart'] as $key => $values) {
            $operated_by = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
            $sold_item_name = $values['Item_Name'];
            $sold_item_size = $values['Item_Size'];
            $sold_item_quantity = $values['Item_Quantity'];
            $old_item_price = $values['Item_Price'];
            $sold_item_total_price = $values['Item_Price'] * $values['Item_Quantity'];
            $sold_item_discounted_price = ($sold_item_total_price - ($sold_item_total_price * ($discount / 100)));

            // Retrieve item and size IDs
            $select_item_ID = "SELECT * FROM `item` WHERE Item_Name = '$sold_item_name'";
            $select_item_ID_query = mysqli_query($con, $select_item_ID);
            $select_item_row = mysqli_fetch_assoc($select_item_ID_query);
            $item_ID = $select_item_row['Item_ID'];

            $select_Size_ID = "SELECT * FROM `size` WHERE Size_Name = '$sold_item_size'";
            $select_Size_ID_query = mysqli_query($con, $select_Size_ID);
            $select_size_row = mysqli_fetch_assoc($select_Size_ID_query);
            $size_ID = $select_size_row['Size_ID'];

            // Retrieve available stock
            $inventory_stock = "SELECT * FROM `inventory` WHERE Item_ID = $item_ID AND Size_ID = $size_ID";
            $inventory_stock_query = mysqli_query($con, $inventory_stock);
            $inventory_stock_row = mysqli_fetch_assoc($inventory_stock_query);
            $inventory = $inventory_stock_row['Stocks'];

            if ($sold_item_quantity > $inventory) {
                $transaction_status = false;
                $errors = "The stocks of the chosen item are not available.";
            }
        }

        if (!$transaction_status) {
            $errors = "The stocks of the chosen item are not available.";
        } else {
            // Proceed with the transaction
            $customer_sql = "INSERT INTO `customer`(`customer_FN`, `customer_LN`,`operated_by`) VALUES ('$firstname','$lastname','$operated_by')";
            $customer_query = mysqli_query($con, $customer_sql);
            $customer_last_ID = mysqli_insert_id($con);

            foreach ($_SESSION['shopping_cart'] as $key => $values) {
                $sold_item_name = $values['Item_Name'];
                $sold_item_size = $values['Item_Size'];
                $sold_item_quantity = $values['Item_Quantity'];
                $old_item_price = $values['Item_Price'];
                $sold_item_total_price = $values['Item_Price'] * $values['Item_Quantity'];
                $sold_item_discounted_price = ($sold_item_total_price - ($sold_item_total_price * ($discount / 100)));

                // Update stock in the inventory
                $stock_out = "UPDATE `inventory` SET `Stocks`= Stocks - $sold_item_quantity WHERE Item_ID = '$item_ID' AND Size_ID = '$size_ID'";
                $stock_out_query = mysqli_query($con, $stock_out);


                // Insert sold item record
                $sold_record_sql = "INSERT INTO `sold_item_record`(`customer_ID`, `Item_Name`, `Item_Size`, `quantity`,`Discount`, `Item_price`, `Total_Price`,`Discounted_Price`) VALUES ('$customer_last_ID','$sold_item_name','$sold_item_size','$sold_item_quantity','$discount','$old_item_price','$sold_item_total_price', $sold_item_discounted_price)";
                $sold_record_query = mysqli_query($con, $sold_record_sql);
            }

            unset($_SESSION['shopping_cart']);
            unset($_SESSION['total_quantity']);
            echo '<script type="text/javascript">';
            echo 'alert("The Transaction is Successful!");';
            echo 'window.location.href = "customer.php";';
            echo '</script>';
        }
    }
}

// Select item name, size and stocks in inventory inside database in seller page.
$inventory = "SELECT item.Item_Name AS Item_name, size.Size_Name AS Size_name, inventory.Stocks AS Stocks FROM item INNER JOIN inventory ON item.Item_ID = inventory.Item_ID INNER JOIN size ON size.Size_ID = inventory.Size_ID WHERE Stocks > 0";
$inventory_query = mysqli_query($con, $inventory);
$inventory_row = mysqli_fetch_assoc($inventory_query);

// Select customer from database
$customers = "SELECT * FROM `customer`";
$customers_query = mysqli_query($con, $customers);
$customers_row = mysqli_fetch_assoc($customers_query);


// Select customer where ID
if (isset($_POST['view-customer'])) {
    $id = $_GET['ID'];
    $customers = "SELECT * FROM `customer` WHERE customer_ID = $id ";
    $customers_query = mysqli_query($con, $customers);
    $customers_ordered_row = mysqli_fetch_assoc($customers_query);

    $discount = "SELECT * FROM `customer_status` WHERE customer_status = ";

    $customer_order = "SELECT * FROM `sold_item_record` WHERE customer_ID = $id ";
    $customer_order_query = mysqli_query($con, $customer_order);
    $customer_order_query_row = mysqli_fetch_assoc($customer_order_query);
}
// Select all Sold Item Record from database
$customer_order_record = "SELECT * FROM `sold_item_record`";
$customer_order_record_query = mysqli_query($con, $customer_order_record);
$customer_order_record_row = mysqli_fetch_assoc($customer_order_record_query);

// Select item name, size and stocks in inventory inside database in admin page.
$admin_inventory = "SELECT item.Item_Name AS Item_name, size.Size_Name AS Size_name, inventory.Stocks AS Stocks FROM item INNER JOIN inventory ON item.Item_ID = inventory.Item_ID INNER JOIN size ON size.Size_ID = inventory.Size_ID";
$admin_inventory_query = mysqli_query($con, $admin_inventory);
$admin_inventory_row = mysqli_fetch_assoc($admin_inventory_query);

// add quantity to database
if (isset($_POST['add-quantity-submit'])) {
    $added_by = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    $item_Name = $_POST['item'];
    $size_name = $_POST['size'];
    $quantity = $_POST['quantity'];

    $select_Item = "SELECT Item_ID FROM `item` WHERE Item_Name = '$item_Name'";
    $select_Item_query = mysqli_query($con, $select_Item);
    $select_Item_row = mysqli_fetch_assoc($select_Item_query);
    $item_ID = $select_Item_row['Item_ID'];

    $select_Size = "SELECT Size_ID FROM `size` WHERE Size_Name = '$size_name'";
    $select_Size_ID_query = mysqli_query($con, $select_Size);
    $select_size_row = mysqli_fetch_assoc($select_Size_ID_query);
    $size_id = $select_size_row['Size_ID'];

    $select_inventory = "SELECT * FROM `inventory` WHERE Item_ID = $item_ID AND Size_ID = $size_id";
    $select_inventory_query = mysqli_query($con, $select_inventory);
    $select_inventory_row = mysqli_fetch_all($select_inventory_query);

    $add_item_history = "INSERT INTO `item_stocks_history`(`Item_ID`, `Size_ID`, `Stocks_added`, `Added_By`) VALUES ('$item_ID','$size_id','$quantity','$added_by')";
    $add_item_history_query = mysqli_query($con, $add_item_history);
    echo '<script type="text/javascript">';
    echo 'alert("The Add Stocks Successful!");';
    echo 'window.location.href = "item-stocks.php";';
    echo '</script>';

    if ($select_inventory_row) {
        $addstocks = "UPDATE `inventory` SET `Stocks` = Stocks + $quantity WHERE Item_ID = $item_ID AND Size_ID = $size_id";
        $addstocks_query = mysqli_query($con, $addstocks);
        echo '<script type="text/javascript">';
        echo 'alert("The Add Stocks Successful!");';
        echo 'window.location.href = "item-stocks.php";';
        echo '</script>';
        exit();
    } else {
        $addstocks = "INSERT INTO `inventory`(`Item_ID`, `Size_ID`, `Stocks`) VALUES ('$item_ID','$size_id','$quantity')";
        $addstocks_query = mysqli_query($con, $addstocks);
        echo '<script type="text/javascript">';
        echo 'alert("The Add Stocks Successful!");';
        echo 'window.location.href = "item-stocks.php";';
        echo '</script>';
        exit();
    }
}

// Select account from database
$not_approve_account = "SELECT * FROM `user` WHERE user_status != 'admin' ";
$not_approve_account_query = mysqli_query($con, $not_approve_account);
$not_approve_account_row = mysqli_fetch_assoc($not_approve_account_query);

// search account
if (isset($_POST['search-account-button'])) {
    $account_search = $_POST['search-account'];
    $search_account_sql = "SELECT * FROM `user` WHERE (username LIKE '%$account_search%' || password LIKE '%$account_search%' || first_name LIKE '%$account_search%' || lastname LIKE '%$account_search%' || user_status LIKE '%$account_search%') AND user_status NOT LIKE 'admin'";
    $search_account_query =  mysqli_query($con, $search_account_sql);
    $search_account_row = mysqli_fetch_assoc($search_account_query);
}

// Select all item from add_history
$add_inventory_history = "SELECT item.Item_Name AS Item_name, size.Size_Name AS Size_name, item_stocks_history.Stocks_added AS Stocks, item_stocks_history.Date_added AS Dates, item_stocks_history.Added_By AS added_by FROM item INNER JOIN item_stocks_history ON item.Item_ID = item_stocks_history.Item_ID INNER JOIN size ON size.Size_ID = item_stocks_history.Size_ID;";
$add_inventory_history_query = mysqli_query($con, $add_inventory_history);
$inventory_history_row = mysqli_fetch_assoc($add_inventory_history_query);

// Add Size
if(isset($_POST['add-size-submit'])){
    $add_size = $_POST['add-size'];
    $add_size_submit = "INSERT INTO `size`(`Size_Name`) VALUES ('$add_size')";
    $add_size_submit_query = mysqli_query($con, $add_size_submit);
    echo '<script type="text/javascript">';
    echo 'alert("The Add Size Successful!");';
    echo 'window.location.href = "add-size.php";';
    echo '</script>';
    exit();
}