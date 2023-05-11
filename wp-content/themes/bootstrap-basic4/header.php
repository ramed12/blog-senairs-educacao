<?php

/**
 * The theme header.
 * 
 * @package bootstrap-basic4
 */

$container_class = apply_filters('bootstrap_basic4_container_class', 'container');
if (!is_scalar($container_class) || empty($container_class)) {
    $container_class = 'container';
}
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- <meta name="key-instagram" content="<?php echo constant('INSTA_KEY') ?>"> -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--WordPress head-->
    <?php wp_head(); ?>
    <!--end WordPress head-->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/accordion.css'; ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/style2.css'; ?>">

</head>

<body>
    <header class="header_senai">
        <nav class="menu-institucional-container-blog">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <ul class="blog-menu">
                            <li><a href="https://www.fiergs.org.br/" target="https://www.fiergs.org.br/">FIERGS</a></li>
                            <li><a href="https://www.sesirs.org.br/" target="https://sesirs.org.br/">SESI</a></li>
                            <li class="ativo-casa"><a href="https://www.senairs.org.br/" target="https://www.senairs.org.br/">SENAI</a></li>
                            <li><a href="https://www.ielrs.org.br/" target="https://iel.org.br/"> IEL</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 offset-sm-1 col-12 d-none d-sm-block text-center text-white title-header">Blog SENAI Educação</div>
                </div>
            </div>
        </nav>

        <?php require_once  __DIR__ . "/inc/menu.php"; ?>
        <?php if (has_nav_menu('primary') || is_active_sidebar('navbar-right')) { ?>
            <div class="container d-none">
                <div class="row main-navigation">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bootstrap-basic4-topnavbar" aria-controls="bootstrap-basic4-topnavbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'bootstrap-basic4'); ?>">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="bootstrap-basic4-topnavbar" class="collapse navbar-collapse">
                                <?php
                                wp_nav_menu(
                                    [
                                        'depth' => '2',
                                        'theme_location' => 'primary',
                                        'container' => false,
                                        'menu_id' => 'bb4-primary-menu',
                                        'menu_class' => 'navbar-nav mr-auto',
                                        'walker' => new \BootstrapBasic4\BootstrapBasic4WalkerNavMenu()
                                    ]
                                );
                                ?>
                                <div class="float-lg-right">
                                    <?php dynamic_sidebar('navbar-right'); ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--.navbar-collapse-->
                            <div class="clearfix"></div>
                        </nav>
                    </div>
                </div>
                <!--.main-navigation-->
            </div>
        <?php } else { ?>
            <!-- the navigation is skipped due to there is no menu or active widgets on navbar-right. -->
        <?php } // endif; 
        ?>
    </header>