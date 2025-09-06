<?php
    include_once("/var/www/html/php/include/_bdie.php");

    if(!isset($_POST['item_type'])) DieWithStatus("Bad Request", 400);

    $item_type = $_POST['item_type'];
    if($item_type == "std_cable") {
        //Quantity is only required field
        echo '
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" required>
            </div>';
    } else if($item_type == "special_cable") {
        // Cable Type - Requires SQL and will be a select field - Require Add button to add new cable type
        // Status
        // Position - Requires SQL and will be a select field - Require Add button to add new position
    } else if($item_type == "device") {
        // Device Type - Requires SQL and will be a select field - Require Add button to add new device type
        // Serial Number
        // Current Usage
        // Position - Requires SQL and will be a select field - Require Add button to add new position
        // Notes - only not required - textarea
    } else {
        DieWithStatus("Bad Request", 400);
    }