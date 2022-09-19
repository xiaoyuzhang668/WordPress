<?php 
/*==============================================
REMOVE MENU CUSTOMIZER
================================================*/
add_action('customize_register', function ( $WP_Customize_Manager ){
    //check if WP_Customize_Nav_Menus object exist
    if (isset($WP_Customize_Manager->nav_menus) && is_object($WP_Customize_Manager->nav_menus)) {
        //Remove all the filters/actions resiterd in WP_Customize_Nav_Menus __construct
        remove_filter( 'customize_refresh_nonces', array( $WP_Customize_Manager->nav_menus, 'filter_nonces' ) );
        remove_action( 'wp_ajax_load-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_load_available_items' ) );
        remove_action( 'wp_ajax_search-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_search_available_items' ) );
        remove_action( 'customize_controls_enqueue_scripts', array( $WP_Customize_Manager->nav_menus, 'enqueue_scripts' ) );
        remove_action( 'customize_register', array( $WP_Customize_Manager->nav_menus, 'customize_register' ), 11 );
        remove_filter( 'customize_dynamic_setting_args', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_args' ), 10, 2 );
        remove_filter( 'customize_dynamic_setting_class', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_class' ), 10, 3 );
        remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'print_templates' ) );
        remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'available_items_template' ) );
        remove_action( 'customize_preview_init', array( $WP_Customize_Manager->nav_menus, 'customize_preview_init' ) );
        remove_filter( 'customize_dynamic_partial_args', array( $WP_Customize_Manager->nav_menus, 'customize_dynamic_partial_args' ), 10, 2 );
    }
}, -1); //Give it a lowest priority so we can remove it on right time
/*==============================================
REMOVE WIDGET CUSTOMIZER
================================================*/
add_action('customize_register', 'themename_customize_register');
function themename_customize_register($wp_customize) {
//    $wp_customize->remove_control( 'title_tagline' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_panel( 'widgets' );
    $wp_customize->remove_panel( 'nav_menus' );
		$wp_customize->remove_section( 'custom_css' );
}
/*==============================================
 DASHBOARD SETTING - USER AVATAR AND WP LOGO
 ===============================================*/
function wpb_customize_dashboard_register($wp_customize){
			  // Create custom panel.
       $wp_customize->add_panel( 'panel_for_dashboard', array(
            'priority'       => 199,
            'theme_supports' => '',
            'title'          => __( 'Dashboard setting', '' ),
            'description'    => __( 'Dashboard icon for default user avatar and WordPress logo on the left top side of the corner.', 'template' ),
        ) );
				$dashboardIcon = [ "User Avatar", "WP Admin Logo"];
				$dashboardLength = count($dashboardIcon);
        $i = 0;
       while ($i < $dashboardLength) {	
				 	$plural = $dashboardIcon[$i];
					$string = str_replace(' ', '', $plural); 
					$singular = strtolower($string);		
       $wp_customize->add_section('container_'.$singular, array(
            'title' 			=> __('Default '.$dashboardIcon[$i],'template'),
            'description' => sprintf(__('Options for '.$dashboardIcon[$i], 'template')), 
				 		'panel'    => 'panel_for_dashboard',  
            'priority' 		=> 150
        ));
        $wp_customize->add_setting($singular.'_image', array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/core-image/'.$singular.'.png',
            'type' 		=> 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,$singular.'_image', array(
            'label' 		=> __($dashboardIcon[$i].' Image', 'template'),
            'section' 	=> 'container_'.$singular, 
            'settings' 	=> $singular.'_image',
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'button_labels' => array( // Optional
					 	'select' 			=> __( 'Select '.$dashboardIcon[$i] ),
						'change' 			=> __( 'Change '.$dashboardIcon[$i] ),
					 	'default' 			=> __( 'Default' ),
					 	'remove' 			=> __( 'Remove '.$dashboardIcon[$i] ),
					 	'placeholder' 	=> __( 'No '.$singular.' selected' ),
					 	'frame_title' 	=> __( 'Select File' ),
					 	'frame_button' => __( 'Choose File' ),
						'priority' 	=> 1
        ))));			            
				$i++; }
}
add_action('customize_register', 'wpb_customize_dashboard_register');
/*==============================================
1. ADD COMPANY INFORMATION - ADD LOGO, PHONE, EMAIL
 ===============================================*/
