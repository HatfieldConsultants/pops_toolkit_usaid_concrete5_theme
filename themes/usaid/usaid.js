$(function () {
  introJs().start()
  displayContext()
  wordExport()
});

function wordExport() {
  $('#word').detach().insertBefore('.page-title').fadeIn();
  $('#word').click(function() {
    compiling = $('<p>Compiling content... this make take some time</p>')
    $('.page-title').after(compiling)
    html = ''
    calls = []
    path = window.location.pathname.split('/')[2]

    $.get('/index.php/site-map', function(data) {
      $(data).find('main ul.nav > li > a[href*=' + path + ']').parent().find('a').each(function(i,e) { 
        calls.push($.get($(e).attr('href'), function(data) {
          html += $(data).find('main').html() 
        }))
      })

      $.when(...calls).then(function() {
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

  /*
  setTimeout(function () {
      $('.pullout-tab').click()
      setTimeout(function () {
          $.panelslider.close()
      }, 1000)
  }, 1000);
  */
}
