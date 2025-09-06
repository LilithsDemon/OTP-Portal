<script src="./js/inventory.js"></script>
<?php
    /*
        Inventory System

        - This inventory system will track all inventory items related to the OTP system.
        - The system will include different types of inventory such as card readers, headsets, and other peripherals.
        - All inventory items will be designated a 4 digit ID for tracking purposes.]
        - The system will track different information based on the equipment type.
        - The system will allow for adding, editing, and deleting inventory items.
        - The system will also allow for searching and filtering inventory items based on different criteria.
        - The system will also track the location of each inventory item.
        - The system will also track the status of each inventory item (e.g., in use, available, under maintenance).
        - The system will also include a section for viewing a detailed history of the device.
        - This page will use pagination, a search function, and filters to help manage large amounts of inventory data.
        - The system will also include a section for generating reports on inventory items.
    */

?>

<h1 class="text-center mb-2">OTP Inventory</h1>

<div class="d-flex justify-content-center mt-4 align-items-center flex-column gap-2">
    <h5>Inventory Type Selector</h5>
    <div id="inventory_top_bar" class="d-flex justify-content-center align-items-center text-center gap-4">
        <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Standard Cables" id="std_cables" class="type_btn btn btn-secondary rounded-circle active"><i class='bx bx-connector'></i></button>
        <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Special Cables" id="special_cables" class="type_btn btn btn-secondary rounded-circle"><i class='bx bx-hdmi'></i></button>
        <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Devices" id="devices" class="type_btn btn btn-secondary rounded-circle"><i class='bx bx-hard-drive'></i></button>
        <button class="btn btn-primary" id="add_inventory_btn" data-bs-toggle="modal" data-bs-target="#add_inventory_modal">Add Item</button>
    </div>
    <div id="inventory_table_container" class="w-100 mt-4">
        <?php include("../inventory/load_inventory_std_cables.php") ?>
    </div>
</div>

<div class="modal fade" id="add_item_modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div id="add_item_modal_body" class="modal-body d-flex flex-column">
        <form>
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" required>
            </div>
            <div class="mb-3">
                <label for="item_type" class="form-label">Item Type</label>
                <select class="form-select" id="item_type_select" required>
                    <option value="" disabled selected>Select Item Type</option>
                    <option value="std_cable">Standard Cable</option>
                    <option value="special_cable">Special Cable</option>
                    <option value="device">Device</option>
                </select>
            </div>
            <div id="additional_fields"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>