window.onload = function(){ 
	
	// open/close search
	document.getElementById('toggle-search-collapse').onclick = function() {
	    document.getElementById('search-collapse').classList.toggle('open');
	    document.getElementById('search-collapse--input').focus();
		document.getElementById('search-collapse--input').value = "";	    
	};	
};