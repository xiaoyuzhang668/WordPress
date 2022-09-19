// navbar scrolling effect godaddy
jQuery(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
// hamburger menu open and close
let openMenu = document.getElementById('openMenu');
let closeMenu = document.getElementById('closeMenu');
function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
}
function closeNav() {
	console.log("c");
  document.getElementById("mySidenav").style.width = "0";
}
openMenu.addEventListener('click', openNav);
closeMenu.addEventListener('click', closeNav);
// youtube video
jQuery(function(){
   jQuery("#bgndVideo").mb_YTPlayer();
});
// click to activate icon
jQuery( '.video-container' ).click(function(e){
  jQuery( '.video-container' ).removeClass("active"); // remove class from other tab
  jQuery(this).addClass("active"); // set class to current clicked tab
});
// carousel 
// $(document).ready(function(){ 
// 	$('.owl-carousel').owlCarousel({
//     loop:true,
//     animateOut: 'slideOutDown',
//     animateIn: 'flipInX',
//     smartSpeed:450,
//     margin:10,
//     slideSpeed:500,
//     dots:false,
//    	paginationSpeed:800,
//     rewindSpeed:1000,
// 	  autoPlay:true,
//     stopOnHover:false,
//   	items:1   
// })
// });
// sidebar video slider
$(document).ready(function() {
		if($('.sidebar-video').length)
		{
			var vidSlider = $('.sidebar-video');			
			vidSlider.owlCarousel(
			{
				items:1,
				loop:true,
				autoplay:false,
				smartSpeed:1200,
        rewindSpeed:1200,
        slideSpeed:1200,
				dots:true,
				dotsContainer:'.custom-dots-vid',				
			});		
			if($('.custom-pre-vid').length)
			{
				$('.custom-pre-vid').on('click', function()
				{
					vidSlider.trigger('prev.owl.carousel');
				});
			}
			if($('.custom-next-vid').length)
			{
				$('.custom-next-vid').on('click', function()
				{
					vidSlider.trigger('next.owl.carousel');
				});
			}
			/* Custom dots events */
			if($('.custom-dot-vid').length)
			{
				$('.custom-dot-vid').on('click', function(ev)
				{	
					var dot = $(ev.target);
					$('.custom-dot-vid').removeClass('active');
					dot.addClass('active');
					vidSlider.trigger('to.owl.carousel', [$(this).index(), 300]);
				});
			}
			/* Change active class for dots when slide changes by nav or touch */
			vidSlider.on('changed.owl.carousel', function(event)
			{
				$('.custom-dot-vid').removeClass('active');
				$('.custom-dots-vid i.fas').eq(event.page.index).addClass('active');
			});	
		}
	})
// sidebar event slider
$(document).ready(function() {
    if($('.sidebar-event').length)
    {
      var vidSlider = $('.sidebar-event');      
      vidSlider.owlCarousel(
      {
        items:1,
        loop:true,
        autoplay:false,
        smartSpeed:1200,
        rewindSpeed:1200,
        slideSpeed:1200,
        dots:true,
        dotsContainer:'.custom-dots-event',       
      });   
      if($('.custom-pre-event').length)
      {
        $('.custom-pre-event').on('click', function()
        {
          vidSlider.trigger('prev.owl.carousel');
        });
      }
      if($('.custom-next-event').length)
      {
        $('.custom-next-event').on('click', function()
        {
          vidSlider.trigger('next.owl.carousel');
        });
      }
      /* Custom dots events */
      if($('.custom-dot-event').length)
      {
        $('.custom-dot-event').on('click', function(ev)
        { 
          var dot = $(ev.target);
          $('.custom-dot-event').removeClass('active');
          dot.addClass('active');
          vidSlider.trigger('to.owl.carousel', [$(this).index(), 300]);
        });
      }
      /* Change active class for dots when slide changes by nav or touch */
      vidSlider.on('changed.owl.carousel', function(event)
      {
        $('.custom-dot-event').removeClass('active');
        $('.custom-dots-event i.fas').eq(event.page.index).addClass('active');
      }); 
    }
  })
