<?php
include_once("/var/www/html/php/include/_bdie.php");

if (!isset($_POST['item_type'])) DieWithStatus("Bad Request", 400);

include_once("/var/www/html/php/include/_execute.php");

function FormStandardInput($input_txt, $input_id, $input_type)
{
?>
    <div class="mb-3">
        <label for="<?php echo $input_id ?>" class="form-label"><?php echo $input_txt ?></label>
        <input type="<?php echo $input_type ?>" class="form-control" id="<?php echo $input_id ?>" required>
    </div>
<?php
}

function MakeFormSelect($input_txt, $input_id, $sql)
{
?>
    <div class="d-flex flex-row w-100 gap-2">
        <div class="mb-3 w-100">
            <label for="<?php echo $input_id ?>" class="form-label"><?php echo $input_txt ?></label>
            <select class="form-select" id="<?php echo $input_id ?>" required>
                <?php
                // Code for getting the options needed here
                $get_data = ExecuteCommandNoParams($sql);
                if ($get_data == false) DieWithStatus("Uh oh", 404);
                if (mysqli_num_rows($get_data) == 0) DieWithStatus("Uh oh", 404);
                while ($select_data = mysqli_fetch_assoc($get_data)) {
                    $select_id = $select_data['ID'];
                    $select_name = $select_data['Name'];
                    ?>
                        <option value='<?php echo $select_id ?>'><?php echo $select_name ?></option>";
                    <?php
                }

                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="add_button_<?php echo $input_id ?>" class="form-label">Can't Find Option?</label>
            <button id="add_button_<?php echo $input_id ?>" class="form-control btn btn-primary">Add <?php echo $input_txt ?></button>
        </div>
    </div>
<?php
}

function FormStatus()
{
?>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" required>
            <option value="" disabled selected>Select Status</option>
            <option value="In-Use">In Use</option>
            <option value="Free">Free</option>
            <option value="Broken">Broken</option>
        </select>
    </div>
<?php
}

function FormNotes()
{
?>
    <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea class="form-control" id="notes">

        </textarea>
    </div>
<?php
}

$item_type = $_POST['item_type'];
if ($item_type == "std_cable") {
    //Quantity is only required field
    FormStandardInput("Quantity", "quantity", "number");
} else if ($item_type == "special_cable") {
    // Cable Type - Requires SQL and will be a select field - Require Add button to add new cable type
    $cable_types_sql = "SELECT `TypeID` AS `ID`, `TypeName` as `Name` FROM `ItemType`;";
    MakeFormSelect("Cable Type", "cable_type", $cable_types_sql);
    // Status of device
    FormStatus();
    // Position Requires SQL and will be a select field - Require Add button to add new position -->
    $positions_sql = "SELECT `PositionID` AS `ID`, `PositionName` as `Name` FROM `Positions`;";
    MakeFormSelect("Position", "position", $positions_sql);
    // Notes - only not required textarea
    FormNotes();
} else if ($item_type == "device") {
    // Device Type - Requires SQL and will be a select field - Require Add button to add new device type
    $device_types_sql = "SELECT `TypeID` AS `ID`, `TypeName` as `Name` FROM `ItemType`;";
    MakeFormSelect("Device Type", "device_type", $device_types_sql);
    // Serial Number
    FormStandardInput("Serial Number", "serial_number", "text");
    // Status of device
    FormStatus();
    // Position - Requires SQL and will be a select field - Require Add button to add new position
    $positions_sql = "SELECT `PositionID` AS `ID`, `PositionName` as `Name` FROM `Positions`;";
    MakeFormSelect("Position", "position", $positions_sql);
    // Notes - only not required - textarea
    FormNotes();
} else {
    DieWithStatus("Bad Request", 400);
}