function wpb_customize_logo_register($wp_customize){
       $wp_customize->add_section('container_logo', array(
            'title' 			=> __('1. Company Information','template'),
            'description' => sprintf(__('Options for Logo', 'template')), 
            'priority' 		=> 200
        ));
        $wp_customize->add_setting('logo_image', array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/coreImage/logo.png',
            'type' 		=> 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize,'logo_image', array(
            'label' 		=> __('1. Logo Image', 'template'),
						'description' => __( 'Size no more than 40px X 30px', 'template' ),
            'section' 	=> 'container_logo', 
            'settings' 	=> 'logo_image',
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'flex_height' => true,
						'width'        			=> 100, 
						'height'        			=> 80, 
						'button_labels' => array( // Optional
						'select' 			=> __( 'Select Logo' ),
						'change' 			=> __( 'Change Logo' ),
						'default' 			=> __( 'Default' ),
						'remove' 			=> __( 'Remove Logo' ),
						'placeholder' 	=> __( 'No logo selected' ),
						'frame_title' 	=> __( 'Select File' ),
						'frame_button' => __( 'Choose File' ),
            'priority' 	=> 1
        )))); 
	
				$wp_customize->add_setting('my_company_name', array(
            'default' => 'Company Name',
            'type' => 'theme_mod', // you can also use 'theme_mod'
            'capability' => 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
        )
				);
				$wp_customize->add_control( new WP_Customize_Control(
						$wp_customize,
						'my_company_name',
						array(
								'label'      => __( '2. Company Name', 'template' ),
								'description' => __( 'Enter company name', 'template' ),
								'section' 	=> 'container_logo', 
								'settings'   => 'my_company_name',
								'priority'   => 10,
								'type'       => 'text',
						)
				) );
				$wp_customize->add_setting('my_company_address', array(
            'default' => 'Company Address',
            'type' => 'theme_mod', // you can also use 'theme_mod'
            'capability' => 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
        )
				);
				$wp_customize->add_control( new WP_Customize_Control(
						$wp_customize,
						'my_company_address',
						array(
								'label'      => __( '3. Company Address', 'template' ),
								'description' => __( 'Enter company address', 'template' ),
								'section' 	=> 'container_logo', 
								'settings'   => 'my_company_address',
								'priority'   => 10,
								'type'       => 'text',
						)
				) );
				$wp_customize->add_setting('my_company_phone', array(
            'default' => '123456',
            'type' => 'theme_mod', // you can also use 'theme_mod'
            'capability' => 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
        )
				);
				$wp_customize->add_control( new WP_Customize_Control(
						$wp_customize,
						'my_company_phone',
						array(
								'label'      => __( '4. Phone Number', 'template' ),
								'description' => __( 'Enter phone number at header', 'template' ),
								'section' 	=> 'container_logo', 
								'settings'   => 'my_company_phone',
								'priority'   => 10,
								'type'       => 'text',
						)
    		) );	
				 $wp_customize->add_setting(
							'my_company_email',
							array(
									'default' => 'catzhang1@hotmail.ca',
									'type' => 'theme_mod', // you can also use 'theme_mod'
									'capability' => 'edit_theme_options',
									'sanitize_callback' => 'sanitize_text_field',
							)
					);

					$wp_customize->add_control( new WP_Customize_Control(
							$wp_customize,
							'my_company_email',
							array(
									'label'      => __( '5. Email', 'template' ),
									'description' => __( 'Enter email at header', 'template' ),
									'settings'   => 'my_company_email',
									'priority'   => 10,
									'section'    => 'container_logo',
									'type'       => 'text',
							)
					) );
				$wp_customize->add_setting('login_image', array(
									'capability' => 'edit_theme_options', 
									'sanitize_callback' => 'sanitize_text_field',
									'default' => get_bloginfo('template_directory').'/assets/image/login/login-image.jpg',
									'type' 		=> 'theme_mod'
							));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'login_image', array(
            'label' 		=> __('6. Login Image', 'template'),
						'description' => __( 'Size no more than 120px X 120px', 'template' ),
            'section' 	=> 'container_logo', 
            'settings' 	=> 'login_image',
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'button_labels' => array( // Optional
						'select' 			=> __( 'Select Login Image' ),
						'change' 			=> __( 'Change Login Image' ),
						'default' 			=> __( 'Default' ),
						'remove' 			=> __( 'Remove Login Image' ),
						'placeholder' 	=> __( 'No Login Image selected' ),
						'frame_title' 	=> __( 'Select File' ),
						'frame_button' => __( 'Choose File' ),
            'priority' 	=> 12
        ))));
				$wp_customize->add_setting('login_background', array(
									'capability' => 'edit_theme_options', 
									'sanitize_callback' => 'sanitize_text_field',
									'default' => get_bloginfo('template_directory').'/assets/image/login/login-background.jpg',
									'type' 		=> 'theme_mod'
							));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'login_background', array(
            'label' 		=> __('7. Login Background', 'template'),
						'description' => __( 'Login Background', 'template' ),
            'section' 	=> 'container_logo', 
            'settings' 	=> 'login_background',
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'button_labels' => array( // Optional
						'select' 			=> __( 'Select Log in Background Image' ),
						'change' 			=> __( 'Change Login Background Image' ),
						'default' 			=> __( 'Default' ),
						'remove' 			=> __( 'Remove Login Background Image' ),
						'placeholder' 	=> __( 'No Login Background Image selected' ),
						'frame_title' 	=> __( 'Select File' ),
						'frame_button' => __( 'Choose File' ),
            'priority' 	=> 13
        ))));
	}
	add_action('customize_register', 'wpb_customize_logo_register');
 /*==============================================
 2.   ADD video
    ================================================*/
