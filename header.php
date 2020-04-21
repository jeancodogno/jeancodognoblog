<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head <?php language_attributes(); ?>>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
        
        <?php
            $description = get_the_excerpt(get_the_ID());
            $description = $description != ''?$description:bloginfo('description');
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>

        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?=get_the_title(); ?> - <?=bloginfo( 'name' ); ?>" />
        <meta property="og:url" content="<?=$actual_link;?>" />
        <meta property="og:description" content="<?=$description;?>" />

        <meta name="description" content="<?=$description;?>">
        <meta name="author" content="<?=bloginfo( 'author' ); ?>">

        <title><?=wp_title(); ?> - <?=bloginfo( 'name' ); ?></title>
        
        <link rel='stylesheet' href='<?=get_template_directory_uri();?>/vendor/fontawesome/css/fontawesome.min.css'>
        <link rel='stylesheet' href='<?=get_template_directory_uri();?>/vendor/bootstrap/css/bootstrap.css'>
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/vendor/prism/prism.css">
        <link rel="stylesheet" href="<?=get_template_directory_uri();?>/css/style.css">


        <script src="<?=get_template_directory_uri();?>/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src='<?=get_template_directory_uri();?>/vendor/fontawesome/js/all.min.js'></script>
        <script src='<?=get_template_directory_uri();?>/vendor/bootstrap/js/bootstrap.min.js'></script>
        <script src='<?=get_template_directory_uri();?>/vendor/prism/prism.js'></script>
        <script src='<?=get_template_directory_uri();?>/js/main.js'></script>

        <?php 
            wp_head(); 
        ?>

    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>