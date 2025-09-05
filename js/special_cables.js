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

    $('#special_cables_table').on('click', '.notes_btn', function() {
        $item_id = $(this).parent().attr('id');
        LoadNotes($item_id);
    });

});