add_action( 'customize_register', 'video_frontpage_theme_customizer' );
function video_frontpage_theme_customizer( $wp_customize ) {
        //  Video Section
	$wp_customize->add_panel('videosection_panel', array(
        'priority'       => 201,
				'theme_supports' => '',
        'title'          => __( '2. Video Section ( Front Page )', 'template' ),
        'description'    => __( 'Video section on front page - upload video, cover image, caption text and link text for button.', 'template' ),
    ));
	for ( $i=1; $i <= 3; $i++) {	
    $wp_customize->add_section( 'video_panel'.$i , array(
        'title'    => __('Video '.$i ,'template'),
        'panel'    => 'videosection_panel',  
        'priority' => 130
    ) ); 	
		$wp_customize->add_setting( 'video_upload_'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
					'transport' 				=> 'refresh',
					'type' 							=> 'theme_mod',
			 )
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'video_upload_'.$i,
			 array(
					'label' 				=> __( 'Default Media Control' ),
					'description' 	=> esc_html__( 'Video '.$i.' on front page' ),
					'section' 			=> 'video_panel'.$i, 
					'settings' 			=> 'video_upload_'.$i,
					'priority' 			=> 1,
					'mime_type' 		=> 'video',  // Required. Can be image, audio, video, application, text
					'button_labels' => array( // Optional
					 'select' 			=> __( 'Select Video' ),
					 'change' 			=> __( 'Change Video' ),
					 'remove' 			=> __( 'Remove Video' ),
					 'placeholder' 	=> __( 'No video selected' ),
					 'frame_title' 	=> __( 'Select File' ),
					 'frame_button' => __( 'Choose File' ),
					)
			 )
		) );
		    //add poster image
    $wp_customize->add_setting('video_poster'.$i,  array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
						'transport' 				=> 'refresh',
            'type' 							=> 'theme_mod', 
        ));
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'video_poster'.$i, array(
						'label' 			=> __( 'Cover Image for the Video' ),
            'description' => esc_html__( 'Poster image for Video '.$i, 'template'),
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'height'        		=> 40, 
						'width'        			=> 70, 
						'flex_width'				=> true,
						'flex_height'				=> true,
            'section' 					=> 'video_panel'.$i, 
            'settings' 					=> 'video_poster'.$i, 
            'priority' 					=> 1,			
						'button_labels' => array( // Optional
						'select' 			=> __( 'Select Cover Image' ),
						'change' 			=> __( 'Change Cover Image' ),
						'remove' 			=> __( 'Remove Cover Image' ),
						'placeholder' 	=> __( 'No cover image selected' ),
						'frame_title' 	=> __( 'Select File' ),
						'frame_button' => __( 'Choose File' ))
        )));  
	 	 // Add header setting
    $wp_customize->add_setting( 'video_header'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default' 	=> __( 'header', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'video_header'.$i,
            array(
                'label'    => __( 'Header', 'template' ),
                'section'  => 'video_panel'.$i,
                'settings' => 'video_header'.$i,
                'priority' => 1,
                'type'     => 'text'
            )
        )
    );
	// Add header setting 2
    $wp_customize->add_setting( 'video_text'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( 'text', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'video_text'.$i,
            array(
                'label'    => __( 'Text for the Web Link', 'template' ),
                'section'  => 'video_panel'.$i,
                'settings' => 'video_text'.$i,
                'priority' => 1,
                'type'     => 'text'
            )
        )
    );
    	// Add header setting 2
    $wp_customize->add_setting( 'video_link'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
//         	'default'  => __( 'link', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'video_link'.$i,
            array(
                'label'    => __( 'Web Link URL', 'template' ),
                'section'  => 'video_panel'.$i,
                'settings' => 'video_link'.$i,
                'priority' => 1,
                'type'     => 'url',
							 	'input_attrs' => array(
									'placeholder' => __( 'http://www.google.com' ),
								),
            )
        )
    );
    // Add subtext setting
    $wp_customize->add_setting( 'video_subtext'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( 'subtext', 'template' ),
         	'type'     => 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'video_subtext'.$i,
            array(
                'label'    => __( 'Subtext', 'template' ),
                'section'  => 'video_panel'.$i,
                'settings' => 'video_subtext'.$i,
                'priority' => 1, 
                'type'     => 'textarea'
            )
        )
    );
}
}
/*==============================================
3. IMAGE DEFAULT PANEL FOR EACH PAGE/CATEGORY/POST
 ===============================================*/
 function wpb_customize_register($wp_customize){
          // Create custom panel.
        $wp_customize->add_panel( 'panel_for_images', array(
            'priority'       => 250,
            'theme_supports' => '',
            'title'          => __( '3. Image Panel', 'template' ),
            'description'    => __( 'Container for default image on each page/post/category when it is not defined.', 'template' ),
        ) );
				$image = [ "Section 1", "Section 2", "Section 3", "Page", "Archive", "Author", "Search", "Contact", "Contact Form", "Error", "Content Image", "Content Link", "Content Aside", "Content Chat", "Content Gallery", "Content Status", "Content Quote", "Content Video",  "Single Cooking", "Single Lifestyle", "Single Food", "Single", "Custom Post" ];
				$imageLength = count($image);
				for ( $i=0; $i < $imageLength; $i++) {
						$plural = $image[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);
        //image section 
        $wp_customize->add_section('container_image'.$i, array(
            'title' => __('Image for '.$image[$i],'template'),
            'description' => sprintf(__('Options for Image', 'template')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting($singular, array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/customizer/'.$singular.'.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $singular , array(
            'label' => __('Image for '.$image[$i], 'template'),
            'section' => 'container_image'.$i, 
            'settings' => $singular,
            'priority' => 1
        )));
				$wp_customize->add_setting( $singular.'_text', array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default' 	=> __( '', 'template' ),
         	'type' 		=> 'theme_mod'
				) );
				// Add control
				$wp_customize->add_control( new WP_Customize_Control(
						$wp_customize,
						$singular.'_text',
								array(
										'label'    => __( 'Text', 'template' ),
										'section'  => 'container_image'.$i, 
										'settings' => $singular.'_text',
										'priority' => 1,
										'type'     => 'text'
								)
						)
				);
				$wp_customize->add_setting( $singular.'_link', array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default' 	=> __( '', 'template' ),
         	'type' 		=> 'theme_mod'
				) );
				// Add control
				$wp_customize->add_control( new WP_Customize_Control(
						$wp_customize,
						$singular.'_link',
								array(
										'label'    => __( 'Link', 'template' ),
										'section'  => 'container_image'.$i, 
										'settings' => $singular.'_link',
										'priority' => 1,
										'type'     => 'text'
								)
						)
				);
    };
 }
