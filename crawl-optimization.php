<?php
/*
Plugin Name: Crawl Optimization
Plugin URI: https://www.bigtechies.com/
Description: Plugin to Remove Garbage which wastes crawl budget
Version: 1.2
Author: Big Techies
Author URI: https://www.bigtechies.com/crawl-optimization-plugin/
*/
function ultimatecrawloptimizer_styles()
{
  echo '<link rel="stylesheet" type="text/css" href="'.plugins_url( '/optimizer-style.css', __FILE__ ).'">';
}
add_action('admin_head', 'ultimatecrawloptimizer_styles');

function ultimatecrawloptimizer_scripts()
{
  
  echo '<script src="'.plugins_url( '/optimizer-java.js', __FILE__ ).'"></script>';
}
add_action('admin_footer', 'ultimatecrawloptimizer_scripts');

function ultimatecrawloptimizer_load_custom_jquery()
{
  wp_deregister_script('jquery');
  wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0');
  wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'ultimatecrawloptimizer_load_custom_jquery');
function ultimatecrawloptimizer_remove_feeds()
{
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'ultimatecrawloptimizer_remove_feeds');

if (isset($_POST['ultimatecrawloptimizer_allowed_url_params'])) {
  $allowed_parameters = explode(',', $_POST['ultimatecrawloptimizer_allowed_url_params']);
  ultimatecrawloptimizer_remove_unknown_parameters($allowed_parameters);
}

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
function ultimatecrawloptimizer_remove_cssjs_ver($src)
{
  if (get_option('ultimatecrawloptimizer_enable_querystrings') == 1) {
    if (strpos($src, '?ver='))
      $src = remove_query_arg('ver', $src);
  }
  return $src;
}

