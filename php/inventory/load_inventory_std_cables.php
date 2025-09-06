<?php
    function LoadTable()
    {
        include_once("/var/www/html/php/include/_execute.php");

        // First part will get all of the devices ItemID ready for getting data

        $get_cables_sql = "SELECT `StdCable`.`ItemID`, `Items`.`ItemName`, `StdCable`.`Quantity` FROM `StdCable` LEFT JOIN `Items` ON `StdCable`.`ItemID` = `Items`.`ItemID`; ";
        $cables_db_data = ExecuteCommandNoParams($get_cables_sql);
        
        while($cable = mysqli_fetch_assoc($cables_db_data))
        {
            // Here we will output the data into a table row
            echo "<tr>";
            echo "<td>" . $cable['ItemID'] . "</td>";
            echo "<td>" . $cable['ItemName'] . "</td>";
            echo "<td id='" . $cable['ItemID'] . "_qty'>" . $cable['Quantity'] . "</td>";
            echo "<td id='" . $cable['ItemID'] . "'><button class='decrease_qty_btn btn btn-primary btn-sm'><i class='bx bx-minus'></i> </button> <button class='increase_qty_btn btn btn-primary btn-sm'><i class='bx bx-plus'></i></button></td>";
            echo "<td id='" . $cable['ItemID'] . "'><button class='edit_std_cable_btn btn btn-primary btn-sm'><i class='bx bx-edit'></i></button></td>";
            echo "</tr>";
        }
    }

?>

<script src="./js/std_cables.js"></script>

<table id="std_cables_table" class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Cable ID</th>
            <th scope="col">Cable Type</th>
            <th scope="col">Quantity</th>
            <th scope="col">Change Current Quantity</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php LoadTable(); ?>
    </tbody>
</table>