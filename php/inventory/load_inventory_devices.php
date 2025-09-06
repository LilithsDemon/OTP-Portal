<?php

    function LoadTable()
    {
        include_once("/var/www/html/php/include/_execute.php");

        // First part will get all of the devices ItemID ready for getting data

        $get_items_sql = "SELECT DISTINCT `ItemID` FROM `Device`;";
        $items_db_data = ExecuteCommandNoParams($get_items_sql);

        if($items_db_data !== false)
        {
            while($item = mysqli_fetch_assoc($items_db_data))
            {
                $item_id = $item['ItemID'];

                // Now we have the ItemID we can get all of the data for that item
                $get_all_item_data_sql = "SELECT `Device`.`ItemID`, `DeviceSN`.`SN`, `Items`.`ItemName`, `ItemType`.`TypeName`, `Device`.`CurrentUsage`, `Positions`.`PositionName`, `Device`.`DATETIME` FROM `Device`
                    LEFT JOIN `DeviceSN` ON
                    `Device`.`ItemID` = `DeviceSN`.`ItemID`
                    LEFT JOIN `Positions` ON
                    `Device`.`PositionID` = `Positions`.`PositionID`
                    LEFT JOIN `Items` ON
                    `Device`.`ItemID` = `Items`.`ItemID`
                    LEFT JOIN `ItemType` ON
                    `Items`.`ItemType` = `ItemType`.`TypeID`
                    WHERE `Device`.`ItemID` = ? ORDER BY `Device`.`DATETIME` DESC LIMIT 1;";

                $item_data_db_data = ExecuteCommand($get_all_item_data_sql, "s", [$item_id]);

                if($item_data_db_data !== false)
                {
                    while($item_data = mysqli_fetch_assoc($item_data_db_data))
                    {
                        // Here we will output the data into a table row
                        echo "<tr>";
                        echo "<td>" . $item_data['ItemID'] . "</td>";
                        echo "<td>" . $item_data['SN'] . "</td>";
                        echo "<td>" . $item_data['ItemName'] . "</td>";
                        echo "<td>" . $item_data['TypeName'] . "</td>";
                        echo "<td>" . $item_data['CurrentUsage'] . "</td>";
                        echo "<td>" . $item_data['PositionName'] . "</td>";
                        echo "<td id='" . $item_data['ItemID'] . "'><button class='history_btn btn btn-primary btn-sm'><i class='bx bx-history'></i> </button></td>";
                        echo "<td id='" . $item_data['ItemID'] . "'><button class='notes_btn btn btn-primary btn-sm'><i class='bx bx-note-book'></i></button></td>";
                        echo "</tr>";
                    }
                }
            }
        }



    }
?>

<script src="./js/devices.js"></script>

<table id="devices_table" class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Device ID</th>
            <th scope="col">Serial Number</th>
            <th scope="col">Device Name</th>
            <th scope="col">Device Type</th>
            <th scope="col">Status</th>
            <th scope="col">Position</th>
            <th scope="col">History</th>
            <th scope="col">Notes</th>
        </tr>
    </thead>
    <tbody>
        <?php LoadTable(); ?>
    </tbody>
</table>

<div class="modal fade" id="notes_modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div id="notes_modal_body" class="modal-body d-flex flex-column">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="history_modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div id="history_modal_body" class="modal-body d-flex flex-column">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>