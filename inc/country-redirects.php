<?php

class Impulsa_Country {
  public $current_country;
  public $current_country_term;
  public $current_language;
  public $front_page;
  public $countries_front_pages;
  public function __construct() {
    add_action("init", array($this, "init"), 15);
    add_action("template_redirect", array($this, "template_redirect"), 10);
		// Integration with WP customizer
		add_action( 'customize_register', array( $this, 'create_nav_menu_locations' ), 6 );
  }
  public function init() {
    $this->current_country = $this->get_current_country();
    $this->current_country_term = $this->get_current_country_term();
    if($this->current_country_term) {
      $this->current_language = strtolower(get_field('lang_code', 'term_' . $this->current_country_term->term_id));
    }
    $this->front_page = $this->get_front_page();
    $this->setup_frontpages();
  }
  protected function setup_frontpages() {
    $countries = get_terms(array(
      "taxonomy" => "countries",
      "hide_empty" => false
    ));
    $this->countries_front_pages = array();
    foreach($countries as $term) {
      $code = get_field("country_code", "term_" . $term->term_id);
      $this->countries_front_pages[$code] = $this->get_country_front_page($code);
    }
  }
  public function get_country_front_page($country) {
    $countries = get_terms(array(
      "taxonomy" => "countries",
      "hide_empty" => false
    ));
    foreach ($countries as $term) {
      $code = get_field("country_code", "term_" . $term->term_id);
      $lang = get_field("lang_code", "term_" . $term->term_id);
      if ($code == $country) {
        $country_term = $term;
        $country_lang = strtolower($lang);
      }
    }
    $query = new WP_Query(array(
      "post_type" => "page",
      "posts_per_page" => "1",
      "lang" => $country_lang,
      "meta_query" => array(
        array(
          "key" => "_wp_page_template",
          "value" => "page-templates/front-page.php",
          "compare" => "IN"
        )
      ),
      "tax_query" => array(
        array(
          "taxonomy" => "countries",
          "field" => "term_id",
          "terms" => $country_term->term_id,
          "operator" => "IN"
        )
      )
    ));
    if ($query->post) {
      return $query->post->ID;
    }
    return false;
  }
  public function get_front_page() {
    return $this->get_country_front_page($this->current_country);
  }
  public function get_current_country() {
    $countries = get_terms([
      'taxonomy' => 'countries',
      'hide_empty' => false,
    ]);

    $current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

    if (!$current_country && is_single()) {
      global $post;
      $post_countries = wp_get_post_terms($post->ID, "countries");
      if (!empty($post_countries)) {
        $current_country = get_field('country_code', 'term_' . $post_countries[0]->term_id);
      }
    }

    if (!$current_country && count($countries) == 1) {
      $current_country = get_field('country_code', 'term_' . $countries[0]->term_id);
    }

    return $current_country;
  }
  public function get_current_country_term() {
    $country = $this->current_country;
    $countries = get_terms(array(
      'taxonomy' => 'countries',
      'hide_empty' => false,
    ));
    foreach ($countries as $term) {
      $code = get_field("country_code", "term_" . $term->term_id);
      if ($code == $country) {
        return $term;
      }
    }
  }
  public function theme_mod_nav_menu_locations( $menus ) {
    // Prefill locations with 0 value in case a location does not exist in $menus
    $locations = get_registered_nav_menus();
    if ( is_array( $locations ) ) {
      $locations = array_fill_keys( array_keys( $locations ), 0 );
      $menus = is_array( $menus ) ? array_merge( $locations, $menus ) : $locations;
    }

    if ( is_array( $menus ) ) {
      foreach ( array_keys( $menus ) as $loc ) {
        foreach ( $this->countries_front_pages as $country => $page_id ) {
          if ( ! empty( $this->options['nav_menus'][ $this->theme ][ $country ][ $lang->slug ] ) ) {
            $menus[$country] = $this->options['nav_menus'][ $this->theme ][ $loc ][ $lang->slug ];
          }
        }
      }
    }

    return $menus;
  }
  public function create_nav_menu_locations() {
    static $once;
    global $_wp_registered_nav_menus;

    $arr = array();

    if ( isset( $_wp_registered_nav_menus ) && ! $once ) {
      foreach ( $_wp_registered_nav_menus as $loc => $name ) {
        foreach ( $this->countries_front_pages as $country => $page_id ) {
          $arr[$country] = $name . ' ' . $country;
        }
      }

      $_wp_registered_nav_menus = $arr;
      $once = true;
    }
  }
  public function template_redirect() {
    $referer_url_host = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);

