<?php
/*
Plugin Name: Crawl Optimization
Plugin URI: https://www.bigtechies.com/
Description: Plugin to Remove Garbage which wastes crawl budget
Version: 1.1.5
Author: Big Techies
Author URI: https://www.bigtechies.com/crawl-optimization-plugin/
*/
add_filter( 'plugin_action_links_crawl-optimization/crawl-optimization.php', 'ultimatecrawloptimizer_settings_link' );

function ultimatecrawloptimizer_settings_link( $links ) {
	// Build and escape the URL.
	$url = esc_url( add_query_arg(
		'page',
		'crawloptimizations-settings',
		get_admin_url() . 'admin.php'
	) );
	// Create the link.
	$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
	// Adds the link to the end of the array.
	array_push(
		$links,
		$settings_link
	);
	return $links;
}
function ultimatecrawloptimizer_styles() {
  wp_enqueue_style( 'optimizer-styles', plugins_url( '/optimizer-style.css', __FILE__ ), array(), '1.0.0', 'all' );
}
add_action( 'admin_enqueue_scripts', 'ultimatecrawloptimizer_styles' );
function ultimatecrawloptimizer_load_custom_jquery() {
  if (!wp_script_is('jquery', 'enqueued')) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0');
      wp_enqueue_script('jquery');
  }
}
add_action('admin_enqueue_scripts', 'ultimatecrawloptimizer_load_custom_jquery');
function ultimatecrawloptimizer_scripts()
{
  
  wp_enqueue_script( 'optimizer-scripts', plugins_url( '/optimizer-java.js', __FILE__ ), array(), '1.0', true );
}
add_action('admin_enqueue_scripts', 'ultimatecrawloptimizer_scripts');
global $remove_feed;
$remove_feed = 0;
function ultimatecrawloptimizer_remove_feeds() {
  global $remove_feed;
  if ( get_option('ultimatecrawloptimizer_remove_global_feed') == 1 || get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_post_comments_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_post_authors_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_post_type_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_category_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_tag_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_search_results_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_atom_rdf_feeds') == 1){
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    $remove_feed = 1;
  }
}

add_action( 'init', 'ultimatecrawloptimizer_remove_feeds' );

function ultimatecrawloptimizer_register_setting_group($option_name)
{
  register_setting('ultimatecrawloptimizer_theme_options', $option_name);
}

add_action('admin_init', 'ultimatecrawloptimizer_register_setting');
function ultimatecrawloptimizer_remove_shortlink_link()
{
  if (get_option('ultimatecrawloptimizer_remove_shortlinks') == 1) {
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  }
}

add_action('wp_head', 'ultimatecrawloptimizer_remove_shortlink_link', 1);
function ultimatecrawloptimizer_remove_rest_api_links()
{
  if (get_option('ultimatecrawloptimizer_remove_rest_api_links') == 1) {
    remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
  }
}
add_action('wp_head', 'ultimatecrawloptimizer_remove_rest_api_links', 1);
// Remove query string from static resources

function ultimatecrawloptimizer_remove_rsd_wlw_links()
{
  if (get_option('ultimatecrawloptimizer_remove_rsd_wlw_links') == 1) {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_rsd_wlw_links', 1);

function ultimatecrawloptimizer_remove_oembed_links()
{
  if (get_option('ultimatecrawloptimizer_remove_oembed_links') == 1) {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_oembed_links', 1);

function ultimatecrawloptimizer_remove_generator_tag()
{
  if (get_option('ultimatecrawloptimizer_remove_generator_tag') == 1) {
    remove_action('wp_head', 'wp_generator');
    ob_start(function ($buffer) {
      $buffer = preg_replace('/<meta name="generator"(.*?)\/>/i', '', $buffer);
      return $buffer;
    });
  }
}
add_action('get_header', 'ultimatecrawloptimizer_remove_generator_tag');

function ultimatecrawloptimizer_remove_pingback_http_header($headers)
{
  if (get_option('ultimatecrawloptimizer_remove_pingback_http_header') == 1) {
    unset($headers['X-Pingback']);
  }
  return $headers;
}
add_filter('wp_headers', 'ultimatecrawloptimizer_remove_pingback_http_header', 10, 1);

function ultimatecrawloptimizer_remove_powered_by_http_header($headers)
{
  if (get_option('ultimatecrawloptimizer_remove_powered_by_http_header') == 1) {
    unset($headers['X-Powered-By']);
  }
  return $headers;
}
add_filter('wp_headers', 'ultimatecrawloptimizer_remove_powered_by_http_header', 10, 1);

add_action('init', 'ultimatecrawloptimizer_remove_homepage_feed');
function ultimatecrawloptimizer_remove_homepage_feed()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_global_feed') == 1) {
      
      
  }
   else if ($remove_feed == 1)  {
    add_action('wp_head', 'ultimatecrawloptimizer_add_global_rss_feed_link', 3);
  }
}
function ultimatecrawloptimizer_add_global_rss_feed_link()
    {
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Global RSS Feed" href="' . esc_url(home_url('/feed/')) . '" />';
    }
add_action('init', 'ultimatecrawloptimizer_remove_global_comment_feeds');
function ultimatecrawloptimizer_remove_global_comment_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1) {
      
      
  }
  else if ($remove_feed == 1) {
    
    add_action('wp_head', 'ultimatecrawloptimizer_add_global_comments_rss_link', 3);
  }
}
function ultimatecrawloptimizer_add_global_comments_rss_link()
    {
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Global Comments RSS Feed" href="' . ((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]") . '/comments/feed/" />';
    }
