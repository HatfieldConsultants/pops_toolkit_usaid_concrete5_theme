$(function () {
  introJs().start()
  displayContextModal()
  wordExport()
});

function wordExport() {
  $('#word').detach().insertBefore('.page-title').fadeIn();
  $('#word').click(function() {
    compiling = $('<p class="alert alert-warning">Compiling content... this make take some time</p>')
    $('.page-title').after(compiling)
    html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><style>body { font-family: Arial; } p { font-family: Arial; } div.ccm-page h1 { font-size: 14px; color: #ba0c2f;  }</style></head><body>'
    calls = []
    path = window.location.pathname.split('/')[2]

    $.get('/index.php/site-map', function(data) {
      $(data).find('main ul.nav > li > a[href*=' + path + ']').parent().find('a').each(function(i,e) { 
        calls.push($.get($(e).attr('href')))
      })

      $.when(...calls).done(function() {
        for (var i = 0; i < arguments.length; i++) {
          dom = $(arguments[i][0]).find('main').clone()
          dom.find('.col-sidebar').remove()
          html += dom.html()
        }
        html += '</body></html>'
          
        converted = htmlDocx.asBlob(html)
        saveAs(converted, path + '.docx')
        compiling.remove()
      })
    })
  })
}

//// displayContext is a working function that uses a slide-drawer effect to show content
//// to the right side of the main page content.
//function displayContext() {
//  if ($('li.ccm-toolbar-page-edit-mode-active').length) return
//  if (!$('#context img').length) return

//  $('<div id="panel"><div>').appendTo('main')
//  $('main').css('position', 'relative').append('<div class="pullout"><a class="pullout-tab" href="#panel"></a></div>');
//  $('.pullout-tab').panelslider().click(function() { $('#panel').show() })
//  $("#context img").appendTo('#panel')
//  $('#panel').on('psClose', function(e) {
//      $('#panel').hide()
//  })
//}

//// displayContextModal adds a button on the right-hand-side to show the progress/context diagram in a modal dialog.
function displayContextModal() {
    if ($('li.ccm-toolbar-page-edit-mode-active').length) return

    var $content = $('#context img')
    if (!$content.length) return

    // Modal block
    $('<div id="contextModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contextLabel">' + 
        '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
                '<div class="modal-header">' +
                    '<button type="button" class="close" data-dismiss="modal" ' +
                        'aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<h4 class="modal-title" id="contextLabel"></h4>' +
                '</div><!-- .modal-header -->' +
                '<div class="modal-body"></div>' +
            '</div><!-- .modal-content -->' +
        '</div><!-- .modal-dialog -->' +
       '</div><!-- .modal #contextModal -->').appendTo('body')
    $('main').css('position', 'relative').
        append('<div class="pullout"><a class="pullout-tab" data-toggle="modal" data-target="#contextModal"></a></div>')
    $content.appendTo('#contextModal div .modal-body');
}