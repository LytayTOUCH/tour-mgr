<?php
/**
 * Plugin Name: TourMgr
 * Description: This plugin is used as Singleton and MVC code pattern sample.
 * Author: LytayTouch.
 * Author URI: https://github.com/LytayTOUCH
 * Version: 1.0
 * Plugin URI: https://github.com/LytayTOUCH/tostov
 * License: GPL2+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once('includes/core/core-class.php');
Core::init();

function activate_tourmgr(){

}
register_activation_hook( __FILE__, 'activate_tourmgr' );

function deactivate_tourmgr(){

}
register_deactivation_hook( __FILE__, 'deactivate_tourmgr' );


add_action( 'admin_menu', function(){
	add_menu_page(
					__( 'Unsub List', 'textdomain' ),
					__( 'Unsub Emails','textdomain' ),
					'manage_options',
					'wpdocs-unsub-email-list',
					'wpdocs_unsub_page_callback',
					''
			);
});

function wpdocs_unsub_page_callback() {
	$app = new Admin_Controller();
	echo $app->test_app();
	echo "<br/>";
	echo Lib::test_app();
	echo "<br/>";
	echo Admin_Model::test_app();
	echo "<br/>";
	// echo Hooks_Loader::test_hook_loader();
	echo "Call from Admin_Controller ";
	echo $app->add_hook_loader();
	echo "<br/>";
	echo Admin_Menu::init()->renderAdminMenu();
}

/*
 * Hide admin menus for non Network Admins
 */
function custom_remove_admin_theme_remove_menus () {
	if( !current_user_can( 'manage_network' ) ) {
		global $menu;
		$restricted = array(
			__( 'Dashboard'),
			__( 'Posts' ),
			__( 'Media' ),
			__( 'Links' ),
			__( 'Pages' ),
			__( 'Tools' ),
			__( 'Users' ),
			__( 'Settings' ),
			__( 'Comments' ),
			__( 'Plugins' ),
			__( 'QRcode'),
		);
		end ( $menu );
		while ( prev( $menu ) ) {
			$value = explode( ' ',$menu[key( $menu )][0] );
			if ( in_array( $value[0] != NULL ? $value[0]: '', $restricted ) ) {
				unset( $menu[key( $menu )] );
			}
		}
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'themes.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'admin.php?page=mp_st' );
		remove_menu_page( 'admin.php?page=cp_main' );
		remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_category&amp;post_type=product' );
		remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=brand&amp;post_type=product' );
		remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=model&amp;post_type=product' );
		remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_tag&amp;post_type=product' );
	}
}
add_action('admin_menu', 'custom_remove_admin_theme_remove_menus', 10);

/*
 * If user is not a SuperAdmin, when they try to access the below URLs they are redirected back to the dashboard.
 */
function restrict_admin_with_redirect() {

	$restrictions = array(
		'/wp-admin/users.php',
		'/wp-admin/post-new.php',
		'/wp-admin/media-new.php',
		// '/wp-admin/index.php',
		'/wp-admin/widgets.php',
		'/wp-admin/widgets.php',
		'/wp-admin/user-new.php',
		'/wp-admin/upgrade-functions.php',
		'/wp-admin/upgrade.php',
		'/wp-admin/themes.php',
		'/wp-admin/theme-install.php',
		'/wp-admin/theme-editor.php',
		'/wp-admin/setup-config.php',
		// '/wp-admin/plugins.php',
		// '/wp-admin/plugin-install.php',
		'/wp-admin/options-writing.php',
		'/wp-admin/options-reading.php',
		'/wp-admin/options-privacy.php',
		'/wp-admin/options-permalink.php',
		'/wp-admin/options-media.php',
		'/wp-admin/options-head.php',
		'/wp-admin/options-general.php',
		'/wp-admin/options-discussion.php',
		'/wp-admin/options.php',
		'/wp-admin/network.php',
		'/wp-admin/ms-users.php',
		'/wp-admin/ms-upgrade-network.php',
		'/wp-admin/ms-themes.php',
		'/wp-admin/ms-sites.php',
		'/wp-admin/ms-options.php',
		'/wp-admin/ms-edit.php',
		'/wp-admin/ms-delete-site.php',
		'/wp-admin/ms-admin.php',
		'/wp-admin/moderation.php',
		'/wp-admin/menu-header.php',
		'/wp-admin/menu.php',
		'/wp-admin/edit-tags.php',
		'/wp-admin/edit-tag-form.php',
		'/wp-admin/edit-link-form.php',
		'/wp-admin/edit-comments.php',
		'/wp-admin/credits.php',
		'/wp-admin/about.php'
	);

	foreach ( $restrictions as $restriction ) {

		if ( ! current_user_can( 'manage_network' ) && $_SERVER['PHP_SELF'] == $restriction ) {
			// wp_redirect( admin_url() );
			wp_redirect('/wp-admin/admin.php?page=wpdocs-unsub-email-list');
			exit;
		}

	}

}
add_action( 'admin_init', 'restrict_admin_with_redirect' );

