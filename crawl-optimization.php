<?php
/*
Plugin Name: Crawl Optimization
Plugin URI: https://www.bigtechies.com/
Description: Plugin to Remove Garbage which wastes crawl budget
Version: 1.2.4
Author: Big Techies
Author URI: https://www.bigtechies.com/crawl-optimization-plugin/
*/
add_filter('plugin_action_links_crawl-optimization/crawl-optimization.php', 'ultimatecrawloptimizer_settings_link');

function ultimatecrawloptimizer_settings_link($links)
{
    // Build and escape the URL.
    $url = esc_url(add_query_arg('page', 'crawloptimizations-settings', get_admin_url() . 'admin.php'));
    // Create the link.
    $settings_link = "<a href='$url'>" . __('Settings') . '</a>';
    // Adds the link to the end of the array.
    array_push($links, $settings_link);
    return $links;
}
function ultimatecrawloptimizer_styles()
{
    wp_enqueue_style('optimizer-styles', plugins_url('/optimizer-style.css', __FILE__) , array() , '1.0.0', 'all');
}
add_action('admin_enqueue_scripts', 'ultimatecrawloptimizer_styles');
function ultimatecrawloptimizer_scripts()
{

    wp_enqueue_script('optimizer-scripts', plugins_url('/optimizer-java.js', __FILE__) , array() , '1.0', true);
}
add_action('admin_enqueue_scripts', 'ultimatecrawloptimizer_scripts');

function ultimatecrawloptimizer_register_setting_group($option_name)
{
    register_setting('ultimatecrawloptimizer_theme_options', $option_name);
}

add_action('admin_init', 'ultimatecrawloptimizer_register_setting');
function ultimatecrawloptimizer_remove_shortlink_link()
{
    if (get_option('ultimatecrawloptimizer_remove_shortlinks') == 1)
    {
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('template_redirect', 'wp_shortlink_header', 11);
    }
}

