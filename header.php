<?php get_template_part('head');

// Main Menu
$main_nav_menu = wp_nav_menu( array(
    'theme_location' => 'main-nav',
    'echo' => FALSE,
    'container' => FALSE,
    'fallback_cb' => '__return_false'
) );

// Countries
$countries = get_terms([
    'taxonomy' => 'countries',
    'hide_empty' => false,
]);

?>
<body class="body--p-top">

<header class="header header--bg-transparent js-header header--mobile-3">
    <div class="container">

        <h1 class="header__logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/logo.svg" alt="<?php echo bloginfo('name'); ?>"></a></h1>

        <button class="btn-hamburger js-btn-hamburger"><span></span></button>
        
        <div class="header__menu js-header__menu">

            <div class="header__logo"><a href="<?php echo get_home_url(); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/logo.svg" alt="<?php echo bloginfo('name'); ?>"></a></div>
    
            <?php if ( ! empty ( $main_nav_menu ) ) { ?>
            <nav class="header__nav">
                <?php echo strip_tags(
                    preg_replace(array(
                    '#^<ul[^>]*>#',
                    '#</ul>$#'
                    ), '', $main_nav_menu)
                , '<a>' ); ?>
            </nav>
            <!--/header-nav-->
            <?php } ?>

            <?php if($countries) { ?>
            <div class="dropdown dropdown--select dropdown--language">
                <button class="dropdown__btn" id="btn-language-header">Selecione um pais <i class="icon-angle-down-regular"></i></button>
                <div class="dropdown__options" id="language-header">
                    <ul>
                        <?php foreach ($countries as $country) { ?>
                        <li><a data-country-code="<?php echo $country->slug; ?>" href="#"><?php echo $country->name; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/dropdown-options-->
            </div>
            <!--/dropdown-select-->
            <?php } ?>
            
        </div>
        <!--/header-menu-->
    </div>
    <!--/container-->
</header>
<!--/header-->
