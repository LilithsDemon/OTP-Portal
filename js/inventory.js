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

    $("main").on("change", '#item_type_select', function() {
        var $selectedType = $(this).val();
        var $additionalFieldsContainer = $('#additional_fields');

        $.ajax({
            url: './php/inventory/get_additional_fields.php',
            type: 'POST',
            data: { item_type: $selectedType },
            success: function(response) {
                $additionalFieldsContainer.html(response);
            },
            error: function(response) {
                Swal.fire({
                    title: "Load Required Fields Failed",
                    text: response.responseText,
                    icon: "error",
                    heightAuto: false,
                });
            }
        });
    });
});