add_action('init', 'ultimatecrawloptimizer_remove_post_authors_feeds');
function ultimatecrawloptimizer_remove_post_authors_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_post_authors_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    
    add_action('wp_head', 'ultimatecrawloptimizer_add_author_rss_link', 3);
  }
}
function ultimatecrawloptimizer_add_author_rss_link()
    {
      if (is_author()) {
        $author = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($author->display_name) . ' Author RSS Feed" href="' . esc_url(get_author_feed_link($author->ID)) . '" />';
      }
    }
add_action('init', 'ultimatecrawloptimizer_remove_category_feeds');
function ultimatecrawloptimizer_remove_category_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_category_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    
    add_action('wp_head', 'ultimatecrawloptimizer_add_category_rss_link', 3);
  }
}
function ultimatecrawloptimizer_add_category_rss_link()
    {
      if (is_category()) {
        $category = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($category->name) . ' Category RSS Feed" href="' . esc_url(get_category_feed_link($category->term_id)) . '" />';
      }
    }
    add_action('init', 'ultimatecrawloptimizer_remove_post_comments_feeds');

    function ultimatecrawloptimizer_remove_post_comments_feeds()
    {
      global $remove_feed;
    
      if (get_option('ultimatecrawloptimizer_remove_post_comments_feeds') == 1) {
        // do nothing
      }
      else if ($remove_feed == 1)  {
        
          add_action('wp', 'ultimatecrawloptimizer_try_comments_rss_link');
        
      }
    }
function ultimatecrawloptimizer_try_comments_rss_link()
    {
      if (is_single()) {
      add_action('wp_head', 'ultimatecrawloptimizer_add_comments_rss_link', 3);
      }
    }
    function ultimatecrawloptimizer_add_comments_rss_link()
    {
      
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Comments RSS Feed" href="' . get_post_comments_feed_link() . '" />';
    }
add_action('init', 'ultimatecrawloptimizer_remove_tag_feeds');
function ultimatecrawloptimizer_remove_tag_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_tag_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    
    add_action('wp_head', 'ultimatecrawloptimizer_tag_rss_link', 3);
  }
}
function ultimatecrawloptimizer_tag_rss_link()
    {
      if (is_tag()) {
        $tag = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr( sanitize_text_field( $tag->name ) ) . ' Tag RSS Feed" href="' . esc_url( get_tag_feed_link( absint( $tag->term_id ) ) ) . '" />';
      }
    }
add_action('init', 'ultimatecrawloptimizer_remove_post_type_feeds');
function ultimatecrawloptimizer_remove_post_type_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_post_type_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    
    add_action('wp_head', 'ultimatecrawloptimizer_add_post_type_feed_links');
  }
}
function ultimatecrawloptimizer_add_post_type_feed_links()
    {
      $post_types = get_post_types(array('public' => true), 'objects');
      foreach ($post_types as $post_type) {
        if ($post_type->has_archive) {
          echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr(get_bloginfo('name') . ' - ' . $post_type->label . ' Feed') . '" href="' . esc_url(get_post_type_archive_feed_link($post_type->name)) . '" />';
        }
      }
    }
