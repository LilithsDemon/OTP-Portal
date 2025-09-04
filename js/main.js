$(document).ready(function() {
    // Initialize Bootstrap tooltips for any element in the body with data-bs-toggle="tooltip"
    $('body').tooltip({
        selector: '[data-bs-toggle="tooltip"]',
        trigger: 'hover'
    });
});
