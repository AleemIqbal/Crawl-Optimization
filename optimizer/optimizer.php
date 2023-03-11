<?php

add_action('admin_menu', 'ultimatecrawloptimizer_settings');
function ultimatecrawloptimizer_settings()
{
    add_menu_page('Crawl Optimizations', 'Crawl Optimizations', 'manage_options', 'crawloptimizations-settings', 'ultimatecrawloptimizer_crawl_optimizer_settings_page', 'dashicons-admin-generic', null);
}


function ultimatecrawloptimizer_register_setting()
{
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_disable_wpcontent_php');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_disable_uploads_php');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_disable_includes_php');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_disable_plugin_theme_editor');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_disable_mixed_content');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_prevent_exposed_login_feedback');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_shortlinks');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_rest_api_links');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_rsd_wlw_links');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_oembed_links');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_generator_tag');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_pingback_http_header');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_powered_by_http_header');

    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_global_feed');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_global_comment_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_post_comments_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_post_authors_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_post_type_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_category_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_tag_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_custom_taxonomy_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_search_results_feeds');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_atom_rdf_feeds');

    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_emoji_scripts');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_wp_json_api');

    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_filter_search_terms');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_max_search_characters');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_filter_special_characters');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_filter_spam_patterns');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_redirect_pretty_urls');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_prevent_internal_search_crawl');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_optimize_ga_utm_params');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_remove_unregistered_url_params');
    ultimatecrawloptimizer_register_setting_group('ultimatecrawloptimizer_allowed_url_params');
}