    // Do not redirect external links to single content
    if (
      (
        !$_SERVER["HTTP_REFERER"] ||
        $referer_url_host != $_SERVER["SERVER_NAME"]
      ) &&
      is_singular(array("track", "materials", "post", "page")) &&
      !is_front_page()
    ) {
      return;
    }

    // Do not redirect if navigating inside track materials
    $referer_url_query = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_QUERY);
    parse_str($referer_url_query, $referer_query);
    if ($referer_query && $referer_query["track"] && $referer_query["track"] == $_GET["track"]) {
      return;
    }

    global $wp;
    $permalink = home_url($wp->request).'/';

    $current_country = $this->current_country;

    $page_id = get_queried_object_id();
    if(is_front_page() || ($page_id && in_array($page_id, $this->countries_front_pages))) {
      if($page_id !== $this->countries_front_pages[$current_country] && $current_country) {
        wp_redirect(get_permalink($this->countries_front_pages[$current_country]));
        exit;
      }
    }

    $countries = get_terms([
      'taxonomy' => 'countries',
      'hide_empty' => false,
    ]);

    if ($current_country) {
      if ($countries && !$country_code) {
        foreach ($countries as $country) {
          $country_code = get_field('country_code', 'term_' . $country->term_id);
          if ($country_code === $current_country) {
            $current_country_slug = $country->slug;
          }
        }
      }

      $country = get_term_by('slug', $current_country_slug, 'countries');

      if ($country) {
        $country_name = $country->name;
        $country_slug = $country->slug;
        $lang_code = get_field('lang_code', 'term_' . $country->term_id);
        $lang_code = strtolower($lang_code);

        $translations = pll_the_languages(array('raw'=>1));
        $translation_url_slug = $translations[$lang_code]['slug'];
        $translation_url_selected = $translations[$lang_code]['url'];
      }

      if (pll_current_language() != $lang_code) {
        setcookie("pll_language", $translation_url_slug, 0);
        wp_redirect($translation_url_selected);
        exit;
      }
    } else {
      $userIP = getUserIP();

      $getCountry = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$userIP));
      $getCountryStatus = $getCountry['geoplugin_status'];

      if ($getCountryStatus !== 404) {
        $getCountryCode = $getCountry['geoplugin_countryCode'];

        $countries = get_terms([
          'taxonomy' => 'countries',
          'hide_empty' => false,
        ]);
        $countriesCodes = array();
        if ($countries) {
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
          if (!is_page_template('page-templates/select-language.php')) {
            wp_redirect(get_page_url('page-templates/select-language'));
            exit;
          }
        }
      } else {
        if (!is_page_template('page-templates/select-language.php')) {
          wp_redirect(get_page_url('page-templates/select-language'));
          exit;
        }
      }
    }
  }
}

$GLOBALS["impulsa_country"] = new Impulsa_Country();

function impulsa_get_current_country() {
  return $GLOBALS["impulsa_country"]->current_country;
}

function impulsa_get_current_country_term() {
  return $GLOBALS["impulsa_country"]->current_country_term;
}

function impulsa_get_current_front_page() {
  return $GLOBALS["impulsa_country"]->front_page;
}

function impulsa_get_countries_front_pages() {
  return $GLOBALS["impulsa_country"]->countries_front_pages;
}
