// navbar scrolling effect
jQuery(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
// // hamburger menu open and close
// let openMenu = document.getElementById('open_menu');
// let closeMenu = document.querySelector('.closebtn');
// function openNav() {
//   document.getElementById("mySidenav").style.width = "400px";
// }
// function closeNav() {
// 	console.log("c");
//   document.getElementById("mySidenav").style.width = "0";
// }
// openMenu.addEventListener('click', openNav);
// closeMenu.addEventListener('click', closeNav);
// // document.html.addEventListener("click", closeNav);
// // jQuery('html').on('click', function(){
// //    console.log('click');
// // })

        jQuery(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
  




						
   