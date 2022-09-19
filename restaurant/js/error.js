// count up to 404
$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },
  {
    duration: 1300,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }
  }); 
});
 		// ---------------------------------------------- //
    // Loader
    // ---------------------------------------------- //
		jQuery(window).on('load', function() {
				$(".loader").fadeOut("slow");
		});

		//	remove error message
	  jQuery.event.special.touchstart = 
    {
      setup: function( _, ns, handle )
      {
        if ( ns.includes("noPreventDefault") ) 
        {
          this.addEventListener("touchstart", handle, { passive: false });
        } 
        else 
        {
          this.addEventListener("touchstart", handle, { passive: true });
        }
      }
    };	
