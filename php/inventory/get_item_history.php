<?php
include_once("/var/www/html/php/include/_bdie.php");

if (!isset($_POST['item_id'], $_POST['type'])) return DieWithStatus("Bad Request", 400);

include_once("/var/www/html/php/include/_execute.php");

$item_id = $_POST['item_id'];
$type = $_POST['type'];

function GetHistoryData($sql, $item_id) 
{
    $item_history = ExecuteCommand($sql, "s", [$item_id]);
    if ($item_history === false) return DieWithStatus("Internal Server Error", 500);
    if (mysqli_num_rows($item_history) == 0) return DieWithStatus("Not Found", 404);

    $last_usage = "";
    $last_position = "";

    while ($current_item_time = mysqli_fetch_assoc($item_history)) {
        // Find differences from the order given, for each change write $date[`DATETIME`] + [Changes Made]
        $string_to_append = "";
        $start_new_line = false;

        if($last_usage == "" && $last_position == "") {
            $last_usage = $current_item_time['CurrentUsage'];
            $last_position = $current_item_time['PositionName'];
            $string_to_append = "Initial status: <em>" . $last_usage . "</em>, at position: <em>" . $last_position . "</em>.";
            echo "<p>" . $string_to_append . "</p>";
            continue;
        }

        if ($last_usage != $current_item_time['CurrentUsage']) {
            $start_new_line = true;
            $string_to_append = date("d-m-Y",strtotime($current_item_time['DATETIME'])) . ": Status changed from: <em>" . $last_usage . "</em> to: <em>" . $current_item_time['CurrentUsage'] . "</em>. ";
        }
        if ($last_position != $current_item_time['PositionName']) {
            if(!$start_new_line) $string_to_append = date("d-m-Y",strtotime($current_item_time['DATETIME'])) . ": ";
            $string_to_append = $string_to_append . "Position changed from: <em>" . $last_position . "</em> to: <em>" . $current_item_time['PositionName'] . "</em>.";
        }
        echo "<p>" . $string_to_append . "</p>";

        $last_usage = $current_item_time['CurrentUsage'];
        $last_position = $current_item_time['PositionName'];
    }
}

if ($type == 1) {
    // Get `CurrentUsage`, `PositionID`, `DATETIME` WHERE `ItemID` = ?
    // ? = $item_id ORDER BY `DATETIME` ASC
    $get_item_history_sql = "SELECT `ItemID`, `CurrentUsage`, `PositionName`, `DATETIME` 
    FROM `SpecialCable` LEFT JOIN `Positions` 
    ON `SpecialCable`.`PositionID` = `Positions`.`PositionID` 
    WHERE `ItemID` = ? ORDER BY `DATETIME` ASC;";

    GetHistoryData($get_item_history_sql, $item_id);
}
else if ($type == 2) {
    // Same as if type was type 1 but with different table, Device instead of SpecialCable
    $get_item_history_sql = "SELECT `ItemID`, `CurrentUsage`, `PositionName`, `DATETIME` 
    FROM `Device` LEFT JOIN `Positions` 
    ON `Device`.`PositionID` = `Positions`.`PositionID` 
    WHERE `ItemID` = ? ORDER BY `DATETIME` ASC;";

    GetHistoryData($get_item_history_sql, $item_id);
} else {
    return DieWithStatus("Bad Request", 400);
}