add_filter('style_loader_src', 'ultimatecrawloptimizer_remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'ultimatecrawloptimizer_remove_cssjs_ver', 10, 2);

function ultimatecrawloptimizer_disable_plugin_theme_editor()
{
  if (get_option('ultimatecrawloptimizer_disable_plugin_theme_editor') == 1) {
    define('DISALLOW_FILE_EDIT', true);
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
  }
}
add_action('admin_menu', 'ultimatecrawloptimizer_disable_plugin_theme_editor', 1);

function ultimatecrawloptimizer_create_wp_content_htaccess()
{
  $htaccess_file1 = WP_CONTENT_DIR . '/.htaccess';
  $htaccess_content1 = "<Files *.php>\ndeny from all\n<Files>";

  if (get_option('ultimatecrawloptimizer_disable_wpcontent_php') == 1) {
    if (!file_exists($htaccess_file1)) {
      file_put_contents($htaccess_file1, $htaccess_content1);
    }
  } else {
    if (file_exists($htaccess_file1)) {
      unlink($htaccess_file1);
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_create_wp_content_htaccess');

function ultimatecrawloptimizer_create_wp_includes_htaccess()
{
  $htaccess_file2 = ABSPATH . 'wp-includes/.htaccess';
  $htaccess_content2 = "<Files *.php>\ndeny from all\n<Files>";

  if (get_option('ultimatecrawloptimizer_disable_includes_php') == 1) {
    if (!file_exists($htaccess_file2)) {
      file_put_contents($htaccess_file2, $htaccess_content2);
    }
  } else {
    if (file_exists($htaccess_file2)) {
      unlink($htaccess_file2);
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_create_wp_includes_htaccess');

function ultimatecrawloptimizer_create_wp_uploads_htaccess()
{
  $htaccess_file3 = ABSPATH . 'wp-content/uploads/.htaccess';
  $htaccess_content3 = "<Files *.php>\ndeny from all\n<Files>";

  if (get_option('ultimatecrawloptimizer_disable_uploads_php') == 1) {
    if (!file_exists($htaccess_file3)) {
      file_put_contents($htaccess_file3, $htaccess_content3);
    }
  } else {
    if (file_exists($htaccess_file3)) {
      unlink($htaccess_file3);
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_create_wp_uploads_htaccess');

function ultimatecrawloptimizer_replace_http_with_https($content)
{
  if (get_option('ultimatecrawloptimizer_disable_mixed_content') == 1) {
    if (is_ssl()) {
      $content = str_replace("http://", "https://", $content);
    }
  }
  return $content;
}
add_filter('content_url', 'ultimatecrawloptimizer_replace_http_with_https');
add_filter('plugins_url', 'ultimatecrawloptimizer_replace_http_with_https');
add_filter('site_url', 'ultimatecrawloptimizer_replace_http_with_https');
add_filter('stylesheet_directory_uri', 'ultimatecrawloptimizer_replace_http_with_https');
add_filter('template_directory_uri', 'ultimatecrawloptimizer_replace_http_with_https');

function ultimatecrawloptimizer_custom_login_error_messages()
{
  if (get_option('ultimatecrawloptimizer_prevent_exposed_login_feedback') == 1) {
    return '<strong>ERROR</strong>: Invalid login credentials.';
  }
}
function ultimatecrawloptimizer_clear_login_details_js()
{
  echo '<script>document.getElementById("user_login").value="";document.getElementById("user_email").value="";</script>';
}
function ultimatecrawloptimizer_clear_login_details()
{
  if (get_option('ultimatecrawloptimizer_prevent_exposed_login_feedback') == 1) {
    add_action('login_head', 'ultimatecrawloptimizer_clear_login_details_js');
    add_filter('login_errors', 'ultimatecrawloptimizer_custom_login_error_messages');
  }
}
add_action('login_head', 'ultimatecrawloptimizer_clear_login_details');

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
  if (get_option('ultimatecrawloptimizer_remove_global_feed') == 1) {
  } else {
    function ultimatecrawloptimizer_add_global_rss_feed_link()
    {
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Global RSS Feed" href="' . esc_url(home_url('/feed/')) . '" />';
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_global_rss_feed_link', 3);
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_global_comment_feeds');
function ultimatecrawloptimizer_remove_global_comment_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_add_global_comments_rss_link()
    {
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Global Comments RSS Feed" href="' . ((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]") . '/comments/feed/" />';
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_global_comments_rss_link', 3);
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_authors_feeds');
function ultimatecrawloptimizer_remove_post_authors_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_post_authors_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_add_author_rss_link()
    {
      if (is_author()) {
        $author = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($author->display_name) . ' Author RSS Feed" href="' . esc_url(get_author_feed_link($author->ID)) . '" />';
      }
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_author_rss_link', 3);
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_category_feeds');
function ultimatecrawloptimizer_remove_category_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_category_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_add_category_rss_link()
    {
      if (is_category()) {
        $category = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($category->name) . ' Category RSS Feed" href="' . esc_url(get_category_feed_link($category->term_id)) . '" />';
      }
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_category_rss_link', 3);
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_comments_feeds');
function ultimatecrawloptimizer_remove_post_comments_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_post_comments_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_add_comments_rss_link()
    {
      echo "\n" . '<link rel="alternate" type="application/rss+xml" title="Comments RSS Feed" href="' . get_post_comments_feed_link() . '" />';
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_comments_rss_link', 3);
  }
}

add_action('init', 'ultimatecrawloptimizer_remove_tag_feeds');
function ultimatecrawloptimizer_remove_tag_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_tag_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_tag_rss_link()
    {
      if (is_tag()) {
        $tag = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($tag->name) . ' Tag RSS Feed" href="' . esc_url(get_tag_feed_link($tag->term_id)) . '" />';
      }
    }
    add_action('wp_head', 'ultimatecrawloptimizer_tag_rss_link', 3);
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_type_feeds');
function ultimatecrawloptimizer_remove_post_type_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_post_type_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_add_post_type_feed_links()
    {
      $post_types = get_post_types(array('public' => true), 'objects');
      foreach ($post_types as $post_type) {
        if ($post_type->has_archive) {
          echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr(get_bloginfo('name') . ' - ' . $post_type->label . ' Feed') . '" href="' . esc_url(get_post_type_archive_feed_link($post_type->name)) . '" />';
        }
      }
    }
    add_action('wp_head', 'ultimatecrawloptimizer_add_post_type_feed_links');
  }
}
add_action('init', 'ultimatecrawloptimizer_remove_custom_taxonomy_feeds');
function ultimatecrawloptimizer_remove_custom_taxonomy_feeds()
{
  if (get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds') == 1) {
  } else {
    function ultimatecrawloptimizer_taxonomy_rss_link()
    {
      if (is_tax('custom_taxonomy')) {
        $term = get_queried_object();
        echo "\n" . '<link rel="alternate" type="application/rss+xml" title="' . esc_attr($term->name) . ' custom_taxonomy RSS Feed" href="' . esc_url(get_term_feed_link($term->term_id, 'custom_taxonomy')) . '" />';
      }
    }
    add_action('wp_head', 'ultimatecrawloptimizer_taxonomy_rss_link', 3);
  }
}
function ultimatecrawloptimizer_remove_search_results_feeds($query)
{
  if (get_option('ultimatecrawloptimizer_remove_search_results_feeds') == 1) {
    // do nothing
  } else {
    add_action('wp_head', 'ultimatecrawloptimizer_add_search_rss_link', 3);
  }
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
    add_action('do_feed_rdf',  'disable_feeds', -1);
    add_action('do_feed_rss',  'disable_feeds', -1);
    add_action('do_feed_rss2', 'disable_feeds', -1);
    add_action('do_feed_atom', 'disable_feeds', -1);
  }
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
function ultimatecrawloptimizer_filter_search_special_chars()
{
  if (get_option('ultimatecrawloptimizer_filter_special_characters') == 1) {
    add_filter('get_search_query', 'ultimatecrawloptimizer_remove_special_chars');
  }
}
function ultimatecrawloptimizer_remove_special_chars($query)
{
  $special_chars = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "+", "=", "[", "]", "{", "}", "|", "\\", ";", ":", "'", "\"", ",", "<", ".", ">", "/", "?",);
  $query = str_replace($special_chars, "", $query);
  $query = mb_ereg_replace("[\x{1F600}-\x{1F64F}]", '', $query);
  return $query;
}

add_action('init', 'ultimatecrawloptimizer_filter_search_spam');
function ultimatecrawloptimizer_filter_search_spam()
{
  if (get_option('ultimatecrawloptimizer_filter_spam_patterns') == 1) {
    add_filter('get_search_query', 'ultimatecrawloptimizer_remove_spam_patterns');
  }
}
function ultimatecrawloptimizer_remove_spam_patterns($query)
{
  $spam_patterns = array("viagra", "cialis", "porn", "xxx", "casino", "gambling", "loan", "debt", "credit", "insurance", "forex");
  $query = str_ireplace($spam_patterns, "", $query);
  return $query;
}

function ultimatecrawloptimizer_search_redirect()
{
  if (get_option('ultimatecrawloptimizer_redirect_pretty_urls') == 1) {
    preg_match('/\/search\/(.*?)\/*$/', $_SERVER['REQUEST_URI'], $matches);
    if (count($matches) > 1) {
      $search_query = rtrim($matches[1], '/');
      $redirect_url = '/?' . 's=' . $search_query;
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
    if (strpos($_SERVER['REQUEST_URI'], '?utm_') !== false) {
      $redirect_url = preg_replace('/\?utm_/', '#utm_', $_SERVER['REQUEST_URI']);
      if (strcmp($_SERVER['REQUEST_URI'], $redirect_url) !== 0) {
        wp_redirect($redirect_url, 301);
        exit;
      }
    }
  }
}
add_action('init', 'ultimatecrawloptimizer_redirect_utm_to_hash');
add_action('template_redirect', 'ultimatecrawloptimizer_redirect_feed');

function ultimatecrawloptimizer_redirect_feed()
{
  if (get_option('ultimatecrawloptimizer_redirect_feed') == 1) {
    if (is_feed()) {
      global $wp_query;
      $post_id = $wp_query->get_queried_object_id();
      $post_permalink = get_permalink($post_id);
      wp_redirect($post_permalink, 301);
      exit;
    }
  }
}
add_action('template_redirect', 'ultimatecrawloptimizer_remove_unknown_parameters');
function ultimatecrawloptimizer_remove_unknown_parameters()
{
  if (!empty($unknown_parameters) && get_option('ultimatecrawloptimizer_remove_unregistered_url_params') == 1) {
  $valid_parameters = array('s', 'p');
  // Get the allowed parameters from the database
  $allowed_parameters = explode(',', get_option('ultimatecrawloptimizer_allowed_url_params'));
  // Merge the allowed parameters with the valid parameters
  $valid_parameters = array_merge($valid_parameters, $allowed_parameters);
  $current_parameters = array_keys($_GET);
  $unknown_parameters = array_diff($current_parameters, $valid_parameters);
    $redirect_url = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
    wp_redirect($redirect_url, 301);
    exit;
  }
}
include_once(plugin_dir_path( __FILE__ ) . "/optimizer/optimizer.php");
include_once(plugin_dir_path( __FILE__ ) . "/optimizer/crawl-optimizer.php");