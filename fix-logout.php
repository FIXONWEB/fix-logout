<?php
/**
 * Plugin Name:     FIX Shortcode Logout
 * Plugin URI:      https://agencia.fixonweb.com.br/plugin/fix-shortcode-logout
 * Description:     Adiciona um botão que ao ser clicado, faz logout e redireciona para pagina principal.
 * Author:          FIXONWEB
 * Author URI:      https://agencia.fixonweb.com.br
 * Text Domain:     fix-logout
 * Domain Path:     /languages
 * Version:         0.1.5
 *
 * @package         Fix_Logout
 */

//git@github.com:FIXONWEB/fix-shortcode-logout.git

if ( ! defined( 'ABSPATH' ) ) { exit; }
require 'plugin-update-checker.php';
$fix1607789263_url_update 	= 'https://github.com/FIXONWEB/fix-logout.git';
$fix1607789263_slug 		= 'fix-logout/fix-logout';
$fix1607789263_check 		= Puc_v4_Factory::buildUpdateChecker($fix1607789263_url_update,__FILE__,$fix1607789263_slug);

register_activation_hook( __FILE__, 'fix1607789263_activation_hook' );
function fix1607789263_activation_hook() {
    add_role( 'fix-administrativo', 'fix-administrativo', array( 'read' => true, 'level_0' => true ) );
}

add_action('wp_enqueue_scripts', "fix1607789263_enqueue_scripts");
function fix1607789263_enqueue_scripts(){
    wp_enqueue_script( 'jquery-validate-min', plugin_dir_url( __FILE__ ) . '/js/jquery.validate.min.js', array( 'jquery' )  );
    wp_enqueue_style('fix1607789263_style', plugin_dir_url(__FILE__) . '/css/fix1607789263_style.css', array(), '0.1.0', 'all');
}

add_shortcode("fix_logout", "fix_logout");
function fix_logout($atts, $content = null){
	if(is_user_logged_in()){
		ob_start();
		?>
			<a href="<?php echo wp_logout_url() ?>">Logout</a>
		<?php
		return ob_get_clean();
	}
}
