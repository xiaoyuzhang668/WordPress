<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<hr class="style8">
<footer>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9 bg-light order-md-1 order-2 p-5">
        <div class="text-center">
					<h4 class="text-uppercase"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h4>
          <div class="mt-3 d-flex justify-content-center">
            <ul class="list-group list-group-horizontal">  
              <li class="weixin"><a target="_blank" href="http://www.wechat.com"><i class="fab fa-weixin mr-5"></i></a></li> 
              <li class="linkedin"><a target="_blank" href="https://www.linkedin.com"><i class="fab fa-linkedin-in mr-5"></i></a></li>                
							<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f mr-5"></i></a></li>
							<li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fab fa-youtube mr-5"></i></a></li>
              <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
            </ul>
          </div>
          <div class="pt-5 copyright text-dark-50"> 
            Copyright <?php echo wpb_copyright(); ?><a class="px-lg-5 px-2" href="<?php bloginfo('url'); ?>"> <?php bloginfo('name'); ?></a> All rights reserved. 
          </div> 
        </div>
      </div>         
      <div class="col-md-3 order-md-2 order-1 pt-5 bg-secondary">       
            <h6 class="text-white text-center text-lg-left">Subscribe</h6>
            <div class="mt-4"><?php echo do_shortcode('[contact-form-7 id="518" title="Subscribe Form" html_name="subscribeForm" html_id="subscribeForm"]'); ?> </div>
      </div>    
    </div>
	</div><!-- container -->
</footer>
<?php wp_footer(); ?>
 <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> 
	<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/bootstrap.js'></script> 
	<!--	internal javascript-->
	<script>
		AOS.init();
		new WOW().init();
		moment().format();
		$(document).ready(function () {
			$('#gallery').owlCarousel({
				loop:true,
				margin:0,
				smartSpeed: 1500,		
				autoplay:true,
				autoplayHoverPause:true,
				nav: false,
				navText: ['', ''],
				responsive:{
						0:{
								items:2
						},
						768:{
								items:4
						},
						992:{
								items:6
						}
				}
			});
	});
	$("input#txtUsername").focus(function() {
  	$(this).siblings(".registration-error").hide()
		});
	$("input#txtEmail").focus(function() {
  	$(this).siblings(".registration-error").hide()
		});
	// ---------------------------------------------- //
    // Loader
    // ---------------------------------------------- //
		jQuery(window).on('load', function() {
				$(".loader").fadeOut("slow");
		});
		
$(document).ready(function() {
jQuery.validator.addMethod("customemail", function(value, element) {
return /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i.test(value);
	}, "Sorry, I've enabled very strict email validation"
);
jQuery.validator.addMethod("uppercase", function (value, element) {
    return this.optional(element) || /[A-Z]/.test(value);
}, "Please enter at least one Capital letter");
jQuery.validator.addMethod("lowserCase", function (value, element) {
    return this.optional(element) || /[a-z]/.test(value);
}, "Please enter atleast one Small letter");
jQuery.validator.addMethod("Digit", function (value, element) {
    return this.optional(element) || /[0-9]/.test(value);
}, "Please enter at least one Number");
jQuery.validator.addMethod("Special_char", function (value, element) {
    return this.optional(element) || /[{}|~`"'[\]$&+,:;=?@#|'<>.^*()%!-]/.test(value);
}, "Please enter at least one Special Character");
jQuery.validator.addMethod("usernameExt", function(value, element, param) {
    return value.match(/^[A-Za-z]\w*$/);
},'Username should not begin with a number.');	
jQuery.validator.addMethod("noSpace", function(value, element) { 
  	return value.indexOf(" ") < 0 && value != ""; 
}, "Username should not contain space.");
jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Letters, numbers, and underscores only please.");

 $('#registrationForm').validate({ 
    // onfocusout: function(element) {
    //   this.element(element);
// },
rules: {
  txtUsername: {
    required: true,
    minlength: 2,
		noSpace: true,
		alphanumeric: true,
		usernameExt: true,			
    normalizer: function(value) { return $.trim(value); }
  }, 
  txtEmail: {
    required: true,
		noSpace: true,
	  email: true        
  }, 
	txtAddress: {
    required: true,
	  normalizer: function(value) { return $.trim(value); }      
  }, 
	txtCity: {
    required: true,
	  normalizer: function(value) { return $.trim(value); }      
  },
	txtCountry: {
    required: true
  },
	txtPostalcode: {
    required: true
  },
	txtPhone: {
    required: true, 
		digits: true
  },
  txtPassword: {
    required: true,
    minlength: 10,
    normalizer: function(value) { return $.trim(value); }
  },
	txtConfPassword: {
    required: true,
    minlength: 10,
		equalTo: "#txtPassword",
    normalizer: function(value) { return $.trim(value); }
  }
}, 
messages: {
  txtUsername: {
		required: "Username should not be blank.",		
	  minlength: "Username should contain at least 2 characters.",
		noSpace: "Username should not contain space.",
		alphanumeric: "Letters, numbers, and underscores only please",
		usernameExt: "Username should not begin with a number."					
	},
  txtEmail: {
	 required: "Email address should not be blank.", 
	 noSpace: "Email address should not contain space.",
	 email: "Email address is not valid."
	},
	txtAddress: {
	 required: "Address should not be blank."
	},
	txtCity: {
	 required: "City should not be blank."
	},
	txtCountry: {
	 required: "Country should not be blank."
	},
	txtPostalcode: {
	 required: "Postal code should not be blank."
	},
	txtPhone: {
	 required: "Phone should not be blank.",
	 digits: "Please enter number only."
	},
  txtPassword: {
	 required: "Password should not be blank.", 
	 minlength: "Password should contain at least 10 characters."
	},
	txtConfPassword: {
	 required: "Confirm Password should not be blank.", 
	 minlength: "Confirm Password should contain at least 10 characters.",
	 equalTo: "Password and confirm password do not match. "
	}
},

//submitHandler: function (form) { 
//		//		alert('User name has been created successfully, please <a href="http://cathyzhang.org">log in </a>here.'); 
//		//		return false; 	
//		if (window.confirm('If you click "ok" you would be redirected . Cancel will load this website ')) {
//				window.location.href='https://www.google.com/chrome/browser/index.html';
//		};	
//$('#register-submit-btn').modal('show');
//},									
errorElement: "div",
errorPlacement: function(error, element) {
	var placement = $(element).data('error');
	if (placement) {
		$(placement).append(error)
	} else {
		error.insertAfter(element);
	}
}  
});
})
</script>
</body>
</html>