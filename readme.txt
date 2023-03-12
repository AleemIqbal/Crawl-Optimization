=== Crawl Optimization ===
Contributors: Aleem Iqbal, Faheem Iqbal,Big Techies Team
Tags: google search console,crawler, crawl, seo,search engines
Requires at least: 4.3
Tested up to: 6.1.1
Requires PHP: 5.2.4
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Crawl Optimization Plugin is designed to help optimize your website’s crawl rate by removing unnecessary links and information from your HTTP headers. 

== Description ==

**The Crawl Optimization Plugin is designed to help optimize your website’s crawl rate by removing unnecessary links and information from your HTTP headers. By removing elements such as shortlinks, REST API links, RSD/WLW links, oEmbed links, generator tags, and X-Pingback headers, this plugin streamlines the navigation of your website and reduces the amount of data transferred. Additionally, it also removes the “powered by” HTTP header which reveals the software and plugins used on your website, keeping your site more secure. With the Crawl Optimization Plugin SEO plugin, your website will load faster and be more easily navigated by search engines, improving your overall SEO.**

== Features ==
* Helps optimize your website's crawl rate by removing unnecessary links and information from your HTTP headers.
* Deactivates elements such as shortlinks, REST API links, RSD/WLW links, oEmbed links, generator tags, and X-Pingback headers to streamline website navigation and reduce the amount of data transferred.
* Removes the "powered by" HTTP header to keep your website more secure.
* Improves website loading speed by reducing unnecessary data transfer and streamlining navigation.
* Enhances website SEO by making it more easily navigable by search engines.

**Remove Unnecessary Metadata:**
WordPress is a popular content management system (CMS) used to create websites. One of the features of WordPress is that it adds several links and metadata to a website's HTTP headers. While these links and metadata may be helpful in certain situations, they can also slow down a website's performance by increasing the amount of data that needs to be transferred. To improve website performance, it may be necessary to remove unnecessary metadata from a WordPress site.

The "Remove Unnecessary Metadata" section in WordPress focuses on deactivating elements that are not required on a website, including the following sub-features:

**Deactivate WordPress' HTTP headers:** This feature disables unnecessary hyperlinks and metadata that are added by WordPress. By deactivating these elements, you can reduce the amount of data that is transferred between the website and the user's device, which can improve website performance.

**Remove WordPress Generator Tag:** WordPress adds a generator tag to a website's HTML code, which references the CMS or plugins used on the website. This information can be useful for developers but is not necessary for website visitors. Removing the generator tag can improve website performance and also make it harder for attackers to identify vulnerabilities in the website's software.

**Remove Shortlinks Tag:** WordPress adds hyperlinks to its internal 'shortlink' URLs for posts. While these links can be helpful for navigation within a website, they are not necessary for external visitors. Removing these links can streamline website navigation and improve website performance.

**Remove REST API link Tag:** WordPress adds hyperlinks to the location of a site's REST API endpoints. This feature removes the REST API link tag, which is not necessary for most websites.

**Remove RSD / WLW link Tags:** WordPress adds references for external systems to publish content on the blog by adding associated hyperlinks. This feature removes the RSD / WLW link tags, which are not necessary for most websites.

**Remove oEmbed link Tags:** WordPress adds references for embedding content on external websites by adding associated hyperlinks. This feature removes oEmbed link tags, which are not necessary for most websites.

**Remove Pingback HTTP header:** WordPress allows external websites to ping a site when linked to by adding a pingback HTTP header. While this feature may be useful in some situations, it is not necessary for most websites. Removing the pingback HTTP header can improve website performance and also reduce the risk of security vulnerabilities.

**Remove powered by HTTP header:** WordPress adds a "powered by" HTTP header that displays information about plugins and software used on the website. While this information may be helpful for developers, it is not necessary for website visitors. Removing the "powered by" HTTP header can improve website performance and also make it harder for attackers to identify vulnerabilities in the website's software.

**Remove Unnecessary Feed Links:**
This section of optimization settings in WordPress focuses on removing unnecessary feed links from a website. WordPress disseminates website content in various formats and URLs, including RSS feeds for posts and categories. However, deactivating unused formats is considered best practice as it helps reduce the amount of data transferred, which can help to speed up a website.

**Deactivate Global Feed:** This feature removes URLs that provide an overview of recent posts. Global feeds are usually included in the website's header or footer, and they offer users an easy way to view recent posts from anywhere on the site.

