<?php
/**
 * 本文の操作
 *
 * @package yStandard_Kaereba
 * @author  yosiakatsuki
 */

class Ystd_Kaereba_Content {
	/**
	 * Ystd_Kaereba_Content constructor.
	 */
	public function __construct() {
		$this->set_filter();
	}

	/**
	 * フィルターセット処理
	 */
	public function set_filter() {
		add_filter( 'the_content', array( $this, 'kaereba_p_cancel' ), 99 );
	}

	/**
	 * カエレバ系リンクで空Pタグができる現象の対処
	 *
	 * @param string $content Content.
	 *
	 * @return null|string|string[]
	 */
	public function kaereba_p_cancel( $content ) {
		// カエレバ・ヨメレバ　商品タイトル
		$pattern = '/<div class="(kaerebalink-name|booklink-name)">(.+)?<\/p>/i';
		if ( 1 === preg_match( $pattern, $content, $matches ) ) {
			$append  = '<div class="$1">$2';
			$content = preg_replace( $pattern, $append, $content );
		}
		// ショップリンク関連
		$pattern = '/<div class="(shoplinkkindle|shoplinkamazon|shoplinkrakuten)">(.+)?<\/p><\/div>/is';
		if ( 1 === preg_match( $pattern, $content, $matches ) ) {
			$append  = '<div class="$1">$2</div>';
			$content = preg_replace( $pattern, $append, $content );
		}

		return $content;
	}
}