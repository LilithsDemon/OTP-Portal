$(document).ready(function() {
    function showNavbar(toggleId, navId, bodyId, headerId) {
        var $toggle = $('#' + toggleId),
            $nav = $('#' + navId),
            $bodypd = $('#' + bodyId),
            $headerpd = $('#' + headerId);

        // Validate that all variables exist
        if ($toggle.length && $nav.length && $bodypd.length && $headerpd.length) {
            $toggle.on('click', function() {
                // show navbar
                $nav.toggleClass('show');
                // change icon
                $toggle.toggleClass('bx-x');
                // add padding to body
                $bodypd.toggleClass('body-pd');
                // add padding to header
                $headerpd.toggleClass('body-pd');
            });
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

    /*===== LINK ACTIVE =====*/
    var $linkColor = $('.nav_link');

    function colorLink() {
        if ($linkColor.length) {
            $linkColor.removeClass('active');
            $(this).addClass('active');
        }
    }
    $linkColor.on('click', colorLink);

    // Your code to run since DOM is loaded and ready

    $('#dashboard').click(function(){
        $('main').load('./php/components/dashboard.php');
    });

    $('#card_reader').click(function(){
        $('main').load('./php/components/card_reader.php');
    });

    $('#checklists').click(function(){
        $('main').load('./php/components/checklists.php');
    });

    $('#inventory').click(function(){
        $('main').load('./php/components/inventory.php');
    });

    $('#documents').click(function(){
        $('main').load('./php/components/documents.php');
    });
});