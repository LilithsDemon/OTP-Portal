$(document).ready(function() {
    var $inventoryTypes = $('.type_btn');
    $("#inventory_top_bar").on("click", '.type_btn', function() {
        if ($inventoryTypes.length) {
            $inventoryTypes.removeClass('active');
            $(this).addClass('active');
        }
        switch($(this).attr('id')) {
            case 'std_cables':
                $('#inventory_table_container').load("./php/inventory/load_inventory_std_cables.php");
                break;
            case 'special_cables':
                $('#inventory_table_container').load("./php/inventory/load_inventory_special_cables.php");
                break;
            case 'devices':
                $('#inventory_table_container').load("./php/inventory/load_inventory_devices.php");
                break;
        }
    });
});