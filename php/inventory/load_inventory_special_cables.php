<?php

    function LoadTable()
    {
        include_once("/var/www/html/php/include/_execute.php");

        // First part will get all of the devices ItemID ready for getting data

        $get_items_sql = "SELECT DISTINCT `ItemID` FROM `SpecialCable`;";
        $items_db_data = ExecuteCommandNoParams($get_items_sql);

        if($items_db_data !== false)
        {
            while($item = mysqli_fetch_assoc($items_db_data))
            {
                $item_id = $item['ItemID'];

                // Now we have the ItemID we can get all of the data for that item
                $get_all_item_data_sql = "SELECT `SpecialCable`.`ItemID`, `Items`.`ItemName`, `ItemType`.`TypeName`, `SpecialCable`.`CurrentUsage`, `Positions`.`PositionName`, `SpecialCable`.`DATETIME` FROM `SpecialCable`
                    LEFT JOIN `Positions` ON
                    `SpecialCable`.`PositionID` = `Positions`.`PositionID`
                    LEFT JOIN `Items` ON
                    `SpecialCable`.`ItemID` = `Items`.`ItemID`
                    LEFT JOIN `ItemType` ON
                    `Items`.`ItemType` = `ItemType`.`TypeID`
                     WHERE `SpecialCable`.`ItemID` = ? ORDER BY `SpecialCable`.`DATETIME` DESC LIMIT 1;";

                $item_data_db_data = ExecuteCommand($get_all_item_data_sql, "s", [$item_id]);

                if($item_data_db_data !== false)
                {
                    while($item_data = mysqli_fetch_assoc($item_data_db_data))
                    {
                        // Here we will output the data into a table row
                        echo "<tr>";
                        echo "<td>" . $item_data['ItemID'] . "</td>";
                        echo "<td>" . $item_data['ItemName'] . "</td>";
                        echo "<td>" . $item_data['TypeName'] . "</td>";
                        echo "<td>" . $item_data['CurrentUsage'] . "</td>";
                        echo "<td>" . $item_data['PositionName'] . "</td>";
                        echo "<td><button class='btn btn-primary btn-sm'><i class='bx bx-history'></i> </button></td>";
                        echo "<td><button class='btn btn-primary btn-sm'><i class='bx bx-note-book'></i></button></td>";
                        echo "</tr>";
                    }
                }
            }
        }



    }
?>



<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Cable ID</th>
            <th scope="col">Cable Name</th>
            <th scope="col">Cable Type</th>
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