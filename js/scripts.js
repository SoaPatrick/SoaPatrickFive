window.onload = function(){ 
	
	// open/close search
	document.getElementById('toggle-search-collapse').onclick = function() {
    document.getElementById('search-collapse').classList.toggle('open');
    document.getElementById('search-collapse--input').focus();
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera    
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

var deadline = 'April 25 2019 20:00:00 GMT+0200';
initializeClock('clockdiv', deadline);
