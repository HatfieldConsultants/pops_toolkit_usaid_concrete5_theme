$(function () {
  introJs().start()
  wordExport()
  var loc = window.location; 
  var imagesListFile = loc.protocol + '//' + loc.host + "/packages/usaid/themes/usaid/context_images.json.txt"
  var jqxhr = $.getJSON(imagesListFile, function( data ) {
      displayContextModal(data["contextImages"]["pathImage"])
  })
    .fail(function() {
        console.log("Could not find/load " + imagesListFile)
    })
  //displayContextModal()
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

// displayContextModal adds a button on the right-hand-side to show the progress/context diagram in a modal dialog.
function displayContextModal(imagePathArr) {
    if ($('li.ccm-toolbar-page-edit-mode-active').length) return

    var content;

    // Load the progress/context image for certain URLs.
    var pathImages = imagePathArr;
    var len;
    var loc = window.location;
    var i;
    var pathCheck;
    var regex;
    var isFound;
    var imgPath;
    var $img;

    // Loop to check all elements of array to see if it is a matching URL path.
    len = pathImages.length;
    for (i = 0; i < len; i += 1){
        pathCheck = pathImages[i];
        regex = new RegExp(pathCheck.pathContains, 'i');
        isFound = regex.test(loc.pathname);
        if (isFound){ break; }
    } // end check for URL path that requires popover image.
    
    // Add the modal block and popover button.
    if (isFound){
        imgPath = loc.protocol + '//' + loc.host + pathCheck.imgPath;
        $img = $('<img src="'+ imgPath +'" />');
        content = $img;
    
        // Modal block
        var $modal = $('<div id="contextModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contextLabel">' + 
            '<div class="modal-dialog" role="document">' +
                '<div class="modal-content">' +
                    '<div class="modal-header">' +
                        '<button type="button" class="close" data-dismiss="modal" ' +
                            'aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<h4 class="modal-title" id="contextLabel"></h4>' +
                    '</div><!-- .modal-header -->' +
                    '<div class="modal-body">' + 
                    // content goes in here...
                    '</div>' + 
                '</div><!-- .modal-content -->' +
            '</div><!-- .modal-dialog -->' +
           '</div><!-- .modal #contextModal -->');
        $modal.find('.modal-body').append(content);
        $modal.appendTo('body');
        $('main').css('position', 'relative').
            append('<div class="pullout"><a class="pullout-tab" data-toggle="modal" data-target="#contextModal"></a></div>')
    } // end if adding modal popover and 'show' button.
}