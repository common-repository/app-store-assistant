<?php 
/*
Plugin Name: App Store Assistant
Version: 6.9.1
Text Domain: appStoreAssistant
Plugin URI: https://sealsystems.net/
Description: Adds shortcodes to display ATOM feed or individual item information from Apple's App Stores or iTunes. Now works with Amazon.com Affiliate Program.
Author: Scott Immerman
Author URI: http://SEALsystems.net/
*/

/**
Copyright 2014, 2020 Scott Immerman

*/
//ini_set('display_errors', 'On'); //Debug
//error_reporting(E_ALL | E_STRICT); // Debug
//error_reporting(E_ERROR | E_WARNING | E_PARSE); // Debug
function plugin_get_version() {
	if ( ! function_exists( 'get_plugins' ) ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( ASA_MAIN_FILE ) ) );
	$plugin_file = basename( ( ASA_MAIN_FILE ) );
	return $plugin_folder[$plugin_file]['Version'];
}


define( 'ASA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'ASA_PLUGIN_INCLUDES_PATH', plugin_dir_path( __FILE__ )."includes/" );
define( 'ASA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ASA_MAIN_FILE', plugin_dir_path( __FILE__ )."app-store-assistant.php" );
define( 'ASA_PLUGIN_VERSION', urlencode(plugin_get_version()) );
// --------------------------------------------------------------------------------------
// ------------------ FUNCTIONS ---------------------------------------------------------
// --------------------------------------------------------------------------------------
require_once(ASA_PLUGIN_INCLUDES_PATH.'app-store-functions.php');
//require_once(ASA_PLUGIN_INCLUDES_PATH.'simplepie.inc');
require_once(ASA_PLUGIN_INCLUDES_PATH.'app-store-admin_functions.php');
require_once(ASA_PLUGIN_INCLUDES_PATH.'app-store-amazon_functions.php');

// ------------------------------------------------------------------------
// REQUIRE MINIMUM VERSION OF WORDPRESS:                                               
// ------------------------------------------------------------------------
add_action( 'admin_init', 'requires_wordpress_version' );
// ------------------------------------------------------------------------
// REGISTER HOOKS & CALLBACK FUNCTIONS:
// ------------------------------------------------------------------------
add_action( 'wp_head', 'appStore_css_hook' );

register_activation_hook(__FILE__, 'appStore_add_defaults');
register_uninstall_hook(__FILE__, 'appStore_delete_plugin_options');

add_action('admin_init', 'appStore_init' );
add_action('admin_menu', 'appStore_add_options_page');
add_filter('plugin_action_links', 'appStore_plugin_action_links', 10, 2 );

//Feed Icon Hooks
add_filter('the_excerpt_rss', 'appStore_icon_in_rss', 1000, 1);
add_filter('the_content_feed', 'appStore_icon_in_rss', 1000, 1);


// Load Scripts & Styles
add_action('wp_print_scripts', 'appStore_add_scripts');
add_action('wp_print_styles', 'appStore_add_stylesheets');

// Load Admin Scripts & Styles
add_action('admin_print_scripts', 'appStore_add_admin_scripts');
add_action('admin_print_styles',  'appStore_add_admin_stylesheets');

if (appStore_setting('excerpt_generator')=="asa") {
	//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'appStore_excerpt_filter',2);
	//add_filter('get_the_excerpt','do_shortcode');
}
if (appStore_setting('featured_image_generator')=="asa") {
	//add_filter( 'post_thumbnail_html', 'appStore_post_thumbnail_html', 10, 3 );
	//add_filter( 'post_thumbnail_html', 'appStore_post_thumbnail_html');
	//add_filter( 'get_the_post_thumbnail', 'appStore_get_the_post_thumbnail', 10, 3 );
}

add_action('wp_footer', 'appStore_addLinkToFooter');
add_action('admin_bar_init', 'appStore_admin_bar_render' );
// ------------------------------------------------------------------------
// REGISTER SHORTCODES, ADD EDITOR BUTTONS
// ------------------------------------------------------------------------
add_shortcode("asaf_atomfeed", "appStore_handler_feed");
add_shortcode('asa_item', 'appStore_handler_item');
add_shortcode("asa_list", "appStore_handler_list");
add_shortcode('asa_link', 'appStore_handler_itemLink');
add_shortcode('asa_elements', 'appStore_handler_app_element');

add_shortcode('asa_apple_raw', 'appStore_handler_apple_raw');
add_shortcode('asa_amazon_raw', 'appStore_handler_amazon_raw');

add_shortcode('amazon_item', 'appStore_amazon_handler');
add_shortcode('amazon_item_link', 'appStore_amazon_link_handler');

// Deprecated shortcodes
add_shortcode('ios_app', 'appStore_handler_item');
add_shortcode('mac_app', 'appStore_handler_item');
add_shortcode('itunes_store', 'appStore_handler_item');
add_shortcode('ibooks_store', 'appStore_handler_item');
add_shortcode("ios_app_list", "appStore_handler_list");
add_shortcode('ios_app_link', 'appStore_handler_itemLink');
add_shortcode('mac_app_link', 'appStore_handler_itemLink');
add_shortcode('itunes_store_link', 'appStore_handler_itemLink');
add_shortcode('ios_app_elements', 'appStore_handler_app_element');

// ------------------------------------------------------------------------
// Setup for Editor additions
// ------------------------------------------------------------------------
add_action('init', 'add_asa_mce_button');
add_filter( 'tiny_mce_version', 'appStore_refresh_mce');

// ------------------------------------------------------------------------
// Setup for Localization
// ------------------------------------------------------------------------
add_action('init', 'asa_load_translation_file');


// ------------------------------------------------------------------------
// DEFINE Apple App Store URL & CACHE directory
// ------------------------------------------------------------------------
$AppleStoreURL = 'http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/wa/wsLookup';
$AppleStoreURL .= '?country='.appStore_setting('store_country');
if(appStore_setting('store_language') != "NATIVE") $AppleStoreURL .= '&lang='.appStore_setting('store_language');
$AppleStoreURL .= '&id=';
define('ASA_APPSTORE_URL', $AppleStoreURL);
//define('ASA_APPSTORE_URL', 'http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/wa/wsLookup?country='.appStore_setting('store_country').'&id=');
//define('ASA_APPSTORE_URL', 'https://itunes.apple.com/lookup?country='.appStore_setting('store_country').'&lang='.appStore_setting('store_language').'&id=');
$upload_dir = wp_upload_dir();
define('CACHE_DIRECTORY',$upload_dir['basedir'] . '/appstoreassistant_cache/');
define('CACHE_DIRECTORY_URL',$upload_dir['baseurl'] . '/appstoreassistant_cache/');

// ------------------------------------------------------------------------
// Setup Widget
// ------------------------------------------------------------------------

class ASA_Widget1 extends WP_Widget {
	function ASA_Widget1() {
		parent::WP_Widget( false, $name = 'ASA Top iOS Apps' );
	}

	function widget( $args, $instance ) {
		extract( $args );
		//Widget Title
				
		$title = apply_filters( 'widget_title', $instance['title'] );
		$showamount = apply_filters( 'widget_showamount', $instance['showamount'] );
		if(!$showamount) $showamount = "5";
		
		if(strlen($title) < 5) $title = __('Top '.$showamount.' iOS Apps');
		
		echo $before_widget;
		if ($title) echo $before_title . $title. $after_title;
		
		//ATOM Feed URL
		$atomurl = apply_filters( 'widget_atomurl', $instance['atomurl'] );
		if(empty($atomurl)) {
			_e( 'Missing atomurl in tag. Replace <strong>id</strong> with <strong>atomurl</strong>.','appStoreAssistant');
			return;
		}
		$last = $atomurl[strlen($atomurl)-1];
		$AddSlash = "";
		if($last != "/") $AddSlash = "/";
		$RSS_Feed = $atomurl.$AddSlash."xml";
		$appStore_option = "appStore_rssfeed_".hash('md2', $RSS_Feed);
		$feedData = get_option($appStore_option);
		if (!empty($feedData)) {
			$appIDs = $feedData;
		} else {
			$appIDs = appStore_getIDs_from_feed($RSS_Feed);
			update_option($appStore_option, $appIDs);
		}		
		array_splice($appIDs, $showamount);

		echo '<div class="asaWidget1"><ul>';
		foreach($appIDs as $appID) {	
			if($appID == "" || !is_numeric($appID)) return;
			$app = appStore_get_data($appID);
			// App Artwork
			if(appStore_setting('cache_images_locally') == '1') {
				$imageTag = $app->imageWidget_cached;
			} else {
				$imageTag = $app->imageWidget;
			}		
			$appURL = getAffiliateURL($app->trackViewUrl);
			if($app) {
				echo "<li>";
				echo '<a href="'.$appURL.'" target="_blank">';
				echo '<img src="'.$imageTag.'" alt="'.$app->trackName.'" width="'.appStore_setting('appicon_size_widget_w').' height="'.appStore_setting('appicon_size_widget_h').'" align="left"/>';
				echo '</a>';
				echo '<h4><a href="'.$appURL.'" target="_blank">'.$app->trackName.'</a></h4>';
				echo '<div style="position:relative;float:right;background-color:#'.appStore_setting('color_buttonStart').';min-width:6em;text-align:center;moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px;-moz-box-shadow:inset 3px 3px 3px 3px #'.appStore_setting('color_buttonShadow').';	-webkit-box-shadow: 1px 1px 1px 1px #'.appStore_setting('color_buttonShadow').'; box-shadow: 1px 1px 1px 1px #'.appStore_setting('color_buttonShadow').';margin-right:10px;margin-top:5px;">';
				echo '<a href="'.$appURL.'" style="padding:2px 8px;text-decoration:none;color:#'. appStore_setting('color_buttonText').';text-shadow:1px 1px 0px #'.appStore_setting('color_buttonTextShadow').';" target="_blank">';
				echo $app->formattedPrice;
				echo '</a>';
				echo "</div>";
				echo "</li>";
			} else {
				echo "No valid data for app id";
				//wp_die('No valid data for app id: ' . $id);
			}
		}
		echo "</ul></div>";

		echo $after_widget;
	}

  function update( $new_instance, $old_instance ) {
	return $new_instance;
  }

  function form( $instance ) {
    $title = esc_attr( $instance['title'] );
    $atomurl = esc_attr( $instance['atomurl'] );
    $showamount = esc_attr( $instance['showamount'] );
    ?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'atomurl' ); ?>"><?php _e( 'ATOM Feed:' ); ?>
      <input class="widefat" id="<?php echo $this->get_field_id( 'atomurl' ); ?>" name="<?php echo $this->get_field_name( 'atomurl' ); ?>" type="text" value="<?php echo $atomurl; ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'showamount' ); ?>"><?php _e( 'Show this many apps:' ); ?>
      <input class="widefat" id="<?php echo $this->get_field_id( 'showamount' ); ?>" name="<?php echo $this->get_field_name( 'showamount' ); ?>" type="text" value="<?php echo $showamount; ?>" />
      </label>
    </p>    <?php
  }
}

add_action( 'widgets_init', 'ASA_Widget1Init' );
function ASA_Widget1Init() {
  register_widget( 'ASA_Widget1' );
}

?>