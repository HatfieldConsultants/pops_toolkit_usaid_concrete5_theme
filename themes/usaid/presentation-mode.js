// functions to display the POPsToolkit in a USAID- powerpoint template type setting
// reference: http://stackoverflow.com/a/23971798/691965
// reference: https://github.com/Leaflet/Leaflet.fullscreen/blob/gh-pages/dist/Leaflet.fullscreen.js
// future option: getTextWidth() to scale text dynamically (like PPT does). https://gist.github.com/andrewbranch/6995056 ; http://stackoverflow.com/a/17001725/691965
$(document).ready(function(){
	$(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange', _onFullscreenChange);
	
	$(document).on('keydown', _onKeypress); // must be keydown event (and not 'keypress') to capture arrow keys.
	// $(document).on('click', _gotoNextSlide);
	
	$('.popstoolkit-presentationmode-button').click(function(){
		_toggleFullscreen();
	});
	
});

var _isFullscreen = false;
var _usePseudoFullscreen = false;

function isFullscreen () {
	return (document.fullScreenElement && document.fullScreenElement !== null)
         || document.mozFullScreen
         || document.webkitIsFullScreen;
}

function _onKeypress(e) {
	if (!isFullscreen())
		return;
	e = e || window.event;

    if (e.keyCode == '38') {
        // up arrow
		_gotoPrevSlide(); 
    }
    else if (e.keyCode == '40') {
        // down arrow
		_gotoNextSlide();
    }
    else if (e.keyCode == '37') {
       // left arrow
	   _gotoPrevSlide();
    }
    else if (e.keyCode == '39') {
       // right arrow
	   _gotoNextSlide();
    }
	else if (e.keyCode == '32') {
       // spacebar
	   _gotoNextSlide();
    }
}

function _gotoNextSlide(){
	if (!isFullscreen())
		return;
	var url = _getNextPageUrl();
	_loadNextPrevSlide(url);
	
}

function _loadNextPrevSlide(url){
	// note: simply setting 'window.location = url;' will not work - we will exit fullscreen mode. So we need to use Ajax...
	if (url != '')
	{
		// load a page fragement
		// note: do not use $('main').load() (http://api.jquery.com/load/) as it set's the innerHTML, so we end up with a child 'main' element (ie <main> <main></main> </main>) which isn't what we want. So let's use replaceWith
		jQuery.ajax( {
			url: url,
			type: "GET",
			dataType: "html"
		} )
		.done( function( responseText ) {
			// If a selector was specified, locate the right elements in a dummy div
			// Exclude scripts to avoid IE 'Permission Denied' errors
			var newMain = jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( 'main' ).contents();
			$('main').html(newMain); 
		})
		.error(function (xhr, status, errorText) {
			alert('error loading '+url+': '+status+'; '+errorText);
		});
		

	}
}


function _gotoPrevSlide(){
	if (!isFullscreen())
		return;
	var url = _getPrevPageUrl();
	_loadNextPrevSlide(url);
}

function _getNextPageUrl(){
		
	var selLI = $('.popstoolkit-nav .nav-selected');
	var ret = selLI.next();
	if (typeof ret != 'undefined')
	{
		var url = $(ret).find('a').attr("href")
		return url;
	}
	return '';
}

function _getPrevPageUrl(){
		
	var selLI = $('.popstoolkit-nav .nav-selected');
	var ret = selLI.prev();
	if (typeof ret != 'undefined')
	{
		var url = $(ret).find('a').attr("href")
		return url;
	}
	return '';
}


function _toggleFullscreen()
{
	var container = getContainer();
	if (isFullscreen()) {
		if (_usePseudoFullscreen) {
			_disablePseudoFullscreen(container);
		} else if (document.exitFullscreen) {
			document.exitFullscreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			document.webkitCancelFullScreen();
		} else if (document.msExitFullscreen) {
			document.msExitFullscreen();
		} else {
			_disablePseudoFullscreen(container);
		}
	} else {
		/*
		$('main').on('click', '.dynamicNextSlideLink', function(e) {
			e.preventDefault()

			// alert('clicked next');
			var url = _getNextPageUrl();
			if (url != '')
				window.location = url;
		});
		$('<a />', {
			'href': '#',			
			'class': 'dynamicNextSlideLink',
			'text': 'Next Slide'
		}).appendTo('main');
		*/
		if (_usePseudoFullscreen) {
			_enablePseudoFullscreen(container);
		} else if (container.requestFullscreen) {
			container.requestFullscreen();
		} else if (container.mozRequestFullScreen) {
			container.mozRequestFullScreen();
		} else if (container.webkitRequestFullscreen) {
			container.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
		} else if (container.msRequestFullscreen) {
			container.msRequestFullscreen();
		} else {
			_enablePseudoFullscreen(container);
		}
	}
} // toggleFullScreen
function _enablePseudoFullscreen (container) {
	$(container).addClass('popstoolkit-pseudo-fullscreen');
	_setFullscreen(true);
	$(document.documentElement).trigger('fullscreenchange');
}

function _disablePseudoFullscreen (container) {
	$(container).removeClass('popstoolkit-pseudo-fullscreen');
	_setFullscreen(false);
	$(document.documentElement).trigger('fullscreenchange');
}

function _setFullscreen(fullscreen) {
	_isFullscreen = fullscreen;
	var container = getContainer();
	if (fullscreen) {
		$(container).addClass('popstoolkit-fullscreen-on');
	} else {
		$(container).removeClass('popstoolkit-fullscreen-on');
	}
	// 	.invalidateSize();
}

function _onFullscreenChange(e){
	var el = document;
	var fullscreenElement =
		el.fullscreenElement ||
		el.mozFullScreenElement ||
		el.webkitFullscreenElement ||
		el.msFullscreenElement;

	if (fullscreenElement === getContainer() && !_isFullscreen) {
		_setFullscreen(true);
		$('.popstoolkit-presentationmode-button').text('Exit Presentation Mode');
		$(window).trigger('fullscreenchange');
	} else if (fullscreenElement !== getContainer() && _isFullscreen) {
		_setFullscreen(false);
		$('.popstoolkit-presentationmode-button').text('Presentation Mode');
		$(document.documentElement).trigger('fullscreenchange');
	}
}

function getContainer(){
	return $('main').first()[0] || document.documentElement;
}
