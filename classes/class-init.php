<?php
/**
 * 初期化、更新
 *
 * @package yStandard_Kaereba
 * @author  yosiakatsuki
 */

class Ystd_Kaereba_Init {
	/**
	 * Ystd_Kaereba_Init constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_files' ), 9 );
		add_action( 'plugins_loaded', array( $this, 'initialize' ), 11 );
	}

	/**
	 * 必要ファイルのロード
	 */
	public function load_files() {
		require_once YSTDKAEREBA_CLASSES_PATH . 'class-enqueue.php';
	}

	/**
	 * 初期化
	 */
	public function initialize() {
		/**
		 * enqueue
		 */
		$enqueue = new Ystd_Kaereba_Enqueue();
		/**
		 * 管理画面の場合アップデートチェック
		 */
		if ( is_admin() ) {
			add_action( 'after_setup_theme', array( $this, 'check_update' ) );
		}
	}

	/**
	 * アップデートチェック
	 */
	public function check_update() {
		require_once YSTDKAEREBA_PATH . 'library/plugin-update-checker/plugin-update-checker.php';
		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://wp-ystandard.com/download/ystandard/plugin/ystandard-kaereba/ystandard-kaereba.json',
			YSTDKAEREBA_PATH . 'ystandard-kaereba.php',
			'yStandard Kaereba'
		);
	}
}