add_action('init', 'ultimatecrawloptimizer_remove_custom_taxonomy_feeds');
function ultimatecrawloptimizer_remove_custom_taxonomy_feeds()
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    
    add_action('wp_head', 'ultimatecrawloptimizer_taxonomy_rss_link', 3);
  }
}
function ultimatecrawloptimizer_taxonomy_rss_link()
    {
      if (is_tax('custom_taxonomy')) {
        $term = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($term->name) . ' custom_taxonomy RSS Feed" href="' . esc_url(get_term_feed_link($term->term_id, 'custom_taxonomy')) . '" />';
      }
    }
function ultimatecrawloptimizer_remove_search_results_feeds($query)
{
  global $remove_feed;
  if (get_option('ultimatecrawloptimizer_remove_search_results_feeds') == 1) {
  }
  else if ($remove_feed == 1)  {
    add_action('wp_head', 'ultimatecrawloptimizer_add_search_rss_link', 3);
  }
}
function ultimatecrawloptimizer_disable_search_results_feeds()
    {
      ?>
    <script>
      jQuery(document).ready(function($) {
        $('#ultimatecrawloptimizer_remove_search_results_feeds').prop('checked', true).prop('disabled', true);
      });
    </script>
    <?php
    }
add_action('pre_get_posts', 'ultimatecrawloptimizer_remove_search_results_feeds');

function ultimatecrawloptimizer_add_search_rss_link()
{
  if (is_search()) {
    $search_query = get_search_query();
    echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Search results for: ' . esc_attr($search_query) . ' RSS Feed" href="' . esc_url(get_search_feed_link($search_query)) . '" />';
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_atom_rdf_feeds');
function ultimatecrawloptimizer_remove_atom_rdf_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_atom_rdf_feeds') == 1) {
    add_action('wp_head', 'ultimatecrawloptimizer_remove_atom_rdf_feed', 3);
  }
}
function ultimatecrawloptimizer_remove_atom_rdf_feed()
{
  
    add_action('do_feed_rdf',  'disable_feeds', -1);
    add_action('do_feed_rss',  'disable_feeds', -1);
    add_action('do_feed_rss2', 'disable_feeds', -1);
    add_action('do_feed_atom', 'disable_feeds', -1);
}
add_action('init', 'ultimatecrawloptimizer_remove_emoji_scripts');
function ultimatecrawloptimizer_remove_emoji_scripts()
{
  if (get_option('ultimatecrawloptimizer_remove_emoji_scripts') == 1) {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  }
}
add_action('init', 'ultimatecrawloptimizer_filter_search_special_chars');

function ultimatecrawloptimizer_filter_search_special_chars() {
  if (get_option('ultimatecrawloptimizer_filter_special_characters') == 1) {
    add_action('pre_get_posts', 'remove_special_chars_from_search_url');
    add_action('pre_get_posts', 'remove_emojis_from_search_url');
  }
}

function remove_emojis_from_search_url($query) {
  if ($query->is_search() && isset($_GET['s'])) {
    $search_term = sanitize_text_field($_GET['s']);
    $emoji_regex = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F1E0}-\x{1F1FF}]/u';

    if (preg_match($emoji_regex, $search_term)) {
      $clean_search_term = preg_replace($emoji_regex, '', $search_term);
      $clean_search_term = esc_url(home_url("/?s=$clean_search_term"));
      wp_redirect($clean_search_term, 301);
      exit;
    }
  }
}

