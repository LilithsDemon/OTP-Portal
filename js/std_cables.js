$(document).ready(function() {
    function UpdateQty($item_id, $value) {
        $.ajax({
            url: './php/inventory/change_qty.php',
            type: 'POST',
            data: { item_id: $item_id, value: $value },
            success: function(response) {
                $(`#${$item_id}_qty`).text(response);
            },
            error: function(response) {
                Swal.fire({
                    title: "Quantity Update Failed",
                    text: response.responseText,
                    icon: "error",
                    heightAuto: false,
                });
            }
        });
    }

    $('#std_cables_table').on('click', '.increase_qty_btn', function() {
        $item_id = $(this).parent().attr('id');
        UpdateQty($item_id, 1);
    });
    
    $('#std_cables_table').on('click', '.decrease_qty_btn', function() {
        $item_id = $(this).parent().attr('id');
        UpdateQty($item_id, -1);
    });
});