add_action('wp_head', 'ultimatecrawloptimizer_remove_shortlink_link', 1);
function ultimatecrawloptimizer_remove_rest_api_links()
{
    if (get_option('ultimatecrawloptimizer_remove_rest_api_links') == 1)
    {
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('template_redirect', 'rest_output_link_header', 11);
    }
}
add_action('wp_head', 'ultimatecrawloptimizer_remove_rest_api_links', 1);
// Remove query string from static resources
function ultimatecrawloptimizer_remove_rsd_wlw_links()
{
    if (get_option('ultimatecrawloptimizer_remove_rsd_wlw_links') == 1)
    {
        remove_action('wp_head', 'rsd_link');
        remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
        remove_action('wp_head', 'wlwmanifest_link');
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_rsd_wlw_links', 1);

function ultimatecrawloptimizer_remove_oembed_links()
{
    if (get_option('ultimatecrawloptimizer_remove_oembed_links') == 1)
    {
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_oembed_links', 1);

function ultimatecrawloptimizer_remove_generator_tag()
{
    if (get_option('ultimatecrawloptimizer_remove_generator_tag') == 1)
    {
        remove_action('wp_head', 'wp_generator');
        ob_start(function ($buffer)
        {
            $buffer = preg_replace('/<meta name="generator"(.*?)\/>/i', '', $buffer);
            return $buffer;
        });
    }
}
add_action('get_header', 'ultimatecrawloptimizer_remove_generator_tag');

function ultimatecrawloptimizer_remove_pingback_http_header($headers)
{
    if (get_option('ultimatecrawloptimizer_remove_pingback_http_header') == 1)
    {
        header_remove('X-Pingback');
    }
}
add_filter('wp_headers', 'ultimatecrawloptimizer_remove_pingback_http_header', 10, 1);

function ultimatecrawloptimizer_remove_powered_by_http_header($headers)
{
    if (get_option('ultimatecrawloptimizer_remove_powered_by_http_header') == 1)
    {
        header_remove('X-Powered-By');
    }
}
add_filter('wp_headers', 'ultimatecrawloptimizer_remove_powered_by_http_header', 10, 1);

add_action('init', 'ultimatecrawloptimizer_remove_homepage_feed');
function ultimatecrawloptimizer_remove_homepage_feed()
{
    if (get_option('ultimatecrawloptimizer_remove_global_feed') == 1)
    {
        add_action('feed_links_show_posts_feed', '__return_false');
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_global_comment_feeds');
function ultimatecrawloptimizer_remove_global_comment_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1)
    {
        add_action('feed_links_show_comments_feed', '__return_false');
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_authors_feeds');
function ultimatecrawloptimizer_remove_post_authors_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_post_authors_feeds') == 1)
    {
          add_action('wp', 'ultimatecrawloptimizer_remove_author_rss_link', 3);
    }
}
function ultimatecrawloptimizer_remove_author_rss_link()
{
    if (is_author())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_category_feeds');
function ultimatecrawloptimizer_remove_category_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_category_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_add_category_rss_link', 3);
    }
}
function ultimatecrawloptimizer_add_category_rss_link()
{
    if (is_category())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_comments_feeds');

function ultimatecrawloptimizer_remove_post_comments_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_post_comments_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_remove_post_comments', 3);
    }
}
function ultimatecrawloptimizer_remove_post_comments()
{
  if (is_singular()) {
        remove_action('wp_head', 'feed_links_extra', 3);

      }
}
add_action('init', 'ultimatecrawloptimizer_remove_tag_feeds');
function ultimatecrawloptimizer_remove_tag_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_tag_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_tag_rss_link', 3);
    }
}
function ultimatecrawloptimizer_tag_rss_link()
{
    if (is_tag())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_post_type_feeds');
function ultimatecrawloptimizer_remove_post_type_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_post_type_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_add_post_type_feed_links');
    }
}
function ultimatecrawloptimizer_add_post_type_feed_links()
{
    if (is_post_type_archive())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_custom_taxonomy_feeds');
function ultimatecrawloptimizer_remove_custom_taxonomy_feeds()
{
    if (get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_taxonomy_rss_link', 3);
    }
}
function ultimatecrawloptimizer_taxonomy_rss_link()
{
    if (is_tax())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
function ultimatecrawloptimizer_remove_search_results_feeds($query)
{
    if (get_option('ultimatecrawloptimizer_remove_search_results_feeds') == 1)
    {
        add_action('wp', 'ultimatecrawloptimizer_add_search_rss_link', 3);
    }
}
add_action('pre_get_posts', 'ultimatecrawloptimizer_remove_search_results_feeds');

function ultimatecrawloptimizer_add_search_rss_link()
{
    if (is_search())
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
}
add_action('init', 'ultimatecrawloptimizer_remove_emoji_scripts');
function ultimatecrawloptimizer_remove_emoji_scripts()
{
    if (get_option('ultimatecrawloptimizer_remove_emoji_scripts') == 1)
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('wp_resource_hints', 'cleanup_for_resource_hints_plain', 1);
    }
}
function cleanup_for_resource_hints_plain($hints)
{
    foreach ($hints as $key => $hint)
    {
        if (strpos($hint, '//s.w.org') !== false)
        {
            unset($hints[$key]);
        }
    }
    return $hints;
}

add_action('init', 'ultimatecrawloptimizer_filter_search_special_chars');

function ultimatecrawloptimizer_filter_search_special_chars()
{
    if (get_option('ultimatecrawloptimizer_filter_special_characters') == 1)
    {
        add_action('pre_get_posts', 'remove_special_chars_from_search_url');
        add_action('pre_get_posts', 'remove_emojis_from_search_url');
    }
}

function remove_emojis_from_search_url($query)
{
    if (!is_admin() && $query->is_search() && isset($_GET['s']))
    {
        $search_term = sanitize_text_field($_GET['s']);
        $emoji_regex = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F1E0}-\x{1F1FF}]/u';

        if (preg_match($emoji_regex, $search_term))
        {
            $clean_search_term = preg_replace($emoji_regex, '', $search_term);
            $clean_search_term = esc_url(home_url("/"));
            wp_redirect($clean_search_term, 301);
            exit;
        }
    }
}

function remove_special_chars_from_search_url($query)
{
    if (!is_admin() && $query->is_search() && isset($_GET['s']))
    {
        $search_term = sanitize_text_field($_GET['s']);
        $special_chars_regex = '/[^\p{L}\p{N}\s]/u';

        if (preg_match($special_chars_regex, $search_term))
        {
            $clean_search_term = preg_replace($special_chars_regex, '', $search_term);
            $clean_search_term = esc_url(home_url("/"));
            wp_redirect($clean_search_term, 301);
            exit;
        }
    }
}
add_action('init', 'ultimatecrawloptimizer_filter_search_spam');
function ultimatecrawloptimizer_filter_search_spam()
{
    if (get_option('ultimatecrawloptimizer_filter_spam_patterns') == 1)
    {
        add_action('pre_get_posts', 'remove_spammy_words_from_search_url');
    }
}

function remove_spammy_words_from_search_url($query)
{
    if (!is_admin() && $query->is_search() && isset($_GET['s']))
    {
        $search_term = sanitize_text_field($_GET['s']);
        $search_term = esc_html($search_term);
        $spam_patterns = array(
            "viagra",
            "cialis",
            "porn",
            "xxx",
            "casino",
            "dating",
            "gay",
            "gambling",
            "loan",
            "debt",
            "credit",
            "insurance",
            "forex"
        );
        $spam_pattern_regex = '/\b(' . implode('|', array_map('preg_quote', $spam_patterns)) . '|(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,6})\b/i';

        if (preg_match($spam_pattern_regex, $search_term))
        {
            $clean_search_term = preg_replace($spam_pattern_regex, '', $search_term);
            $clean_search_term = sanitize_text_field($clean_search_term);
            wp_redirect(home_url("/") , 301);
            exit;
        }
    }
}

