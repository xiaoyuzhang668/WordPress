<?php
/*========================================
  Advanced custom field responsive
  ========================================*/
function my_acf_admin_head() {
	?>
	<style type="text/css">
		@media screen and (min-width: 992px) {	
			/*			product*/
			div.acf-field.acf-field-select.acf-field-5eaed746753a5 {
				width: 50%;
				float: left;
    		}
    	div.acf-field.acf-field-select.acf-field-5eaee3831b333 {
    		width: 50%;    	
    		display: inline-block;
    		}
			div.acf-field.acf-field-text.acf-field-5eaef74d0c8b9 {
				width: 50%;
				float: left;
    		}
			div.acf-field.acf-field-text.acf-field-5eaf02bd2736a {
				width: 50%;
				display: inline-block;
    		}
			div.acf-field.acf-field-text.acf-field-5eaf02c12736b {
				width: 50%;
				float: left;
    		}
			/*				tea*/
			div.acf-field.acf-field-select.acf-field-5eaf17446433f, 
			div.acf-field.acf-field-text.acf-field-5eaf176010f33 {
				width: 50%;
				float: left;
    		}
			div.acf-field.acf-field-number.acf-field-5eaf174faae4c {
				width: 50%;
				display: inline-block;
    		}
				/*				downloads*/
			div.acf-field.acf-field-select.acf-field-5eaf55042c17f, 
			div.acf-field.acf-field-select.acf-field-5eaf581585fd1, 
			div.acf-field.acf-field-select.acf-field-5eaf498d28ddb,
			div.acf-field.acf-field-number.acf-field-5eaf4a08b7c85 {
				width: 50%;
				float: left;
    		}
			div.acf-field.acf-field-text.acf-field-5eaf49330aeda,
			div.acf-field.acf-field-text.acf-field-5eaf5b9606a52 {
				width: 50%;
				display: inline-block;
    		}
		}
	</style>
	<?php
}
add_action('acf/input/admin_head', 'my_acf_admin_head');
/*====================================================================
  Tea Number Validation - tea should be more than 0 and less than 2000
  ====================================================================*/
add_action('acf/validate_save_post', 'my_acf_validate_number_save_post', 10, 0);
function my_acf_validate_number_save_post() {
	// bail early if value is already invalid
        $price = $_POST['acf']['field_5eaf174faae4c'];
        // check custom $_POST data
            if ($price < 0) {
                acf_add_validation_error('acf[field_5eaf174faae4c]', 'Price should not be less than 0.');
            }
						if ($price > 2000) {
                acf_add_validation_error('acf[field_5eaf174faae4c]', 'Price should not be more than 2000.');
            }
    }
/*========================================
  Date Picker Validation - start date should be less than end date
  ========================================*/
add_action('acf/validate_save_post', 'my_acf_validate_save_post', 10, 0);
function my_acf_validate_save_post() {
	// bail early if value is already invalid
        $start = $_POST['acf']['field_5e512f4119729'];
        $start = new DateTime($start);

        $end = $_POST['acf']['field_5e512f7e1972a'];
        $end = new DateTime($end);
        // check custom $_POST data
            if ($start > $end) {
                acf_add_validation_error('acf[field_5e512f4119729]', 'End Date should be greater than or Equal to Start Date');
								acf_add_validation_error('acf[field_5e512f7e1972a]', 'End Date should be greater than or Equal to Start Date');
            }
    }
		?>