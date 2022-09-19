// ---------------------------------------------- //
    // Toggle menu icon mobile view - bar change
    // ---------------------------------------------- //
		function myFunction(x) {
		  x.classList.toggle("change");
		}
// ---------------------------------------------- //
    // Go to top button
    // ---------------------------------------------- //
		//Get the button:
		mybutton = document.querySelector(".myBtn");
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};
		function scrollFunction() {
			if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
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
// ---------------------------------------------- //
    // front-page.php
    // ---------------------------------------------- //
//click tab to open category product
//function openCity(evt, productName) {
//  var i, tabcontent, tablinks;
//  tabcontent = document.getElementsByClassName("tabcontent");
//  for (i = 0; i < tabcontent.length; i++) {
//    tabcontent[i].style.display = "none";
//  }
//  tablinks = document.getElementsByClassName("tablinks");
//  for (i = 0; i < tablinks.length; i++) {
//    tablinks[i].className = tablinks[i].className.replace(" active", "");
//  }
//  document.getElementById(productName).style.display = "block";
//  evt.currentTarget.className += " active";
//}
//// Get the element with id="defaultOpen" and click on it
//document.getElementById("defaultOpen").click();	
		// ---------------------------------------------- //
    // front-page.php slider
    // ---------------------------------------------- //


 jQuery(function($) {
    $("input[name$='cars']").click(function() {
        var test = $(this).val();
        $("div.desc").hide();
        $("#Cars" + test).show();
    });
});