// init Isotope
$(document).ready(function() {
var $grid = $('.grid').isotope({
   itemSelector: '.grid-item',
   percentPosition: true,
   checkLastPage: false,
   // status: '.page-load-status',
    horizontalOrder: true, 
   masonry: {
    columnWidth: '.grid-item',
   // horizontalOrder: true,
    // isAnimated: true,
    // isAnimatedFromBottom: true,
   }
});

var msnry = $grid.data('masonry');
// init Infinite Scroll
$grid.infiniteScroll({
  // Infinite Scroll options
    path: '.nextpostslink', 
    checkLastPage: false,
    status: '.page-load-status', 
    history: false,
    // outlayer: msnry,
    horizontalOrder: true, 
});
// append items on load
$grid.on( 'load.infiniteScroll', function( event, response, path ) {
  var $items = $( response ).find('.grid-item');
  // append items after images loaded
  $items.imagesLoaded( function() {
    $grid.append( $items );
    $grid.isotope( 'insert', $items );
  });
});
 $('.filters li').on( 'click', function() {
    $(".filters li").removeClass('filter-active');
    $(this).addClass('filter-active');
    $grid.isotope({ filter: $(this).data('filter') });
  });
})
// remove empty p tag
$('p:empty').remove();
// load more button
$(document).ready(function() {
	var $nextLink = $('.nextpostslink');
		if ( !$nextLink.length ) {
			$('.view-more-button').hide();
	}  
var $container = $('.category-container').infiniteScroll({
  path: '.nextpostslink',
  append: '.post',
  	hideNav: '.wp-pagenavi',
  // disable loading on scroll
  // loadOnScroll: false,
  button: '.view-more-button',
  status: '.page-load-status',
  scrollThreshold: false, 
});
// load next page & enable loading on scroll on button click
var $viewMoreButton = $('.view-more-button');

$viewMoreButton.on( 'click', function() {
  // load next page
  $container.infiniteScroll('loadNextPage');
  // enable loading on scroll
  $container.infiniteScroll( 'option', {
    loadOnScroll: true,
  });
  // hide button
  $viewMoreButton.show();
});
});

  jQuery(function(){
      jQuery("#videoPlay").YTPlayer();
    });


// data fancy box for light box
// jQuery('[data-fancybox="images"]').fancybox({
//   afterLoad : function(instance, current) {
//     var pixelRatio = window.devicePixelRatio || 1;

//     if ( pixelRatio > 1.5 ) {
//       current.width  = current.width  / pixelRatio;
//       current.height = current.height / pixelRatio;
//     }
//   }
 
// });

 // $(document).ready(function() {
 //    $(".fancybox").fancybox({
 //      openEffect: 'fade',
 //      closeEffect: 'fade',
 //      nextEffect: 'none',
 //      prevEffect: 'none',
 //      helpers: { 
 //        buttons: {
 //          position: 'top'
 //        },
 //        title: {
 //          type: 'float'
 //        }
 //      }
 //    });
 //  });
// $(document).ready(function() {
//  lightbox.option({
//       // 'resizeDuration': 200,
//       // 'wrapAround': true, 
//       // 'fadeDuration': 600, 
//       // 'fitImagesInViewport': true, 
//       // 'imageFadeDuration': 600, 
//     })
//   });

//Get the button:
mybutton = document.querySelector(".myBtn");
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
// add placeholder text
 // document.getElementById("author").placeholder = "Your name";
 // document.getElementById("email").placeholder = "Your email";

// fancybox
$(document).ready(function() {
    $(".fancybox").fancybox({
        transitionEffect: "fade",
        animationEffect: "fade",
        toolbar: "true",
        titlePosition: "inside",
        speedIn: 1000,
        speedOut: 600,
        buttons: [
                "zoom",
                "share",
                "slideShow",
                //"fullScreen",
                "download",
                "thumbs",
                "close"
              ],   
      afterLoad: function() {
        console.log('open');
        $('.fancybox-image').css('padding', '12px');
        $('.fancybox-image').css('background-color', 'red');
        $('.fancybox-image').css('border-radius', '6px');
      },
      beforeClose: function() {
          console.log('close');
          $('.fancybox-image').css('padding', '');
      },
      idleTime: false,
      infobar: false,
      beforeShow: function() {
          $(".fancybox-caption").addClass('none');
      },
      afterShow: function() {
          $(".fancybox-caption").wrapInner("<span/>");
          var imageWidth = $(".fancybox-slide--current .fancybox-content").width();
          $(".fancybox-caption").css("width", imageWidth);
          setTimeout($(".fancybox-caption").removeClass('none'), 200);
      },
    })
});
//loader
jQuery(window).on('load', function() {
    $(".loader").fadeOut("slow");
});
jQuery.event.special.touchstart = {
  setup: function( _, ns, handle ){
    if ( ns.includes("noPreventDefault") ) {
      this.addEventListener("touchstart", handle, { passive: false });
    } else {
      this.addEventListener("touchstart", handle, { passive: true });
    }
  }
};