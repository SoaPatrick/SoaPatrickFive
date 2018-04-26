window.onload = function(){ 
	
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

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = ('0' + t.days).slice(-2);
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      document.getElementById("clockdiv").innerText = "Avengers Infinity War Starts Now";
    }  
    
    if (t.days <= 0) {
      document.getElementById("clock-days").innerText = "";
    }           
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline = 'April 27 2018 19:30:00 GMT+0200';
initializeClock('clockdiv', deadline);