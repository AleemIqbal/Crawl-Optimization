<?php


function ultimatecrawloptimizer_crawl_optimizer_settings_page()
{
  // Check if the user has the required permissions
if ( ! current_user_can( 'manage_options' ) ) {
  wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

?>
  <div class="wrap custom-seo-settings">
    <h1 style="text-align:center;">Crawl Optimization</h1>

    <form method="post" action="options.php">
      <?php settings_fields('ultimatecrawloptimizer_theme_options');
      do_settings_sections('ultimatecrawloptimizer_theme_options'); ?>
      <div class="custom-seo-settings-box">
        <div class="custom-seo-settings-box__column">
          <h3>Remove Unnecessary Metadata</h3>
          <p>WordPress appends a plethora of hyperlinks and supplementary content to your website's HTTP headers. In most cases, it is safe to deactivate all of these elements, thereby reducing the amount of data transferred</p>
        </div>
        <div class="custom-seo-settings-box__column">
          <table class="form-table">
            <tbody>
              <tr valign="top">
                <th scope="row">
                  Remove shortlinks Tag
                  <p>Remove the hyperlinks associated with WordPress' internal 'shortlink' URLs for your posts to streamline the navigation of your website.</p>
                  <?php
              $html = '<p><code>&lt;link rel="shortlink" href="'.esc_url( home_url( '?p=1' ) ).'" /&gt;</code></p>';
              echo wp_kses_post( $html );
            ?>
            </th>
            <td>
              <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_shortlinks' ); ?>" value="1" <?php echo (esc_attr(get_option('ultimatecrawloptimizer_remove_shortlinks')) == 1) ? 'checked' : ''; ?> />
            </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove REST API link Tag
                  <p>Remove references to the location of your site's REST API endpoints by removing the associated hyperlinks.</p>
                  <?php
                  $html = '<p><code>&lt;link rel="https://api.w.org/" href="'.esc_url( home_url( '/wp-json/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_rest_api_links' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_rest_api_links')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove RSD / WLW link Tags
                  <p>Remove references used by external systems for publishing content to your blog by removing the associated hyperlinks.</p>
                  <?php
                  $html = '<p><code>&lt;link rel="EditURI" type="application/rsd+xml" title="RSD" href="'.esc_url( home_url( '/xmlrpc.php?rsd' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                  <p>and</p>
                  <?php
                  $html = '<p><code>&lt;link rel="wlwmanifest" type="application/wlwmanifest+xml" href="'.esc_url( home_url( '/wp-includes/wlwmanifest.xml' ) ).'" /&gt;</code></p>';
                    echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_rsd_wlw_links' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_rsd_wlw_links')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove oEmbed link Tags
                  <p>Remove references used for embedding your content on external websites by removing the associated hyperlinks.</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/json+oembed" href="'.esc_url( home_url( '/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.example.com%2Fexample-post%2F' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_oembed_links' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_oembed_links')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove generator Tag
                  <p>Remove references to the plugins and CMS utilized by your website by removing the associated information.</p>
                  <p><code>&lt;meta name="generator" href="WordPress 6.1.1" /&gt;</code></p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_generator_tag' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_generator_tag')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Pingback HTTP header
                  <p>Remove references which enable external websites to ping your site when they have linked to it by removing the associated hyperlinks.</p>
                  <?php
                  $html = '<p><code>X-Pingback: '.esc_url( home_url( 'xmlrpc.php' ) ).'</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_pingback_http_header' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_pingback_http_header')), true); ?> />                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove powered by HTTP header
                  <p>Remove information about the plugins and software utilized by your website by removing the associated information.,</p>
                  <p><code>X-Powered-By: PHP/8.2</code></p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_powered_by_http_header' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_powered_by_http_header')), true); ?> />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="custom-seo-settings-box">
        <div class="custom-seo-settings-box__column">
          <h3>Remove Unnecessary Feed Links</h3>
          <p>WordPress disseminates your content through various formats and URLs, including RSS feeds of your posts and categories. It is generally considered best practice to deactivate any formats that are not currently in use.</p>
        </div>
        <div class="custom-seo-settings-box__column">
          <table class="form-table">
            <tbody>
              <tr valign="top">
                <th scope="row">
                  Remove Global Feed
                  <p>Remove Feed URLs that supply an overview of your recent posts, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Feed" href="'.esc_url( home_url( '/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_global_feed' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_global_feed' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_global_feed')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Global Comment Feeds
                  <p>Remove Feed URLs that furnish an overview of recent comments on your website, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Comments Feed" href="'.esc_url( home_url( '/comments/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                  <p>It will also disable post comment feeds.</p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_global_comment_feeds' ); ?>"  id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_global_comment_feeds' ); ?>" value="1"  onclick="toggleCommentFeeds()" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_global_comment_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Post Comments Feeds
                  <p>Remove Feed URLs that supply details about recent comments on each post, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Example post Comments Feed" href="'.esc_url( home_url( '/example-post/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_post_comments_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_post_comments_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_post_comments_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Post Authors Feeds
                  <p>Remove Feed URLs that furnish information about recent posts by certain authors, such as</p>
                  <?php

                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Posts by Example Feed" href="'.esc_url( home_url( '/author/example/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_post_authors_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_post_authors_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_post_authors_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Post Type Feeds
                  <p>Remove Feed URLs that supply details about your recent posts for every post type, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Drama Feed" href="'.esc_url( home_url( '/drama/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr('ultimatecrawloptimizer_remove_post_type_feeds'); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_post_type_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_post_type_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Category Feeds
                  <p>Remove Feed URLs that furnish information about your recent posts for each category, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Example Category Feed" href="'.esc_url( home_url( '/category/example/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_category_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_category_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_category_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Tag Feeds
                  <p>Remove Feed URLs that provide information about your recent posts for each tag, such as</p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Example Tag Feed" href="'.esc_url( home_url( '/tag/example/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_tag_feeds' ); ?>" id="<?php echo esc_attr('ultimatecrawloptimizer_remove_tag_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_tag_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Custom Taxonomy Feeds
                  <p>Remove Feed URLs that supply details about your recent posts for every custom taxonomy, such as</p>
                  <?php

                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - ASUS Feed" href="'.esc_url( home_url( '/size/brand/asus/feed/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_custom_taxonomy_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_custom_taxonomy_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_custom_taxonomy_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th>
                  Remove Search Results Feeds
                  <p>Remove Feed URLs that furnish information about your search results, such as</p>
                  <?php

                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Search Results for example Feed" href="'.esc_url( home_url( '/search/example/feed/rss2/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_search_results_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_search_results_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_search_results_feeds')), true); ?> />
                </td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  Remove Atom/RDF Feeds
                  <p>Remove Feed URLs that offer alternate (outdated) versions of the above-mentioned items, such as </p>
                  <?php
                  $html = '<p><code>&lt;link rel="alternate" type="application/rss+xml" title="'.esc_attr( get_bloginfo( 'name' ) ).' - Feed" href="'.esc_url( home_url( '/feed/atom/' ) ).'" /&gt;</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_atom_rdf_feeds' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_atom_rdf_feeds' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_atom_rdf_feeds')), true); ?> />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="custom-seo-settings-box">
        <div class="custom-seo-settings-box__column">
          <h3>Remove Unnecessary WordPress Resources</h3>
          <p>Optimize page load times and resource usage by removing unnecessary WordPress resources.</p>
        </div>
        <div class="custom-seo-settings-box__column">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row">
                  <label for="ultimatecrawloptimizer_remove_emoji_scripts">Remove Emoji scripts
                    <p>Remove unnecessary JavaScript for handling emoji characters in outdated browsers.</p>
                  </label>
                </th>
                <td><input type="checkbox" name="<?php echo esc_attr('ultimatecrawloptimizer_remove_emoji_scripts'); ?>" id="<?php echo esc_attr('ultimatecrawloptimizer_remove_emoji_scripts'); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_emoji_scripts')),true); ?> /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="custom-seo-settings-box">
        <div class="custom-seo-settings-box__column">
          <h3>Optimize Internal Site Search</h3>
          <p>Securing your internal site search to prevent confusion for search engines and potential attacks from SEO spammers is important for the overall performance and security of your website. Even if your website does not have a search feature, it is recommended to implement these measures for optimal performance.</p>
        </div>
        <div class="custom-seo-settings-box__column">
          <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                  Filter Spam Search Terms
                  <p>Enables advanced settings for protecting your internal site search URLs from SPAM attacks.</p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_search_terms' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_search_terms' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_filter_search_terms')), true); ?> />
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Limit the number of characters allowed in internal site searches
                  <p>Implement a character limit for internal site search queries to improve security and organization of URLs. The suggested range is between 1 and 50.</p>
                </th>
                <td>
                <input type="number" name="<?php echo esc_attr('ultimatecrawloptimizer_max_search_characters'); ?>" id="<?php echo esc_attr('ultimatecrawloptimizer_max_search_characters'); ?>" value="<?php echo esc_attr(get_option('ultimatecrawloptimizer_max_search_characters')); ?>" min="1" max="50" />
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Remove special characters and emojis from internal site search queries
                  <p>Remove non-alphanumeric characters from internal site searches to prevent spam attacks</p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_special_characters' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_special_characters' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_filter_special_characters')), true); ?> />
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Block internal site searches that contain patterns commonly used by spammers.
                  <p>Prevent spam attacks on internal site searches by filtering out common spam patterns.</p>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_spam_patterns' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_filter_spam_patterns' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_filter_spam_patterns')), true); ?> />
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Standardize Site Search URLs with ?s= Syntax Redirection
                  <p></p>
                  Standardize WordPress site search URLs by redirecting all variations to the ?s= format
                  <p></p>
                  <?php
                  $html = '<p><code>'.esc_url( home_url( '/search/apple/' ) ).'</code></p>
								<p>will redirect to</p>
								<p><code>'.esc_url( home_url( '/?s=apple' ) ).'</code></p>';
                echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_redirect_pretty_urls' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_redirect_pretty_urls' ); ?>" value="1" <?php checked( 1, esc_attr(get_option( 'ultimatecrawloptimizer_redirect_pretty_urls' )), true ); ?> />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="custom-seo-settings-box">
        <div class="custom-seo-settings-box__column">
          <h3>Parameters Optimization</h3>
          <p>By implementing certain techniques, it is possible to prevent certain URL parameters from being removed during website operation. This can be beneficial for tracking, filtering and advanced functionality, but it also has a potential impact on website performance and search engine optimization. Websites that do not use URL parameters may see an improvement by utilizing these options.</p>
        </div>
        <div class="custom-seo-settings-box__column">
          <table class="form-table">
            <tbody>
              <tr>
                <th>
                  Optimize Google Analytics by converting utm parameters
                  <p>Convert utm tracking parameters to # fragment versions with a 301 redirect. For example,
                    <?php
                    $html = '<p><code>'.esc_url( home_url( '?utm_medium=organic' ) ).'</code></p>
									<p>will be redirected to<br/></p>
									<p><code>'.esc_url( home_url( '#utm_medium=organic' ) ).'</code></p>';
                  echo wp_kses_post( $html );
                    ?>
                </th>
                <td>
                  <label for="ultimatecrawloptimizer_optimize_ga_utm_params"> <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_optimize_ga_utm_params' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_optimize_ga_utm_params' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_optimize_ga_utm_params')), true); ?> /></label>
                </td>
              </tr>
              <tr>
                <th>
                  Remove all URL parameters through a 301 redirect
                  <p>Removes unnecessary query parameters from URLs through a permanent redirect, such as</p>
                  <?php
                  $html = '<p><code>'.esc_url( home_url( '?unknown_parameter=yes' ) ).'</code></p> <p>will be redirected to<br/></p> <p><code>'.esc_url( home_url( '/' ) ).'</code></p>';
                  echo wp_kses_post( $html );
                  ?>
                </th>
                <td>
                  <label for="ultimatecrawloptimizer_remove_unregistered_url_params"> <input type="checkbox" name="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_unregistered_url_params' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_remove_unregistered_url_params' ); ?>" value="1" <?php checked(1, esc_attr(get_option('ultimatecrawloptimizer_remove_unregistered_url_params')), true); ?> /></label>
                </td>
              </tr>
              <tr>
                <th>
                  Additional URL parameters to allow
                  <?php
                  $html = '<p>By adding specific URL parameters, this feature prevents them from being removed. For example, adding <code>example_parameter</code> will prevent the URL <code>'.esc_url( home_url( '/?example_parameter=yes' ) ).'</code> from being redirected to <code>'.esc_url( home_url( '/' ) ).'</code>. Multiple parameters can be added and separated using a comma.</p>';
                    echo wp_kses_post( $html );
                    ?>
                  <input type="text" name="<?php echo esc_attr( 'ultimatecrawloptimizer_allowed_url_params' ); ?>" id="<?php echo esc_attr( 'ultimatecrawloptimizer_allowed_url_params' ); ?>" value="<?php echo esc_attr( sanitize_text_field( get_option('ultimatecrawloptimizer_allowed_url_params') ) ); ?>" size="50" />
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="custom-seo-settings-box">
        <p class="submit"><?php submit_button(); ?></p>
      </div>
    </form>
  </div>
<?php
}