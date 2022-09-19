<?php 
/*==============================================
 panel for image on each page
 ===============================================*/
    function wpb_customize_register($wp_customize){
          // Create custom panel.
        $wp_customize->add_panel( 'panel_for_images', array(
            'priority'       => 500,
            'theme_supports' => '',
            'title'          => __( 'Images Panel', 'china' ),
            'description'    => __( 'Container for Images.', 'china' ),
        ) );
        //image section 0
        $wp_customize->add_section('container_image0', array(
            'title' => __('Image for Single Post','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_image', array(
            'label' => __('Image for Single Post', 'china'),
            'section' => 'container_image0', 
            'settings' => 'single_image',
            'priority' => 1
        )));

        //image section 0-1
        $wp_customize->add_section('container_image0_1', array(
            'title' => __('Image for Single Travel','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_travel_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_travel_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_travel_image', array(
            'label' => __('Image for Single Travel', 'china'),
            'section' => 'container_image0_1', 
            'settings' => 'single_travel_image',
            'priority' => 1
        )));

        //image section 0-2
        $wp_customize->add_section('container_image0_2', array(
            'title' => __('Image for Single Lifestyle','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_lifestyle_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_lifestyle_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_lifestyle_image', array(
            'label' => __('Image for Single Lifestyle', 'china'),
            'section' => 'container_image0_2', 
            'settings' => 'single_lifestyle_image',
            'priority' => 1
        )));

        //image section 0-3
        $wp_customize->add_section('container_image0_3', array(
            'title' => __('Image for Single Cooking','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_cooking_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_cooking_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_cooking_image', array(
            'label' => __('Image for Single Cooking', 'china'),
            'section' => 'container_image0_3', 
            'settings' => 'single_cooking_image',
            'priority' => 1
        )));

          //image section 0-4
        $wp_customize->add_section('container_image0_4', array(
            'title' => __('Image for Single Video','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_video_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_video_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_video_image', array(
            'label' => __('Image for Single Video', 'china'),
            'section' => 'container_image0_4', 
            'settings' => 'single_video_image',
            'priority' => 1
        )));

          //image section 0-5
        $wp_customize->add_section('container_image0_5', array(
            'title' => __('Image for Single Event','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('single_event_image', array(
            'default' => get_bloginfo('template_directory').'/images/single_event_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'single_event_image', array(
            'label' => __('Image for Single Event', 'china'),
            'section' => 'container_image0_5', 
            'settings' => 'single_event_image',
            'priority' => 1
        )));

        //image section 1
        $wp_customize->add_section('container_image1', array(
            'title' => __('Image for Content','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('content_image', array(
            'default' => get_bloginfo('template_directory').'/images/content_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'content_image', array(
            'label' => __('Image for Content', 'china'),
            'section' => 'container_image1', 
            'settings' => 'content_image',
            'priority' => 1
        )));

        //image section 1-1
        $wp_customize->add_section('container_image1_1', array(
            'title' => __('Image for Content Image','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('content_image_image', array(
            'default' => get_bloginfo('template_directory').'/images/content_image_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'content_image_image', array(
            'label' => __('Image for Content Image', 'china'),
            'section' => 'container_image1_1', 
            'settings' => 'content_image_image',
            'priority' => 1
        )));

        //image section 1-2
        $wp_customize->add_section('container_image1_2', array(
            'title' => __('Image for Content Link','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('content_link_image', array(
            'default' => get_bloginfo('template_directory').'/images/content_link_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'content_link_image', array(
            'label' => __('Image for Content Link', 'china'),
            'section' => 'container_image1_2', 
            'settings' => 'content_link_image',
            'priority' => 1
        )));

        //image section 1-3
        $wp_customize->add_section('container_image1_3', array(
            'title' => __('Image for Content Aside ','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('content_aside_image', array(
            'default' => get_bloginfo('template_directory').'/images/content_aside_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'content_aside_image', array(
            'label' => __('Image for Content Aside', 'china'),
            'section' => 'container_image1_3', 
            'settings' => 'content_aside_image',
            'priority' => 1
        )));

        //image section 1-4
        $wp_customize->add_section('container_image1_4', array(
            'title' => __('Image for Content Chat','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('content_chat_image', array(
            'default' => get_bloginfo('template_directory').'/images/content_chat_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'content_chat_image', array(
            'label' => __('Image for Content Chat', 'china'),
            'section' => 'container_image1_4', 
            'settings' => 'content_chat_image',
            'priority' => 1
        )));

        //image section 2
        $wp_customize->add_section('container_image2', array(
            'title' => __('Image for Category','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('category_image', array(
            'default' => get_bloginfo('template_directory').'/images/category_image.jpg',
            'type' => 'theme_mod'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'category_image', array(
            'label' => __('Image for Category', 'china'),
            'section' => 'container_image2', 
            'settings' => 'category_image',
            'priority' => 1
        )));
        //image section 2-1
        $wp_customize->add_section('container_image2_1', array(
            'title' => __('Image for Category Travel','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('travel_image', array(
            'default' => get_bloginfo('template_directory').'/images/travel_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'travel_image', array(
            'label' => __('Image for Category Travel', 'china'),
            'section' => 'container_image2_1', 
            'settings' => 'travel_image',
            'priority' => 1
        )));
        //image section 2-2
        $wp_customize->add_section('container_image2_2', array(
            'title' => __('Image for Category Lifestyle','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('lifestyle_image', array(
            'default' => get_bloginfo('template_directory').'/images/lifestyle_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'lifestyle_image', array(
            'label' => __('Image for Category Lifestyle', 'china'),
            'section' => 'container_image2_2', 
            'settings' => 'lifestyle_image',
            'priority' => 1
        )));
        //image section 2-3
        $wp_customize->add_section('container_image2_3', array(
            'title' => __('Image for Category Cooking','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('cooking_image', array(
            'default' => get_bloginfo('template_directory').'/images/cooking_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'cooking_image', array(
            'label' => __('Image for Category Cooking', 'china'),
            'section' => 'container_image2_3', 
            'settings' => 'cooking_image',
            'priority' => 1
        )));

        //image section 2-4
        $wp_customize->add_section('container_image2_4', array(
            'title' => __('Image for Category Video','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('video_image', array(
            'default' => get_bloginfo('template_directory').'/images/video_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'video_image', array(
            'label' => __('Image for Category Video', 'china'),
            'section' => 'container_image2_4', 
            'settings' => 'video_image',
            'priority' => 1
        )));

        //image section 2-5
        $wp_customize->add_section('container_image2_5', array(
            'title' => __('Image for Category Popular','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('popular_image', array(
            'default' => get_bloginfo('template_directory').'/images/popular_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'popular_image', array(
            'label' => __('Image for Category Popular', 'china'),
            'section' => 'container_image2_5', 
            'settings' => 'popular_image',
            'priority' => 1
        )));

        //image section 2-6
        $wp_customize->add_section('container_image2_6', array(
            'title' => __('Image for Category Event','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('event_image', array(
            'default' => get_bloginfo('template_directory').'/images/event_image.jpg',
            'type' => 'theme_mod'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'event_image', array(
            'label' => __('Image for Category Event', 'china'),
            'section' => 'container_image2_6', 
            'settings' => 'event_image',
            'priority' => 1
        )));

        //image section 3
        $wp_customize->add_section('container_image3', array(
            'title' => __('Image for Archive','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('archive_image', array(
            'default' => get_bloginfo('template_directory').'/images/archive_image.jpg',
            'type' => 'theme_mod'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'archive_image', array(
            'label' => __('Image for Archive', 'china'),
            'section' => 'container_image3', 
            'settings' => 'archive_image',
            'priority' => 1
        )));

        //image section 4
        $wp_customize->add_section('container_image4', array(
            'title' => __('Image for Author','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('author_image', array(
            'default' => get_bloginfo('template_directory').'/images/author_image.jpg',
            'type' => 'theme_mod'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'author_image', array(
            'label' => __('Image for Author', 'china'),
            'section' => 'container_image4', 
            'settings' => 'author_image',
            'priority' => 1
        )));

        //image section 5
        $wp_customize->add_section('container_image5', array(
            'title' => __('Image for Search','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('search_image', array(
            'default' => get_bloginfo('template_directory').'/images/search_image.jpg',
            'type' => 'theme_mod'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'search_image', array(
            'label' => __('Image for Search', 'china'),
            'section' => 'container_image5', 
            'settings' => 'search_image',
            'priority' => 1
        )));

        //image section 6
        $wp_customize->add_section('container_image6', array(
            'title' => __('Image for Contact Form','china'),
            'description' => sprintf(__('Options for Image', 'china')),
            'panel'    => 'panel_for_images',  
            'priority' => 130
        ));
        $wp_customize->add_setting('contact_image', array(
            'default' => get_bloginfo('template_directory').'/images/contact_image.jpg',
            'type' => 'theme_mod'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'contact_image', array(
            'label' => __('Image for Contact Form', 'china'),
            'section' => 'container_image6', 
            'settings' => 'contact_image',
            'priority' => 1
        )));


    };
add_action('customize_register', 'wpb_customize_register');
/*==============================================
ADD CAROUSEL BOX 3
================================================*/
// add carousel boxes
add_action( 'customize_register', 'china_carousel_customizer' );
function china_carousel_customizer( $wp_customize ) {
    // Create custom panel. CUSTOM PANEL IS LIKE A FOLDER
    // FOLDER NAME IS Carousel
    $wp_customize->add_panel( 'carousel', array(
        'priority'       => 500,
        'theme_supports' => '',
        'title'          => __( 'Carousel', 'china' ),
        'description'    => __( 'Set editable text for certain content.', 'china' ),
    ) );  
    /*==============================================
    ADD CAROUSEL 1
    ================================================*/
    // Add section carousel 1.  like subfolder inside Carousel, belongs to panel "Carousel"
    $wp_customize->add_section( 'carousel1' , array(
        'title'    => __('Carousel 1','china'),
        'panel'    => 'carousel',  
        'priority' => 130
    ) ); 
    //add carousel section 1
    $wp_customize->add_setting('image1', array(
            'default' => get_bloginfo('template_directory').'/images/default.jpg',
            'type' => 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'image1', array(
            'label' => __('Image - use photo size 1920 x 1080 (landscape). ', 'china'),
            'section' => 'carousel1', 
            'settings' => 'image1',
            'priority' => 1
        )));
    /*==============================================
    ADD CAROUSEL 2
    ================================================*/
    // Add section carousel 2.
    $wp_customize->add_section( 'carousel2' , array(
        'title'    => __('Carousel 2','china'),
        'panel'    => 'carousel',  
        'priority' => 130
    ) );        
    //add carousel section 2
    $wp_customize->add_setting('image2', array(
            'default' => get_bloginfo('template_directory').'/images/default.jpg',
            'type' => 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'image2', array(
            'label' => __('Image - use photo size 1920 x 1080 (landscape). ', 'china'),
            'section' => 'carousel2', 
            'settings' => 'image2',
            'priority' => 1
        )));     
    /*==============================================
    ADD CAROUSEL 3
    ================================================*/
    // Add section carousel 3.
    $wp_customize->add_section( 'carousel3' , array(
        'title'    => __('Carousel 3','china'),
        'panel'    => 'carousel',  
        'priority' => 130
    ) );
    //add carousel section 3, setting and control
    $wp_customize->add_setting('image3', array(
            'default' => get_bloginfo('template_directory').'/images/default.jpg',
            'type' => 'theme_mod'
        ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'image3', array(
            'label' => __('Image - use photo size 1920 x 1080 (landscape). ', 'china'),
            'section' => 'carousel3', 
            'settings' => 'image3',
            'priority' => 1
    )));  
}
?>