/*
 * If user is not an admin, do not allow access to the dashboard AT ALL.
 */
function custom_remove_no_admin_access(){
	if ( ! defined( 'DOING_AJAX' ) && ! current_user_can( 'manage_options' ) ) {
		// wp_redirect( home_url() );
		wp_redirect('/wp-admin/admin.php?page=wpdocs-unsub-email-list');
		die();
	}
}
add_action( 'admin_init', 'custom_remove_no_admin_access', 1 );

function shapeSpace_remove_toolbar_nodes($wp_admin_bar) {
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('customize');
	$wp_admin_bar->remove_node('customize-background');
	$wp_admin_bar->remove_node('customize-header');
	$wp_admin_bar->remove_node('site-name');
	$wp_admin_bar->remove_node('new-content');
	$wp_admin_bar->remove_node('my-account');
	// $wp_admin_bar->remove_node('user-info');
	$wp_admin_bar->remove_node('edit-profile');
	$wp_admin_bar->remove_node('menu-toggle');

	// $wp_admin_bar->remove_node('top-secondary');


	$args = array(
		'id'    => 'tostov-page',
		// 'parent' => 'top-secondary',
		'title' => sprintf( '<span class="ab-icon"></span> <span class="ab-label">%s</span>', __( 'TosTov', 'tostov-page' ) ),
		'href'  => site_url().'/wp-admin/admin.php?page=tostov-dashboard'
	);
	$config = array(
		'parent'    => 'tostov-page',
		'id'  => 'tostov-configs',
		'title' => __( 'Settings', 'tostov-config' ),
		'href'  => site_url().'/wp-admin/admin.php?page=wpdocs-unsub-email-list-config'
	);
	$option = array(
		'parent'    => 'tostov-page',
		'id'  => 'tostov-options',
		'title' => __( 'Options', 'tostov-option' ),
		'href'  => site_url().'/wp-admin/admin.php?page=wpdocs-unsub-email-list-option'
	);
	$wp_admin_bar->add_menu( $args );
	$wp_admin_bar->add_menu($config);
	$wp_admin_bar->add_menu($option);

	$current_user = wp_get_current_user();
	$display_name = array(
		'id'    => 'tostov-user',
		// 'parent' => 'top-secondary',
		'title' => sprintf( '<span class="ab-icon"></span><span class="ab-label">%s</span>', __( ucwords($current_user->display_name), 'tostov-page' )  )
	);
	$wp_admin_bar->add_menu($display_name);


	$user_profile = array(
		'id'    => 'tostov-user-profile',
		'parent' => 'tostov-user',
		'title' => __( 'Profile', 'tostov-page' ),
		'href' => '#'
	);
	$wp_admin_bar->add_menu($user_profile);

	$logout = array(
		'id'    => 'tostov-logout',
		'parent' => 'tostov-user',
		'title' => __( 'Logout', 'tostov-logout' ),
		'href'   => wp_logout_url(),
	);
	$wp_admin_bar->add_menu($logout);


}
add_action('admin_bar_menu', 'shapeSpace_remove_toolbar_nodes', 999);

// Clear admin pancel footer wp version and thanks words
add_filter( 'admin_footer_text', '__return_empty_string', 11 );
add_filter( 'update_footer',     '__return_empty_string', 11 );

// Add custom style script to test toolbar admin panel
add_action( 'admin_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
add_action( 'wp_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
function custom_wp_toolbar_css_admin() {
  wp_register_style( 'add_custom_wp_toolbar_css', plugin_dir_url( __FILE__ ) . 'custom-wp-toolbar-link.css','','', 'screen' );
  wp_enqueue_style( 'add_custom_wp_toolbar_css' );
}

add_action( 'admin_menu', 'remove_admin_menus' );

function remove_admin_menus(){
    global $menu;
    $menu = array();
}

?>
