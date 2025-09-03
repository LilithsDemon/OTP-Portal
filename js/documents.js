$(document).ready(function() {
    $("main").on("click", '.load_doc_btn', function() {
        $("#doc_modal").attr("src", $(this).data("pdf-path"));
        console.log($(this).data("pdf-path"));
        console.log("Button clicked"); 
    });
});