**Deactivate Global Comment Feeds:** This feature removes URLs that provide an overview of recent comments on the website. Comment feeds are used to syndicate comments from a particular post or page.

**Deactivate Post Comments Feeds:** This feature removes URLs that supply details about recent comments on each post. Post comment feeds are used to syndicate comments on a particular post.

**Deactivate Post Authors Feeds:** This feature removes URLs that furnish information about recent posts by certain authors. This feed is useful for readers who are interested in reading posts written by a particular author.

**Deactivate Post Type Feeds:** This feature removes URLs that supply details about recent posts for every post type. This feed is useful for readers who are interested in reading posts from a specific post type, such as a custom post type.

**Deactivate Category Feeds:** This feature removes URLs that furnish information about recent posts for each category. This feed is useful for readers who are interested in reading posts from a specific category.

**Deactivate Tag Feeds:** This feature removes URLs that provide information about recent posts for each tag. This feed is useful for readers who are interested in reading posts that have a particular tag.

**Deactivate Custom Taxonomy Feeds:** This feature removes URLs that supply details about recent posts for every custom taxonomy. Custom taxonomy feeds are used to syndicate posts that have been assigned to a custom taxonomy term.

**Deactivate Search Results Feeds:** This feature removes URLs that furnish information about search results. This feed is useful for readers who want to keep track of search results for a particular keyword or phrase.

**Deactivate Atom/RDF Feeds:** This feature removes URLs that offer alternate versions of the above-mentioned items in Atom or RDF formats.

**Remove Unnecessary WordPress Resources**
The feature "Remove Unnecessary WordPress Resources" is designed to improve the performance of WordPress websites by removing unnecessary resources that are not required for the website to function properly. 

**Remove Emoji scripts:**
Remove Emoji scripts feature removes unnecessary JavaScript used to handle emojis in outdated browsers.

**Optimize Internal Site Search**
This feature secures your internal site search to prevent confusion for search engines and potential attacks from SEO spammers, which is important for the overall performance and security of your website. Even if your website does not have a search feature, it is recommended to implement these measures for optimal performance.

**Filter Spam Search terms:** This feature enables advanced settings for protecting your internal site search URLs from SPAM attacks.

**Limit the number of characters allowed in internal site searches:** This feature implements a character limit for internal site search queries to improve security and organization of URLs. The suggested range is between 1 and 50.

**Remove special characters and emojis from internal site search queries:** This feature removes non-alphanumeric characters from internal site searches to prevent spam attacks.

**Block internal site searches that contain patterns commonly used by spammers:** This feature prevents spam attacks on internal site searches by filtering out common spam patterns.

**Standardize Site Search URLs with ?s= Syntax Redirection:** This feature standardizes WordPress site search URLs by redirecting all variations to the ?s= format. 

**Parameters Optimization**
This feature optimizes certain URL parameters to prevent them from being removed during website operation. This can be beneficial for tracking, filtering, and advanced functionality, but it also has a potential impact on website performance and search engine optimization. Websites that do not use URL parameters may see an improvement by utilizing these options.

**Optimize Google Analytics by converting utm parameters:** This feature converts utm tracking parameters to # fragment versions with a 301 redirect.

**Remove all URL parameters through a 301 redirect:** This feature removes unnecessary query parameters from URLs through a permanent redirect. 

**Additional URL parameters to allow:** This feature prevents specific URL parameters from being removed. For example, adding example_parameter will prevent the URL from being redirected. Multiple parameters can be added and separated using a comma.

== Screenshots ==
1. The First Section screenshot-1.jpg
2. The Second Section screenshot-2.jpg
3. The End Part of Second Section screenshot-3.jpg
4. The Third and 4th Section screenshot-4.jpg
5. The Last Section screenshot-5.jpg

== Need any Help? ==
* Please email us at aleemiqbalbhatti@gmail.com
* We provide live support


== Changelog ==

== V 1.0.0 ==
* Initial release at 02/16/2023

== V 1.1.0 ==
* Enabling Redirect removes references of feeds
* Redirect all parameters option is now disabled for non supported themes and builders

== V 1.1.1 ==
* Redirect all parameters will no longer work with woocommerce

== V 1.1.2 ==
* Added Settings Link on plugins page

== V 1.1.3 ==
* Jquery Conflict causing editors to crash fixed

== V 1.1.4 ==
* Emoji Filter and spam filter now also remove from url

== V 1.1.5 ==
* Feed Bugs Resolved and More Secure

== V 1.1.6 ==
* Removed Feed due to instability and it could cause SEO Issues