function ultimatecrawloptimizer_search_redirect()
{
    if (get_option('ultimatecrawloptimizer_redirect_pretty_urls') == 1)
    {
        if ( ! is_search() ) {
			return;
		}
        if (isset( $_SERVER['REQUEST_URI'] ) && \stripos( $_SERVER['REQUEST_URI'], '/search/' ) === 0)
        {
        $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        preg_match('/\/search\/(.*?)\/*$/', $request_uri, $matches);
        if (count($matches) > 1)
        {
            $search_query = sanitize_text_field(rtrim($matches[1], '/'));
            $search_query = esc_html($search_query);
            $redirect_url = home_url('/?s=' . $search_query);
            wp_redirect($redirect_url, 301);
            exit;
        }
    }
    }
}
add_action('template_redirect', 'ultimatecrawloptimizer_search_redirect');
add_action('init', 'ultimatecrawloptimizer_limit_search_characters');
function ultimatecrawloptimizer_limit_search_characters()
{
    if (get_option('ultimatecrawloptimizer_filter_search_terms') == 1)
    {
    if (isset($_GET['s']) && strlen($_GET['s']) > get_option('ultimatecrawloptimizer_max_search_characters'))
    {
        wp_redirect(home_url("?s=") . substr($_GET['s'], 0, get_option('ultimatecrawloptimizer_max_search_characters')));
        exit();
    }
}
}
add_option('ultimatecrawloptimizer_max_search_characters', 50);
function ultimatecrawloptimizer_redirect_utm_to_hash()
{
    if (get_option('ultimatecrawloptimizer_optimize_ga_utm_params') == 1)
    {
        if ( ! isset( $_SERVER['REQUEST_URI'] ) || strpos( $_SERVER['REQUEST_URI'], '?' ) === false ) {
			return;
		}

        if (isset($_SERVER['REQUEST_URI']))
        {
            $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
            if (strpos($request_uri, '?utm_') !== false)
            {
                $redirect_url = preg_replace('/\?utm_/', '#utm_', $request_uri);
                if (strcmp($request_uri, $redirect_url) !== 0)
                {
                    wp_redirect($redirect_url, 301);
                    exit;
                }
            }
        }
    }
}
add_action('init', 'ultimatecrawloptimizer_redirect_utm_to_hash');


