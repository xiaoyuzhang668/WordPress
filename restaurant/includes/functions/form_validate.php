<?php
/*==========================================
/* Contact form validation - #contactForm*/
/*==========================================*/
/* contact form validation on the same page with validation jquery*/
function contactform_jquery_validation_init() {
if(is_page ('contact-2') ) { ?>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {	
 $('#contactForm').validate({ 
    // onfocusout: function(element) {
    //   this.element(element);
// },
rules: {
  yourContactName: {
    required: true,
    normalizer: function(value) { return $.trim(value); }
  }, 
  yourContactEmail: {
    required: true,
	  email: true,       
  },
	yourContactPhone: {
    required: true,
	  phone: true,       
  },	
	yourContactMessage: {
    required: true,
    minlength: 10,
    normalizer: function(value) { return $.trim(value); }
  },
}, 
messages: {
  yourContactName: "<div class='text-danger font-weight-bold'>Name should not be blank.</div>",
	yourContactEmail: {
	 required: "<div class='text-danger font-weight-bold'>Email address should not be blank.</div>", 
	 email: "<div class='text-danger font-weight-bold'>Email address entered is invalid.</div>"
	},  
	yourContactPhone: {
	 required: "<div class='text-danger font-weight-bold'>Phone should not be blank.</div>", 
	 phone: "<div class='text-danger font-weight-bold'>Phone number is invalid.</div>"
	},
	yourContactMessage: {
	 required: "<div class='text-danger font-weight-bold'>Message should not be blank.</div>", 
	 minlength: "<div class='text-danger font-weight-bold'>Message should contain at least 10 characters.</div>"
	},
}, 
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
<?php
}
}
add_action('wp_footer', 'contactform_jquery_validation_init'); 