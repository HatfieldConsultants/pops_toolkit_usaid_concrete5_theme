$(function () {
  introJs().start()
  displayContext()
  wordExport()
});

function wordExport() {
  $('#word').detach().insertBefore('.page-title').fadeIn();
  $('#word').click(function() {
    compiling = $('<p class="alert alert-warning">Compiling content... this make take some time</p>')
    $('.page-title').after(compiling)
    html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"></head><body>'
    calls = []
    path = window.location.pathname.split('/')[2]

    $.get('/index.php/site-map', function(data) {
      $(data).find('main ul.nav > li > a[href*=' + path + ']').parent().find('a').each(function(i,e) { 
        calls.push($.get($(e).attr('href')))
      })

      $.when(...calls).done(function() {
        for (var i = 0; i < arguments.length; i++) {
          dom = $(arguments[i][0]).find('main').clone()
          dom.find('.nav').remove()
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

function displayContext() {
  if ($('li.ccm-toolbar-page-edit-mode-active').length) return
  if (!$('#context img').length) return

  $('<div id="panel"><div>').appendTo('main')
  $('main').css('position', 'relative').append('<div class="pullout"><a class="pullout-tab" href="#panel"></a></div>');
  $('.pullout-tab').panelslider().click(function() { $('#panel').show() })
  $("#context img").appendTo('#panel')
  $('#panel').on('psClose', function(e) {
      $('#panel').hide()
  })
}
