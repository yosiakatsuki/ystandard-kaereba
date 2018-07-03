<?php

/**
 * CSSのロード
 *
 * @package yStandard_Kaereba
 * @author  yosiakatsuki
 */
class Ystd_Kaereba_Enqueue {

	private $type = 'default';

	/**
	 * Ystd_Kaereba_Enqueue constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'ys_enqueue_inline_styles', array( $this, 'enqueue_inline_styles_amp' ) );
	}

	/**
	 * CSSの追加
	 */
	public function enqueue_styles() {
		if ( function_exists( 'ys_enqueue_lazyload_css' ) ) {
			ys_enqueue_lazyload_css(
				'ystd-kaereba-' . $this->type,
				YSTDKAEREBA_URL . 'css/ystandard-kaereba-' . $this->type . '.min.css',
				YSTDKAEREBA_VER
			);
		} else {
			wp_enqueue_style(
				'ystd-kaereba-' . $this->type,
				YSTDKAEREBA_URL . 'css/ystandard-kaereba-' . $this->type . '.min.css',
				array(),
				YSTDKAEREBA_VER
			);
		}


	}

	public function enqueue_inline_styles_amp( $styles ) {
		/**
		 * AMPでの読み込み
		 */
		if ( $this->is_enable_amp_css() ) {
			$css_file = YSTDKAEREBA_PATH . 'css/ystandard-kaereba-' . $this->type . '.min.css';
			if ( ys_is_amp() && file_exists( $css_file ) ) {
				$kaereba_css = ys_file_get_contents( $css_file );
				$styles[]    = array(
					'style'  => $kaereba_css,
					'minify' => true,
				);
			}

		}

		return $styles;
	}

	private function is_enable_amp_css() {
		if ( ! function_exists( 'ys_set_inline_style' ) ) {
			return false;
		}
		if ( ! function_exists( 'ys_is_amp' ) ) {
			return false;
		}
		if ( ! function_exists( 'ys_file_get_contents' ) ) {
			return false;
		}

		return true;
	}


	/**
	 * Scriptの追加
	 */
	public function enqueue_scripts() {
		if ( function_exists( 'ys_enqueue_lazyload_script' ) ) {
			ys_enqueue_lazyload_script(
				'ystd-kaereba-script',
				YSTDKAEREBA_URL . 'js/ystandard-kaereba.min.js'
			);
		} else {
			wp_enqueue_script(
				'ystd-kaereba-script',
				YSTDKAEREBA_URL . 'js/ystandard-kaereba.min.js',
				array(),
				null,
				true
			);
		}
	}
}