function remove_special_chars_from_search_url($query) {
  if ($query->is_search() && isset($_GET['s'])) {
    $search_term = sanitize_text_field($_GET['s']);
    $special_chars_regex = '/[^\p{L}\p{N}\s]/u';

    if (preg_match($special_chars_regex, $search_term)) {
      $clean_search_term = preg_replace($special_chars_regex, '', $search_term);
      $clean_search_term = esc_url(home_url("/?s=$clean_search_term"));
      wp_redirect($clean_search_term, 301);
      exit;
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_filter_search_spam');
function ultimatecrawloptimizer_filter_search_spam()
{
  if (get_option('ultimatecrawloptimizer_filter_spam_patterns') == 1) {
    add_action('pre_get_posts', 'remove_spammy_words_from_search_url');
  }
}

function remove_spammy_words_from_search_url($query) {
  if ($query->is_search() && isset($_GET['s'])) {
    $search_term = sanitize_text_field($_GET['s']);
    $search_term = esc_html($search_term);
    $spam_patterns = array("viagra", "cialis", "porn", "xxx", "casino", "dating", "gay", "gambling", "loan", "debt", "credit", "insurance", "forex");
    $spam_pattern_regex = '/\b(' . implode('|', array_map('preg_quote', $spam_patterns)) . '|(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,6})\b/i';

    if (preg_match($spam_pattern_regex, $search_term)) {
      $clean_search_term = preg_replace($spam_pattern_regex, '', $search_term);
      $clean_search_term = sanitize_text_field($clean_search_term);
      wp_redirect(home_url("/?s=$clean_search_term"), 301);
      exit;
    }
  }
}

function ultimatecrawloptimizer_search_redirect()
{
  if (get_option('ultimatecrawloptimizer_redirect_pretty_urls') == 1) {
    $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
    preg_match('/\/search\/(.*?)\/*$/', $request_uri, $matches);
    if (count($matches) > 1) {
      $search_query = sanitize_text_field(rtrim($matches[1], '/'));
      $search_query = esc_html($search_query);
      $redirect_url = home_url('/?s=' . $search_query);
      wp_redirect($redirect_url, 301);
      exit;
    }
  }
}
add_action( 'template_redirect', 'ultimatecrawloptimizer_search_redirect' );
add_action('init', 'ultimatecrawloptimizer_limit_search_characters');
function ultimatecrawloptimizer_limit_search_characters()
{
  if (isset($_GET['s']) && strlen($_GET['s']) > get_option('ultimatecrawloptimizer_max_search_characters')) {
    wp_redirect(home_url("?s=") . substr($_GET['s'], 0, get_option('ultimatecrawloptimizer_max_search_characters')));
    exit();
  }
}
add_option('ultimatecrawloptimizer_max_search_characters', 50);
function ultimatecrawloptimizer_redirect_utm_to_hash()
{
  if (get_option('ultimatecrawloptimizer_optimize_ga_utm_params') == 1) {
    if (isset($_SERVER['REQUEST_URI'])) {
      $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
      if (strpos($request_uri, '?utm_') !== false) {
        $redirect_url = preg_replace('/\?utm_/', '#utm_', $request_uri);
        if (strcmp($request_uri, $redirect_url) !== 0) {
          wp_redirect($redirect_url, 301);
          exit;
        }
      }
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_redirect_utm_to_hash');

function ultimatecrawloptimizer_redirect_remove_params() {
  $remove_params = get_option('ultimatecrawloptimizer_remove_unregistered_url_params');
  if (isset($_GET) && count($_GET) > 0 && $remove_params == 1 ) {
  $query_string = sanitize_text_field(wp_unslash($_SERVER['QUERY_STRING']));
  $new_url = esc_url_raw(strtok(wp_unslash($_SERVER['REQUEST_URI']), '?'));
  wp_redirect($new_url, 301);
  exit();
  }
}
add_action( 'template_redirect', 'ultimatecrawloptimizer_redirect_remove_params' );
add_action( 'template_redirect', 'ultimatecrawloptimizer_redirect_remove_params' );
function disable_checkbox_based_on_plugins() {
  // Check if any of the plugins or themes are active
  $active_plugins = array(
    'elementor/elementor.php',
    'js_composer/js_composer.php',
    'seed-prod/seed-prod.php',
    'thrive-visual-editor/thrive-visual-editor.php',
    'beaver-builder-lite-version/fl-builder.php',
    'divi/divi.php',
    'woocommerce/woocommerce.php'
  );

  $theme = wp_get_theme();

  if ($theme->get( 'Name' ) == 'Divi' || $theme->get( 'Template' ) == 'Divi') {
    $divi_active = true;
  } else {
    $divi_active = false;
  }

  $woocommerce_active = is_plugin_active('woocommerce/woocommerce.php');

  $any_plugin_active = false;

  foreach ($active_plugins as $plugin) {
    if (is_plugin_active($plugin)) {
      $any_plugin_active = true;
      break;
    }
  }

  // Uncheck and disable the checkbox if any of the plugins or themes are active
  if ($any_plugin_active || $divi_active || $woocommerce_active) {
    ?>
    <script>
      jQuery(document).ready(function($) {
        $('#ultimatecrawloptimizer_remove_unregistered_url_params').prop('checked', false).prop('disabled', true);
      });
    </script>
    <?php
  }
}
add_action( 'admin_footer', 'disable_checkbox_based_on_plugins' );
include_once(plugin_dir_path( __FILE__ ) . "/optimizer/optimizer.php");
include_once(plugin_dir_path( __FILE__ ) . "/optimizer/crawl-optimizer.php");