== V 1.2.0 ==
* Plugin Completely Revamped by including more Features
* Shortlinks Redirect also removed
* API Redirect Link Removed
* Feeds completed revamped
* Feeds are no longer created from scratch, Existing Feeds are removed
* Filter Search Terms Option Added
* Feeds now redirect after disabling
* Remove all URL Parameters is now compatible with editors
* Option to Additional URL Parameters to allow added
* Jquery Removed

== V 1.2.1 ==
* Security Update

== Upgrade Notice ==

= 1.1 =
Enabling Redirect removes references of feeds
Redirect all parameters option is now disabled for non supported themes and builders

= 1.1 =
Redirect all parameters will no longer work with woocommerce

= V 1.1.2 =
Added Settings Link on plugins page

= V 1.1.3 =
Jquery Conflict causing editors to crash fixed

= V 1.1.4 =
Emoji Filter and spam filter now also remove from url

= V 1.1.5 =
Feed Bugs Resolved and More Secure

= V 1.1.6 =
Removed Feed due to instability and it could cause SEO Issues

= V 1.2.0 =
Plugin Completely Revamped by including more Features
Shortlinks Redirect removed
API Redirect Link removed
Feeds completely revamped
Feeds are no longer created from scratch, Existing Feeds are removed
Filter Search Terms Option Added
Feeds now redirect after disabling
Remove all URL Parameters is now compatible with editors
Option to Additional URL Parameters to allow added
Jquery Removed

= V 1.2.1 =
Security Update

== Installation ==

1. Log in to your WordPress admin panel and go to Plugins -> Add New
2. Type **Crawl Optimization** in the search box and click on search button.
3. Find Crawl Optimization plugin.
4. Then click on Install Now after that activate the plugin.

OR

1. Download and save the **Crawl Optimization** plugin to your hard disk.
2. Login to your WordPress and go to the Add Plugins page.
3. Click Upload Plugin button to upload the zip.
4. Click Install Now to install and activate the plugin.

== Frequently Asked Questions ==

= What is metadata in WordPress and why should it be removed? =
Metadata in WordPress refers to information about a website that is not visible to users but can be found in the code of a web page. Metadata tags such as shortlinks, REST API, RSD/WLW, oEmbed, generator, pingback HTTP header, and powered by HTTP header can be removed to optimize website performance and improve security. Removing these metadata tags can also reduce the risk of potential attacks and hacking attempts on a website.

= Why should I remove the REST API link tag in WordPress? =
The REST API link tag in WordPress can pose a security risk by allowing unauthorized access to your site's content.

= What are Remove RSD / WLW link Tags and why should i remove them? =
RSD (Really Simple Discovery) and WLW (Windows Live Writer) link tags are used by external systems for publishing content to your WordPress site. Removing these link tags can help improve SEO crawlibity, website security by reducing the potential attack surface for hackers. Additionally, these link tags are not typically used by most users, so removing them can help streamline your website's code and improve website performance.

= What are oEmbed link tags in WordPress and why should they be removed? =
oEmbed link tags in WordPress allow other sites to embed your content, such as videos or images, on their site. While this can be useful for increasing your site's exposure, it can also slow down site performance and use up server resources. 

= What is a pingback HTTP header in WordPress and why should it be removed? =
A pingback is a feature in WordPress that allows other websites to notify your website when they link to one of your posts. It does this by sending an HTTP request to your website with a pingback header. While pingbacks can be useful for tracking who is linking to your website, they can also be abused by spammers to send fake pingbacks and generate unwanted traffic.

= What is the powered by HTTP header in WordPress and why should it be removed? =
The powered by HTTP header in WordPress displays information about the software and version being used to power your site. While this can be useful for developers, it can also make your site more vulnerable to attacks.

= What are generator tags and why should they be removed? =
The generator tag in WordPress displays the version of WordPress and the theme or plugins used on a website. It can be a security risk as hackers can use this information to exploit any known vulnerabilities in older versions. To improve website security, it is recommended to remove the generator tag by adding a code snippet to the theme's functions.php file or using a plugin.

= Why should i optimize internal site search in WordPress? =
By default, WordPress includes a search function that allows visitors to search for content on your website. However, this function can sometimes be slow and not provide accurate results. 

= What are Feeds in WordPress and why should they be removed from headers? =
Feeds in WordPress allow users to subscribe to content updates through RSS or Atom feeds by adding "/feed" to the end of the website URL. Removing can improve SEO, website speed and prevent users from subscribing via feeds.