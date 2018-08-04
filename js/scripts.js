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