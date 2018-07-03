<?php
/**
 * Plugin Name:     yStandard Kaereba
 * Description:     yStandard カエレバ・ヨメレバCSS追加プラグイン
 * Author:          yosiakatsuki
 * Author URI:      https://yosiakatsuki.net
 * Text Domain:     ystandard-kaereba
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         yStandard_Kaereba
 */

define( 'YSTDKAEREBA_VER', '0.1.0' );
define( 'YSTDKAEREBA_PATH', plugin_dir_path( __FILE__ ) );
define( 'YSTDKAEREBA_URL', plugin_dir_url( __FILE__ ) );
define( 'YSTDKAEREBA_CLASSES_PATH', plugin_dir_path( __FILE__ ) . 'classes/' );


require_once YSTDKAEREBA_CLASSES_PATH . 'class-init.php';

$ystd_kaereba = new Ystd_Kaereba_Init();