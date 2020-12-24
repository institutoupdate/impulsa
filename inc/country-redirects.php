<?php
function impulsa_get_current_country() {
  $current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

  $countries = get_terms([
      'taxonomy' => 'countries',
      'hide_empty' => false,
  ]);

  if(count($countries) == 1) {
    $country_code = get_field('country_code', 'term_' . $countries[0]->term_id);
    $current_country = $country_code;
    $current_country_slug = $countries[0]->slug;
  }

  return $current_country;
}
function country_redirects() {

    global $wp;
    $permalink = home_url( $wp->request ).'/';

    $current_country = impulsa_get_current_country();

    $countries = get_terms([
        'taxonomy' => 'countries',
        'hide_empty' => false,
    ]);

    if(count($countries) == 1) {
      $country_code = get_field('country_code', 'term_' . $countries[0]->term_id);
      $current_country = $country_code;
      $current_country_slug = $countries[0]->slug;
    }

    if( $current_country ) {

        if($countries && !$country_code) {
            foreach ($countries as $country) {
                $country_code = get_field('country_code', 'term_' . $country->term_id);
                if($country_code === $current_country) {
                    $current_country_slug = $country->slug;
                }
            }
        }

        $country = get_term_by('slug', $current_country_slug, 'countries');

        if ($country) {
            $country_name = $country->name;
            $country_slug = $country->slug;
            $country_code = get_field('lang_code', 'term_' . $country->term_id);
            $country_code = strtolower($country_code);

            $translations = pll_the_languages(array('raw'=>1));
            $translation_url_slug = $translations[$country_code]['slug'];
            $translation_url_selected = $translations[$country_code]['url'];
        }

        if(pll_current_language() != $country_code) {
          setcookie("pll_language", $translation_url_slug, 0);
          wp_redirect($translation_url_selected);
          exit;
        }

    } else {
        $userIP = getUserIP();

        $getCountry = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$userIP));
        $getCountryStatus = $getCountry['geoplugin_status'];

        if($getCountryStatus !== 404) {

            $getCountryCode = $getCountry['geoplugin_countryCode'];

            $countries = get_terms([
                'taxonomy' => 'countries',
                'hide_empty' => false,
            ]);
            $countriesCodes = array();
            if($countries) {
                foreach ($countries as $country) {
                    $countryCode = get_field('country_code', 'term_' . $country->term_id);
                    array_push($countriesCodes, $countryCode);
                }
            }
            $getCountryName = $getCountry['geoplugin_countryName'];

            if (in_array($getCountryCode, $countriesCodes)) {
                setcookie("current_country", $getCountryCode, time() + 60*60*24*30, '/');
                wp_redirect(get_home_url());
                exit;
            } else {
                if(!is_page_template('page-templates/select-language.php')) {
                    wp_redirect(get_page_url('page-templates/select-language'));
                    exit;
                }
            }

        } else {
            if(!is_page_template('page-templates/select-language.php')) {
                wp_redirect(get_page_url('page-templates/select-language'));
                exit;
            }
        }

    }
}
add_action( 'template_redirect', 'country_redirects' );
