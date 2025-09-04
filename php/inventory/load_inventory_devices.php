<?php

    function LoadTable()
    {
        include_once("/var/www/html/php/include/_connect.php");
        include_once("/var/www/html/php/include/_exec.php");
    }

?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Device ID</th>
            <th scope="col">Device Name</th>
            <th scope="col">In-Use</th>
            <th scope="col">Position</th>
            <th scope="col">History</th>
            <th scope="col">Notes</th>
        </tr>
        <tr>
            <td>A1DE</td>
            <td>Laptop A</td>
            <td>Yes</td>
            <td>Office</td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-history'></i> </button></td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-note-book'></i></button></td>
        </tr>
        <tr>
            <td>A1DE</td>
            <td>Laptop A</td>
            <td>Yes</td>
            <td>Office</td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-history'></i> </button></td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-note-book'></i></button></td>
        </tr>
        <tr>
            <td>A1DE</td>
            <td>Laptop A</td>
            <td>Yes</td>
            <td>Office</td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-history'></i> </button></td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-note-book'></i></button></td>
        </tr>
        <tr>
            <td>A1DE</td>
            <td>Laptop A</td>
            <td>Yes</td>
            <td>Office</td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-history'></i> </button></td>
            <td><button class="btn btn-primary btn-sm"><i class='bx bx-note-book'></i></button></td>
        </tr>
    </thead>
</table>