<?php
    include_once("/var/www/html/php/include/_bdie.php");

    if(!isset($_POST['item_id'], $_POST['value'])) return DieWithStatus("Bad Request", 400);

    include_once("/var/www/html/php/include/_execute.php");

    $item_id = $_POST['item_id'];
    $value = $_POST['value'];

    $get_current_qty_sql = "SELECT `Quantity` FROM `StdCable` WHERE `ItemID` = ?;";
    $current_qty_data = ExecuteCommand($get_current_qty_sql, "s", [$item_id]);
    if($current_qty_data === false) return DieWithStatus("Internal Server Error", 500);
    if(mysqli_num_rows($current_qty_data) == 0) return DieWithStatus("Not Found", 404);
    $current_qty = mysqli_fetch_assoc($current_qty_data)['Quantity'];

    $new_qty = $current_qty + $value;

    if($new_qty < 0) return DieWithStatus("Cannot have less than 0", 400);

    $update_qty_sql = "UPDATE `StdCable` SET `Quantity` = ? WHERE `ItemID` = ?;";
    $update_qty_result = ExecuteCommandNoResult($update_qty_sql, "ss", [$new_qty, $item_id]);
    if($update_qty_result === false) return DieWithStatus("Internal Server Error", 500);
    return DieWithStatus(strval($new_qty), 200);