$(document).ready(function() {
    function LoadNotes($item_id) {
        $.ajax({
            url: './php/inventory/get_item_notes.php',
            type: 'POST',
            data: { item_id: $item_id, type: 1 },
            success: function(response) {
                $('#notes_modal').modal('show');
                $('#notes_modal_body').html(response);
            },
            error: function(response) {
                Swal.fire({
                    title: "Load Notes Failed",
                    text: response.responseText,
                    icon: "error",
                    heightAuto: false,
                });
            }
        });
    };

    function LoadHistory($item_id) {
        $.ajax({
            url: './php/inventory/get_item_history.php',
            type: 'POST',
            data: { item_id: $item_id, type: 1 },
            success: function(response) {
                $('#history_modal').modal('show');
                $('#history_modal_body').html(response);
            },
            error: function(response) {
                Swal.fire({
                    title: "Load History Failed",
                    text: response.responseText,
                    icon: "error",
                    heightAuto: false,
                });
            }
        });
    };

    $('#special_cables_table').on('click', '.notes_btn', function() {
        $item_id = $(this).parent().attr('id');
        LoadNotes($item_id);
    });

    $('#special_cables_table').on('click', '.history_btn', function() {
        $item_id = $(this).parent().attr('id');
        LoadHistory($item_id);
    });

});