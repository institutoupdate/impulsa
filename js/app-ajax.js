

(function($) {
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

	var _fetch = debounce(function(node) {
	  var val = node.val();
	  if(val.length && val.length > 3) {
	      $('#datafetch').slideDown();
	      $.ajax({
	          type: "POST",
	          url: config.ajax_url,
	          data: { action: 'data_fetch', s: val },
	          success: function(data) {
	              $('#datafetch').html( data );
	          }
	      });
	  } else {
	      $('#datafetch').slideUp();
	  }
	}, 300);

	window.fetch = function(){
	    $('body').on('input', "#keyword", function() {
				console.log(this);
	        _fetch($(this));
	    });
	}
})(jQuery);