add_action('customize_register', 'wpb_customize_register');
/*==============================================
4. ADD TEXT PANEL
================================================*/
// add text panel box
add_action( 'customize_register', 'template_text_customizer' );
function template_text_customizer( $wp_customize ) {
    // Create text panel. CUSTOM PANEL IS LIKE A FOLDER
    // FOLDER NAME IS Text Panel
    $wp_customize->add_panel( 'text_panel', array(
        'priority'       => 260,
        'theme_supports' => '',
        'title'          => __( '4. Text Panel (not used)', 'template' ),
        'description'    => __( 'Text panel to hold text for certain place in page/post/category, etc.', 'template' ),
    ) );  
    /*==============================================
    ADD text loop - 3 text box
    ================================================*/	
	 //add image section
	// Add section -  like subfolder inside text panel, belongs to panel "Text Panel"
	for ( $i=1; $i <= 3; $i++) {	
    $wp_customize->add_section( 'text_panel'.$i , array(
        'title'    => __('Text '.$i ,'template'),
        'panel'    => 'text_panel',  
        'priority' => 130
    ) ); 
    $wp_customize->add_setting('text_panel_image'.$i, array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/images/default.jpg',
            'type' 		=> 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'text_panel_image'.$i, array(
					'label' 		=> __('Default Image Control (use 1920px X 1208px)', 'template'),
					'description' => esc_html__( 'Upload image if there is any to accompany the text' ),
					'section' 	=> 'text_panel'.$i, 
					'settings' 	=> 'text_panel_image'.$i,
					'priority' 	=> 1
        )));     
 	 // Add header setting
    $wp_customize->add_setting( 'text_panel_header'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default' 	=> __( 'header', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'text_panel_header'.$i,
            array(
                'label'    => __( 'Header', 'template' ),
                'section'  => 'text_panel'.$i,
                'settings' => 'text_panel_header'.$i,
                'priority' => 1,
                'type'     => 'text'
            )
        )
    );
	// Add header setting 2
    $wp_customize->add_setting( 'text_panel_text'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( 'text', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'text_panel_text'.$i,
            array(
                'label'    => __( 'Text', 'template' ),
                'section'  => 'text_panel'.$i,
                'settings' => 'text_panel_text'.$i,
                'priority' => 1,
                'type'     => 'text'
            )
        )
    );
    // Add subtext setting
    $wp_customize->add_setting( 'text_panel_subtext'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( 'subtext', 'template' ),
         	'type'     => 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'text_panel_subtext'.$i,
            array(
                'label'    => __( 'Subtext', 'template' ),
                'section'  => 'text_panel'.$i,
                'settings' => 'text_panel_subtext'.$i,
                'priority' => 1, 
                'type'     => 'textarea'
            )
        )
    );	
}
}
/*==============================================
5. ADD DEPARTMENT SECTION - here add 8 section
================================================*/
// add tea boxes
add_action( 'customize_register', 'template_tea_customizer' );
function template_tea_customizer( $wp_customize ) {
    // Create custom panel. CUSTOM PANEL IS LIKE A FOLDER
    // FOLDER NAME IS Carousel
    $wp_customize->add_panel( 'section', array(
        'priority'       => 300,
        'theme_supports' => '',
        'title'          => __( '5. Department Section (Front page)', 'template' ),
        'description'    => __( 'Set editable text for certain content.', 'template' ),
    ) ); 
		$section = ["Department 1", "Department 2", "Department 3","Department 4", "Department 5", "Department 6", "Department 7", "Department 8"];
		$sectionLength = count($section);
				for ( $i=0; $i < 8; $i++) {
						$plural = $section[$i];
						$string = str_replace(' ', '-', $plural);
						$singular = strtolower($string);
    /*==============================================
    ADD TEA LOOP
    ================================================*/	
    // Add section.  like subfolder inside Carousel, belongs to panel "Tea"
    $wp_customize->add_section( $singular, array(
        'title'    => __($plural, 'template'),
        'panel'    => 'section',  
        'priority' => 130
    ) ); 
    //add carousel section 1
    $wp_customize->add_setting($singular.'_image', array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/default.jpg',
            'type' 		=> 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,$singular.'_image', array(
            'label' => __($plural.' Image ', 'template'),
            'section' => $singular, 
            'settings' => $singular.'_image',
            'priority' => 1
        )));
		 // Add title setting
    $wp_customize->add_setting( $singular.'_title', array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'           => ' ',
         	'type'              => 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $singular.'_title',
            array(
                'label'    => __( $plural.' Title', 'template' ),
                'section'  => $singular,
                'settings' => $singular.'_title',
                'priority' => 1, 
                'type'     => 'text'
            )
        )
    );
    // Add subtext setting
    $wp_customize->add_setting( $singular.'_text', array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'           => ' ',
         	'type'              => 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $singular.'_text',
            array(
                'label'    => __( $plural.' Description', 'template' ),
                'section'  => $singular,
                'settings' => $singular.'_text',
                'priority' => 1, 
                'type'     => 'textarea'
            )
        )
    );
		// Add link setting
    $wp_customize->add_setting( $singular.'_link', array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'           => ' ',
         	'type'              => 'theme_mod'
    ) );
		    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $singular.'_link',
            array(
                'label'    => __( $plural.' Link', 'template' ),
                'section'  => $singular,
                'settings' => $singular.'_link',
                'priority' => 1, 
                'type'     => 'text'
            )
        )
    );
}
}
/*==============================================
6. MENU ICON
 ===============================================*/
