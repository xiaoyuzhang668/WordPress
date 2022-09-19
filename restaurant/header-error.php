<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cathy Zhang, Portfolio, Leisure, Blog, Casual, WordPress theme built from sratch">
    <meta name="author" content="Cathy Zhang Personal Template"> 
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   	<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.css"> 
    <!-- sets url to the theme folder: style.css --> 
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/page/error.css">
   	<!-- sets site title and page title on tab: if it is front page, display description-->  
    <title><?php is_front_page() ? bloginfo('description') : wp_title( '|', true,'right' ); ?> <?php bloginfo('name'); ?></title>
    <?php
    /* Add this to support sites with sites with threaded comments enabled.*/
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    ?>    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>