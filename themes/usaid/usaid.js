$(function () {
    introJs().start();
    if ($('li.ccm-toolbar-page-edit-mode-active').length) return
    if (!$('#context img').length) return

    $('<div id="panel"><div>').appendTo('main')
    $('main').css('position', 'relative').append('<div class="pullout"><a class="pullout-tab" href="#panel"></a></div>');
    $('.pullout-tab').panelslider().click(function() { $('#panel').show() })
    $("#context img").appendTo('#panel')
    $('#panel').on('psClose', function(e) {
        $('#panel').hide()
    })

    /*
    setTimeout(function () {
        $('.pullout-tab').click()
        setTimeout(function () {
            $.panelslider.close()
        }, 1000)
    }, 1000);
    */
});