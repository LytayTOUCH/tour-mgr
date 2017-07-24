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
	$app = new App_Controller();
	echo $app->test_app();
	echo "<br/>";
	$app = new App_Model();
	echo $app->test_app();
	echo "<br/>";
	$app = new App_View();
	echo $app->test_app();
	echo "<br/>";
	$app = new App_Lib();
	echo $app->test_app();
	echo "<br/>";
	$person = new Person_Test();
	echo $person->test_person_class();
	echo "<br/>";
	$book = new Book();
	echo $book->get_nonstatic_method();
	echo "<br/>";
	echo Book::init()->get_person_table_class();
	echo "<br/>";
	$deactivator = new Deactivator();
	echo $deactivator->loadParentCoreFromDeactivator();
	echo "</br>";
	$menu = new Menu();
	echo $menu->getTestFromBookClass();
	echo "</br>";
	echo Activator::init()->test_activator();
	echo "</br>";
	echo Autoloader::init()->loadTables('Person_Test');
	echo "</br>";
	echo Core::init()->testCore();
	echo "<br/>";
	// Activator::init()->test_activator();
	echo __FILE__;
	echo "<br/>";
 //  $menu = new Menu();
	echo "Singletone Echo";
	echo "<br/>";
	// echo Menu::init()->test();
	echo "<br/>";
 //  echo Menu::init()->test();
	echo 'Unsubscribe Email List';
}

?>
