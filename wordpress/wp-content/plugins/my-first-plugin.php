<?php
/**
 * Plugin Name: MyFirstPlugin.
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Creating my first plugin ever.
 * Version: The plugin's version number. Example: 1.0.0
 * Author: The Lady
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */
 
 /*
	add_menu_page() to add a menu in the admin menu
	get_option() will return the option available in the options table, if it does not exist, it will return false.
	update_option() will check to see if there is already a named option, if it doesn't find it calls the add_option()
	Finally add the scripts in the WordPress head.
*/
 
 
 /*********************** CUSTOM ADMIN MENU  ***********************/
 
function register_my_custom_menu_page(){
	add_menu_page( "Custom CSS and JS", "Custom CSS and JS", "manage_options", "nelly-slug", "main_func");
}
add_action( 'admin_menu', 'register_my_custom_menu_page');


/******************************* ************************************/
function main_func(){

	$content = "";
	
	?>
		<form method='post'>
			<h1>Custom CSS</h1>
			<textarea name='custom_css' cols='150' rows='10'><?php echo get_option('css_script'); ?></textarea>
			
			<h1>Custom JS</h1>
			<textarea name='custom_js' cols='150' rows='10'><?php echo get_option('js_script'); ?> </textarea>
			<br/>
			
			<input type='submit' name='save_custom_scripts' value='submit script' />
			<input type='submit' name='retrieve_custom_scripts' value='retrieve script' />
		</form>
	
	<?php
	
	echo $content;
 }
 
 /*********************** SAVE THE CUSTOM CSS AND JS IN THE DATABASE TABLE ******************************************/
 if(isset($_POST['save_custom_scripts'])){
 
	$cust_css = $_POST['custom_css'];	//saves the custom css
	$cust_js = $_POST['custom_js'];		//saves the custom js
	
	update_option( 'css_script', $cust_css );
	update_option( 'js_script', $cust_js );
 }
 
 
 /*********************** OUTPUT CSS AND JS IN THE HEAD BELOW *******************************************/

 function insert_custom_scripts(){

	echo "<script type='text/javascript'>";		
		echo get_option('js_script');
	echo "</script>";
 
	echo "<style type='text/css'>";		
		echo get_option('css_script');
	echo "</style>";
 
 }
 add_action('wp_head', 'insert_custom_scripts');	
?>

