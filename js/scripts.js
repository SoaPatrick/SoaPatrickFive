window.onload = function(){ 
	
	// Scroll to Top
	document.getElementById('scroll-to-top').onclick = function () {
		scrollTo(0, 1000);
	};	
	
	// Responsive Videos
	(function (window, document, undefined) {
	
	    //Grab all iframes on the page or return
	    var iframes = document.getElementsByTagName('iframe');
	
	    // Loop through the iframes array
	    for (var i = 0; i < iframes.length; i++) {
	        var iframe = iframes[i],
	
	        // RegExp, extend this if you need more players
	                players = /www.youtube.com|player.vimeo.com/;
	
	        // If the RegExp pattern exists within the current iframe
	        if (iframe.src.search(players) > 0) {
	
	            // Calculate the video ratio based on the iframe's w/h dimensions
	            var videoRatio = ( iframe.height / iframe.width ) * 100;
	
	            // Replace the iframe's dimensions and position
	            // the iframe absolute, this is the trick to emulate
	            // the video ratio
	            iframe.style.position = 'absolute';
	            iframe.style.top = '0';
	            iframe.style.left = '0';
	            iframe.width = '100%';
	            iframe.height = '100%';
	
	            // Wrap the iframe in a new <div> which uses a
	            // dynamically fetched padding-top property based
	            // on the video's w/h dimensions
	            var wrap = document.createElement('div');
	            wrap.className = 'fluid-vids';
	            wrap.style.width = '100%';
	            wrap.style.position = 'relative';
	            wrap.style.paddingTop = videoRatio + '%';
	
	            // Add the iframe inside our newly created <div>
	            var iframeParent = iframe.parentNode;
	            iframeParent.insertBefore(wrap, iframe);
	            wrap.appendChild(iframe);
	        }
	    }
	
	})(window, document);
	
	// open/close search
	document.getElementById('toggle-search-collapse').onclick = function() {
	    document.getElementById('search-collapse').classList.toggle('open');
	    document.getElementById('search-collapse--input').focus();
		document.getElementById('search-collapse--input').value = "";	    
	};	
};


// c = element to scroll to or top position in pixels
// e = duration of the scroll in ms, time scrolling
// d = (optative) ease function. Default easeOutCuaic
function scrollTo(c,e,d){d||(d=easeOutCuaic);var a=document.documentElement;if(0===a.scrollTop){var b=a.scrollTop;++a.scrollTop;a=b+1===a.scrollTop--?a:document.body}b=a.scrollTop;0>=e||("object"===typeof b&&(b=b.offsetTop),"object"===typeof c&&(c=c.offsetTop),function(a,b,c,f,d,e,h){function g(){0>f||1<f||0>=d?a.scrollTop=c:(a.scrollTop=b-(b-c)*h(f),f+=d*e,setTimeout(g,e))}g()}(a,b,c,0,1/e,20,d))};
function easeOutCuaic(t){
    t--;
    return t*t*t+1;
}