<?php get_template_part('head');

$current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

// Main Menu
$main_nav_menu = wp_nav_menu( array(
    'theme_location' => 'main-nav-' . strtolower($current_country),
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

            <?php if($countries && count($countries) > 1) { ?>
            <div class="language">
                <div class="input input--btn">
                    <div class="input__select">
                        <select name="data-language" class="js-change-country">
                            <?php foreach ($countries as $country) {
                                $countryCode = get_field('country_code', 'term_' . $country->term_id);
                            ?>
                            <option <?php if($current_country === $countryCode) { echo 'selected'; } ?> value="<?php echo $countryCode; ?>"><?php echo $country->name; ?></option>
                            <?php } ?>
                        </select>
                        <i class="icon-angle-down-regular"></i>
                    </div>
                    <!--/input-select-->
                </div>
                <!--/input-btn-->
                </div>
            <?php } ?>

        </div>
        <!--/header-menu-->
    </div>
    <!--/container-->
</header>
<!--/header-->
