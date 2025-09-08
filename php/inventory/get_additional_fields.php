<?php
include_once("/var/www/html/php/include/_bdie.php");

if (!isset($_POST['item_type'])) DieWithStatus("Bad Request", 400);

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
    <div class="d-flex flex-column gap-2">
        <div class="mb-3">
            <label for="<?php $input_id ?>" class="form-label"><?php echo $input_txt ?></label>
            <select class="form-select" id="<?php echo $input_id ?>" ?>" required>
                <?php


                // Code for getting the options needed here


                ?>
            </select>
        </div>
        <button class="btn btn-primary">Add <?php echo $input_txt ?></button>
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
    MakeFormSelect("Cable Type", "cable_type", "");
    // Status of device
    FormStatus();
    // Position Requires SQL and will be a select field - Require Add button to add new position -->
    MakeFormSelect("Position", "position", "");
    // Notes - only not required textarea
    FormNotes();
} else if ($item_type == "device") {
    // Device Type - Requires SQL and will be a select field - Require Add button to add new device type
    MakeFormSelect("Device Type", "device_type", "");
    // Serial Number
    FormStandardInput("Serial Number", "serial_number", "text");
    // Status of device
    FormStatus();
    // Position - Requires SQL and will be a select field - Require Add button to add new position
    MakeFormSelect("Position", "position", "");
    // Notes - only not required - textarea
    FormNotes();
} else {
    DieWithStatus("Bad Request", 400);
}