function wpb_customize_menu_register($wp_customize){
			  // Create custom panel.
       $wp_customize->add_panel( 'panel_for_menu', array(
            'priority'       => 350,
            'theme_supports' => '',
            'title'          => __( '6. Menu Icon', 'template' ),
            'description'    => __( 'Menu icon for menu.', 'template' ),
        ) );
				$menuIcon = [ "Menu 1 Icon", "Menu 2 Icon", "Menu 3 Icon", "Menu 4 Icon", "Menu 5 Icon", "Menu 6 Icon", "Menu 7 Icon", "Menu 8 Icon"];
				$menuLength = count($menuIcon);
        for ( $i=0; $i < $menuLength; $i++) {
					$plural = $menuIcon[$i];
					$string = str_replace(' ', '', $plural); 
					$singular = strtolower($string);		
       $wp_customize->add_section('container_menu_'.$singular, array(
            'title' 			=> sprintf(__($menuIcon[$i],'template')),
				 		'panel'    => 'panel_for_menu',  
            'priority' 		=> 150
        ));
        $wp_customize->add_setting($singular, array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/core-image/avatar.png',
            'type' 		=> 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $singular, array(
//            'label' 		=> esc_html__($menuIcon[$i].' Image', 'template'),
            'description' 		=> esc_html__('Upload '.$menuIcon[$i].' Image (Size no more than 50px X 50px;)', 'template') ,
            'section' 	=> 'container_menu_'.$singular, 
            'settings' 	=> $singular,
						'mime_type' 		=> 'image',  // Required. Can be image, audio, video, application, text
						'button_labels' => array( // Optional
						'select' 			=> __( 'Select '.$menuIcon[$i] ),
						'change' 			=> __( 'Change '.$menuIcon[$i] ),
						'default' 			=> __( 'Default' ),
						'remove' 			=> __( 'Remove '.$menuIcon[$i] ),
						'placeholder' 	=> __( 'No '.$menuIcon[$i].' selected' ),
						'frame_title' 	=> __( 'Select File' ),
						'frame_button' => __( 'Choose File' ),
            'priority' 	=> 1
        ))));			            
			 }
				/*==============================================
					6. MENU ICON  - social menu icon
					 ===============================================*/
	 			$wp_customize->add_section('social_menu', array(
            'title' 			=> sprintf(__('Social Menu','template')),
				 		'panel'    => 'panel_for_menu',  
            'priority' 		=> 150
        ));
				$socialIcon = [ "Facebook", "Twitter", "Youtube", "LinkedIn", "WeChat", "WeiBo"];
				$socialLength = count($socialIcon);
        for ( $i=0; $i < $socialLength; $i++) {
					$plural = $socialIcon[$i];
					$string = str_replace(' ', '', $plural); 
					$singular = strtolower($string);	
	      $wp_customize->add_setting($singular.'_social_menu', array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => $singular.' Link',
            'type' 		=> 'theme_mod'
        ));
        $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        $singular.'_social_menu',
            array(
                'label'    => __( $socialIcon[$i].' Link', 'template' ),
                'section'  => 'social_menu',
                'settings' => $singular.'_social_menu',
                'priority' => 1, 
                'type'     => 'text'
            )
        		)
    			);
				}
}
add_action('customize_register', 'wpb_customize_menu_register');
/*==============================================
7. ADD CAROUSEL BOX 3
================================================*/
// add carousel boxes
add_action( 'customize_register', 'template_carousel_customizer' );
function template_carousel_customizer( $wp_customize ) {
    // Create custom panel. CUSTOM PANEL IS LIKE A FOLDER
    // FOLDER NAME IS Carousel
    $wp_customize->add_panel( 'carousel', array(
        'priority'       => 400,
        'theme_supports' => '',
        'title'          => __( '7. Carousel (Front page)', 'template' ),
        'description'    => __( 'Define carousel image and all text above the image.', 'template' ),
    ) );  
   	for ( $i=1; $i <= 3; $i++) {		
    // Add section carousel 1.  like subfolder inside Carousel, belongs to panel "Carousel"
    $wp_customize->add_section( 'carousel'.$i , array(
        'title'    => __('Carousel '.$i,'template'),
        'panel'    => 'carousel',  
        'priority' => 130
    ) ); 
    //add carousel section 1
    $wp_customize->add_setting('carousel_image'.$i, array(
						'capability' => 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/default.jpg',
            'type' 		=> 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'carousel_image'.$i, array(
            'label' 				=> __('Image - use photo size 1920 x 1080 (landscape). ', 'template'),
						'description' 	=> esc_html__( 'Carousel Image '.$i.' on front page' ),
            'section' 			=> 'carousel'.$i, 
            'settings' 			=> 'carousel_image'.$i,
            'priority' 			=> 1
        )));
	 // Add header setting
    $wp_customize->add_setting( 'carousel_header'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( ' ', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'carousel_header'.$i,
            array(
                'label'    			=> __( 'First Line', 'template' ),
								'description' 	=> esc_html__( 'Red header text above carousel image '.$i ),
                'section'  			=> 'carousel'.$i,
                'settings' 			=> 'carousel_header'.$i,
                'priority' 			=> 1,
                'type'     			=> 'text'
            )
        )
    );
	// Add header setting 2
    $wp_customize->add_setting( 'carousel_text'.$i, array(
					'capability' => 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  => __( ' ', 'template' ),
         	'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'carousel_text'.$i,
            array(
                'label'    			=> __( 'Second Line', 'template' ),
								'description' 	=> esc_html__( 'Second line text above carousel image '.$i ),
                'section'  			=> 'carousel'.$i,
                'settings' 			=> 'carousel_text'.$i,
                'priority' 			=> 1,
                'type'     			=> 'text'
            )
        )
    );
    // Add subtext setting
    $wp_customize->add_setting( 'carousel_subtext'.$i, array(
					'capability' 				=> 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'           => __( ' ', 'template' ),
         	'type'              => 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'carousel_subtext'.$i,
            array(
                'label'    			=> __( 'Subtext', 'template' ),
								'description' 	=> esc_html__( 'Third line text above carousel image '.$i ),
                'section'  			=> 'carousel'.$i,
                'settings' 			=> 'carousel_subtext'.$i,
                'priority' 			=> 1, 
                'type'     			=> 'textarea'
            )
        )
    );
}
}  
/*==============================================
7. ADD SLIDER
================================================*/
// add slider boxes
add_action( 'customize_register', 'template_slider_customizer' );
function template_slider_customizer( $wp_customize ) {
    // Create custom panel. CUSTOM PANEL IS LIKE A FOLDER
    // FOLDER NAME IS SlitSlider
    $wp_customize->add_panel( 'slitslider', array(
        'priority'       => 501,
        'theme_supports' => '',
        'title'          => __( '8. Slit Slider (Contact Form page)', 'template' ),
        'description'    => __( 'Define slit slider image, text and link.', 'template' ),
    ) );  
   	for ( $i=1; $i <= 6; $i++) {		
    // Add section slit slider subfolder.  like subfolder inside slider, belongs to panel "slitslider"
    $wp_customize->add_section( 'slider'.$i , array(
        'title'    => __('Slit Slider '.$i,'template'),
        'panel'    => 'slitslider',  
        'priority' => 130
    ) ); 
    //add slider section 1
    $wp_customize->add_setting('slider_image'.$i, array(
						'capability' 				=> 'edit_theme_options', 
  					'sanitize_callback' => 'sanitize_text_field',
            'default' => get_bloginfo('template_directory').'/assets/image/default.jpg',
            'type' 		=> 'theme_mod', 
						'transport'   => 'postMessage'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'slider_image'.$i, array(
            'label' 				=> __('Image - use photo size 1920 x 1080 (landscape). ', 'template'),
						'description' 	=> esc_html__( 'Slit Slider Image '.$i.' on Contact Form page' ),
            'section' 			=> 'slider'.$i, 
            'settings' 			=> 'slider_image'.$i,
            'priority' 			=> 1
        )));
	 // Add header setting
    $wp_customize->add_setting( 'slider_header'.$i, array(
					'capability' 				=> 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  					=> __( ' ', 'template' ),
         	'type' 							=> 'theme_mod', 
					'transport'   			=> 'postMessage'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider_header'.$i,
            array(
                'label'    			=> __( 'First Line', 'template' ),
								'description' 	=> esc_html__( 'Office name' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider_header'.$i,
                'priority' 			=> 1,
                'type'     			=> 'text'
            )
        )
    );
				 // Add website link
    $wp_customize->add_setting( 'slider_link'.$i, array(
					'capability' 				=> 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  					=> __( ' ', 'template' ),
         	'type' 							=> 'theme_mod', 
					'transport'   			=> 'postMessage'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider_link'.$i,
            array(
                'label'    			=> __( 'Website link', 'template' ),
								'description' 	=> esc_html__( 'Website link for office ' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider_link'.$i,
                'priority' 			=> 1,
                'type'     			=> 'text'
            )
        )
    );
	// Add header setting 2
    $wp_customize->add_setting( 'slider_text'.$i , array(
					'capability' 				=> 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'  					=> __( ' ', 'template' ),
         	'type' 							=> 'theme_mod', 
					'transport'   => 'postMessage'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider_text'.$i ,
            array(
                'label'    			=> __( 'Second Line', 'template' ),
								'description' 	=> esc_html__( 'Second line text above slider image ' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider_text'.$i ,
                'priority' 			=> 1,
                'type'     			=> 'text'
            )
        )
    );
    // Add subtext setting
    $wp_customize->add_setting( 'slider_subtext'.$i, array(
					'capability' 				=> 'edit_theme_options', 
  				'sanitize_callback' => 'sanitize_text_field',
         	'default'           => __( ' ', 'template' ),
         	'type'              => 'theme_mod', 
					'transport'   			=> 'postMessage'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider_subtext'.$i,
            array(
                'label'    			=> __( 'Slider Subtext', 'template' ),
								'description' 	=> esc_html__( 'Third line text above slider image ' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider_subtext'.$i,
                'priority' 			=> 1, 
                'type'     			=> 'textarea'
            )
        )
    );
			 // Add radio control - horizontal and vertical
		$wp_customize->add_setting('slider_layout'.$i, array(
				'capability' 				=> 'edit_theme_options', 
        'sanitize_callback' => 'sanitize_text_field', 
        'default' 					=> 'horizontal'
    ));
    $wp_customize->add_control( 'slider_layout'.$i, array(
        'section'               => 'slider'.$i,
				'settings' 							=> 'slider_layout'.$i,
        'label'                 => __( 'Layout Style', 'template' ),
        'type'                  => 'radio',
        'priority'              => 1,
        'choices'               => array(
            'horizontal'        => __('Horizontal', 'template'),
            'vertical'          => __('Vertical', 'template'),
        ),
    ));
			// Add slider 1 rotation angel data-slice1-rotation
    $wp_customize->add_setting( 'slider1rotation'.$i, array(
				'capability' => 'edit_theme_options', 
        'default'  => __( '2', 'template' ),
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
        'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider1rotation'.$i,
            array(
                'label'    			=> __( 'data-slice1-rotation', 'template' ),
								'description' 	=> esc_html__( 'Rotaiton number (enter range from -100 to 100) ' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider1rotation'.$i,
                'priority' 			=> 1,
                'type'     			=> 'number',
								'input_attrs' => array(
										'min'   => -100,
										'max'   => 100,
//										'step' => 1,
//										'class' => 'test-class test',
//        						'style' => 'color: #0a0',
								)
            )
        )
    );		
			// Add slider 2 rotation angel data-slice2-rotation
    $wp_customize->add_setting( 'slider2rotation'.$i, array(
        'capability' => 'edit_theme_options', 
        'default'  => __( '22', 'template' ),
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
        'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider2rotation'.$i,
            array(
                'label'    			=> __( 'data-slice2-rotation', 'template' ),
								'description' 	=> esc_html__( 'Rotaiton number (enter range from -100 to 100)' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider2rotation'.$i,
                'priority' 			=> 1,
                'type'     			=> 'number',
								'input_attrs' => array(
										'min'   => -100,
										'max'   => 100,
								)
            )
        )
    );
			// Add slider 1 scale angel data-slice1-scale
    $wp_customize->add_setting( 'slider1scale'.$i, array(
        'capability' => 'edit_theme_options', 
        'default'  => __( '-22', 'template' ),
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
        'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider1scale'.$i,
            array(
                'label'    			=> __( 'data-slice1-scale', 'template' ),
								'description' 	=> esc_html__( 'Scale number (enter range from -100 to 100)' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider1scale'.$i,
                'priority' 			=> 1,
                'type'     			=> 'number',
								'input_attrs' => array(
										'min'   => -100,
										'max'   => 100,
								)
            	)
            )
    );
				// Add slider 2 scale angel data-slice2-scale
    $wp_customize->add_setting( 'slider2scale'.$i, array(
        'capability' => 'edit_theme_options', 
        'default'  => __( '-12', 'template' ),
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
        'type' 		=> 'theme_mod'
    ) );
    // Add control
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'slider2scale'.$i,
            array(
                'label'    			=> __( 'data-slice2-scale', 'template' ),
								'description' 	=> esc_html__( 'Scale number (enter range from -100 to 100)' ),
                'section'  			=> 'slider'.$i,
                'settings' 			=> 'slider2scale'.$i,
                'priority' 			=> 1,
                'type'     			=> 'number',
								'input_attrs' => array(
										'min'   => -100,
										'max'   => 100,
								)
            )
        )
    	);
		}
}
/*==============================================
 9. VIDEO UPLOADER
 ===============================================*/
add_action( 'customize_register', 'video_branch_theme_customizer' );
function video_branch_theme_customizer( $wp_customize ) {
        // Video Section
$wp_customize->add_section('branch_video_section', array(
        'title' 		=> __('9. Video Section ( Offices page )', 'template'),
        'priority' 	=> 600,
    ));
$wp_customize->add_setting( 'branch_video_upload',
   array(
     		'capability' => 'edit_theme_options', 
        'default' => '',
				'transport'   => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
        'type' 		=> 'theme_mod'							
   )
);
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'branch_video_upload',
   array(
			'label' 				=> __( 'Default Media Control' ),
			'description' 	=> esc_html__( 'Video on offices page' ),
			'section' 			=> 'branch_video_section',
			'settings' 			=> 'branch_video_upload',
		 	'priority' 			=> 1,
			'mime_type' 		=> 'video',  // Required. Can be image, audio, video, application, text
			'button_labels' => array( // Optional
			 'select' 			=> __( 'Select Video' ),
			 'change' 			=> __( 'Change Video' ),
			 'remove' 			=> __( 'Remove Video' ),
			 'placeholder' 	=> __( 'No video selected' ),
			 'frame_title' 	=> __( 'Select File' ),
			 'frame_button' => __( 'Choose File' ),
      )
   )
) );
}
?>