add_action('wp', 'ultimatecrawloptimizer_redirect_feeds', -10000);
function ultimatecrawloptimizer_redirect_feeds() {
  global $wp_query;

  if ( ! is_feed() ) {
      return;
  }

  if ( in_array( get_query_var( 'feed' ), [ 'atom', 'rdf' ], true ) && get_option('ultimatecrawloptimizer_remove_atom_rdf_feeds') == 1 ) {
      redirect_feed( home_url(), 'We disable Atom/RDF feeds to improve crawling.' );
  }

  // Only if we're on the global feed, the query is _just_ `'feed' => 'feed'`, hence this check.
  if ( ( $wp_query->query === [ 'feed' => 'feed' ]
          || $wp_query->query === [ 'feed' => 'atom' ]
          || $wp_query->query === [ 'feed' => 'rdf' ] )
      && get_option('ultimatecrawloptimizer_remove_global_feed') == 1 ) {
      redirect_feed( home_url(), 'We disable the RSS feed to improve crawling.' );
  }

  if ( is_comment_feed() && ! ( is_singular() || is_attachment() ) && get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1  ) {
      redirect_feed( home_url(), 'We disable comment feeds to improve crawling.' );
  }
  elseif ( is_comment_feed()
          && is_singular()
          && ( get_option('ultimatecrawloptimizer_remove_post_comments_feeds') == 1 || get_option('ultimatecrawloptimizer_remove_global_comment_feeds') == 1  ) ) {
      $url = get_permalink( get_queried_object() );
      redirect_feed( $url, 'We disable post comment feeds to improve crawling.' );
  }

  if ( is_author() && get_option('ultimatecrawloptimizer_remove_post_authors_feeds') == 1 ) {
      $author_id = (int) get_query_var( 'author' );
      $url       = get_author_posts_url( $author_id );
      redirect_feed( $url, 'We disable author feeds to improve crawling.' );
  }

  if ( ( is_category() && get_option('ultimatecrawloptimizer_remove_category_feeds') == 1 )
      || ( is_tag() && get_option('ultimatecrawloptimizer_remove_tag_feeds') == 1 )
      || ( is_tax() && get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds') == 1 ) ) {
      $term = get_queried_object();
      $url  = get_term_link( $term, $term->taxonomy );
      if ( is_wp_error( $url ) ) {
          $url = home_url();
      }
      redirect_feed( $url, 'We disable taxonomy feeds to improve crawling.' );
  }

  if ( ( is_post_type_archive() ) && get_option('ultimatecrawloptimizer_remove_post_type_feeds') == 1 ) {
      $url = get_post_type_archive_link( get_queried_post_type() );
      redirect_feed( $url, 'We disable post type feeds to improve crawling.' );
  }

  if ( is_search() && get_option('ultimatecrawloptimizer_remove_search_results_feeds') == 1 ) {
      $url = trailingslashit( home_url() ) . '?s=' . get_search_query();
      redirect_feed( $url, 'We disable search RSS feeds to improve crawling.' );
  }
}
function redirect_feed($url, $reason) {
	// Remove unnecessary headers
	header_remove('Content-Type');
	header_remove('Last-Modified');


	// Redirect to the given URL with a 301 status code and a reason
	$redirect_reason = 'Reason: ' . $reason;
	wp_safe_redirect($url, 301, $redirect_reason);

	exit;
}
function ultimatecrawloptimizer_redirect_remove_params()
{
    if (get_option('ultimatecrawloptimizer_remove_unregistered_url_params') == 1)
    {
      add_action('template_redirect', 'ultimatecrawloptimizer_clean_permalinks');
    }
}
add_action('wp', 'ultimatecrawloptimizer_redirect_remove_params');
function ultimatecrawloptimizer_clean_permalinks() {
// Check if request is from a search engine, sitemap request, empty $_GET, or logged-in user
if (is_robots() || get_query_var('sitemap') || empty($_GET) || is_user_logged_in()) {
    return;
}

// Parse the URL's query string
$url_parts = wp_parse_url($_SERVER['REQUEST_URI']);
parse_str($url_parts['query'], $query_vars);

// Get allowed variables from options
$allowed_extravars = array();
if (!empty(get_option('ultimatecrawloptimizer_allowed_url_params'))) {
    $allowed_extravars = explode(',', sanitize_text_field(get_option('ultimatecrawloptimizer_allowed_url_params')));
}

// Remove extraneous variables
$allowed_query = array();
$remaining_query = array();
if (!empty($allowed_extravars)) {
    foreach ($query_vars as $key => $value) {
        if (in_array($key, $allowed_extravars)) {
            $allowed_query[$key] = $value;
        } else {
            $remaining_query[$key] = $value;
        }
    }
} else {
    $remaining_query = $query_vars;
}

if (count($remaining_query) === 0) {
    return;
}

// Determine proper URL based on the type of page
if (is_singular()) {
    $proper_url = get_permalink();
    if (isset($_SERVER['REQUEST_URI']) && preg_match('`(\?replytocom=[^&]+)`', sanitize_text_field($_SERVER['REQUEST_URI']), $matches)) {
        $proper_url .= str_replace('?replytocom=', '#comment-', $matches[0]);
    }
    unset($matches);
    if (isset($_GET['preview']) && isset($_GET['preview_nonce']) && current_user_can('edit_post')) {
        return;
    }
} elseif (is_front_page()) {
    $proper_url = home_url('/');
} elseif (is_home()) {
    $proper_url = get_permalink(get_option('page_for_posts'));
} elseif (is_category() || is_tag() || is_tax()) {
    $term = $wp_query->get_queried_object();
			if ( \is_feed() ) {
				$proper_url = \get_term_feed_link( $term->term_id, $term->taxonomy );
			}
			else {
				$proper_url = \get_term_link( $term, $term->taxonomy );
			}
} elseif (is_search()) {
    $proper_url = get_search_link();
} elseif (is_404()) {
    $proper_url = home_url('/404');
} else {
    $proper_url = '';
}

// Append page number if request is for a specific page of results
if (isset($remaining_query['paged']) && $remaining_query['paged'] > 1) {
    $proper_url = trailingslashit($proper_url) . 'page/' . $remaining_query['paged'];
}

// Add back allowed query variables
$proper_url = add_query_arg($allowed_query, $proper_url);

// Redirect to proper URL if requested URL doesn't match
$current_url = $_SERVER['REQUEST_URI'];
if (!empty($proper_url) && $current_url !== $proper_url) {
    header('Content-Type: redirect', true);
    header_remove('Content-Type');
    header_remove('Last-Modified');
    header_remove('X-Pingback');
    wp_safe_redirect($proper_url, 301);
    exit;
}
}

include_once (plugin_dir_path(__FILE__) . "/optimizer/optimizer.php");
include_once (plugin_dir_path(__FILE__) . "/optimizer/crawl-optimizer.php");