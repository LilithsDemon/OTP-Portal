<?php
    include_once("/var/www/html/php/include/_bdie.php");

    if(!isset($_POST['item_id'], $_POST['type'])) return DieWithStatus("Bad Request", 400);

    include_once("/var/www/html/php/include/_execute.php");

    $item_id = $_POST['item_id'];
    $type = $_POST['type'];

    if($type == 1)
    {
        $get_cable_notes_sql = "SELECT `Notes`, `DATETIME` FROM `SpecialCable` WHERE `ItemID` = ? ORDER BY `DATETIME` ASC;";
        $cable_notes_data = ExecuteCommand($get_cable_notes_sql, "s", [$item_id]);
        if($cable_notes_data === false) return DieWithStatus("Internal Server Error", 500);
        if(mysqli_num_rows($cable_notes_data) == 0) return DieWithStatus("Not Found", 404);

        while($notes = mysqli_fetch_assoc($cable_notes_data))
        {
            echo "<p>" . $notes['DATETIME'] . " - " . $notes['Notes'] . "</p>";
        }
    }
    else if($type == 2)
    {
        $get_device_notes_sql = "SELECT `Notes`, `DATETIME` FROM `Device` WHERE `ItemID` = ? ORDER BY `DATETIME` ASC;";
        $device_notes_data = ExecuteCommand($get_device_notes_sql, "s", [$item_id]);
        if($device_notes_data === false) return DieWithStatus("Internal Server Error", 500);
        if(mysqli_num_rows($device_notes_data) == 0) return DieWithStatus("Not Found", 404);

        while($notes = mysqli_fetch_assoc($device_notes_data))
        {
            echo "<p>" . $notes['DATETIME'] . " - " . $notes['Notes'] . "</p>";
        }
    }
    else
    {
        return DieWithStatus("Bad Request", 400);
    }