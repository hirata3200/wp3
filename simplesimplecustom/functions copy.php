<?php
/****************************************

	functions.php

	テーマ内で利用する関数を定義したり、
	テーマの設定を行うためのファイルです。

*****************************************/

/** メインカラムの幅を指定する変数。下記は 600px を指定（記述推奨）*/
if ( ! isset( $content_width ) ) $content_width = 600;

/** <head>内に RSSフィードのリンクを表示するコード */
add_theme_support( 'automatic-feed-links' );

/** ダイナミックサイドバーを定義するコード（CHAPTER 11）*/
register_sidebar( array(
	'name'			=> 'サイドバーウィジット-1',
	'id'			=> 'sidebar-1',
	'description'	=> 'サイドバーのウィジットエリアです。デフォルトのサイドバーと丸ごと入れ替えたいときに使ってください。',
    'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
    'after_widget'	=> '</div>',
) );

/** カスタムメニュー機能を有効にするコード（CHAPTER 12）*/
add_theme_support( 'menus' );

/** カスタムメニューの「場所」を設定するコード */
register_nav_menu( 'header-navi', 'ヘッダーのナビゲーション' );
register_nav_menu( 'sidebar-navi', 'サイドバーのナビゲーション' );
register_nav_menu( 'footer-navi', 'フッターのナビゲーション' );

/** アイキャッチ画像機能を有効にするコード（CHAPTER 14）*/
add_theme_support( 'post-thumbnails' );

/** 抜粋の[...]を...に変更するコード（CHAPTER 14）*/
function new_excerpt_more( $more ) {
	return ' ... ';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/** カスタムヘッダーを img 要素として有効にするコード（CHAPTER 15）*/
$args = array(
	'width'			=> 940,
	'height'		=> 250,
	'flex-height'	=> true,
	'header-text'	=> true,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
	'uploads'		=> true,
);
add_theme_support( 'custom-header', $args );

function header_style() {
	?>
	<style>
		#header-image {
			background: url(<?php header_image(); ?>);
			color: #<?php header_textcolor(); ?>;
			width: <?php echo get_custom_header()->width; ?>px;
			height: <?php echo get_custom_header()->height; ?>px;
		}
		#header-image p {
			padding: 5em 3em;
		}
	</style>
	<?php }

	function admin_header_image() {
		$style = 'style="background-image :url( ' . get_header_image() . ' ); max-width: ' . get_custom_header()->width . 'px; height: ' . get_custom_header()->height . 'px;"';
		$color = 'style="color: #' . get_header_textcolor() . ';"'; ?>
		<div id="headimg" <?php echo $style; ?>>
			<p <?php echo $color; ?>><?php bloginfo( 'description' ); ?></p>
		</div>
	<?php }


function admin_header_style() { ?>
	<style type="text/css">
		#headimg {
			max-width: <?php echo get_custom_header()->width; ?>px;
			height: <?php echo get_custom_header()->height; ?>px;
		}
		#headimg p{
			font-size: 14px;
			padding: 5em 3em;
		}
	</style>
<?php }

	add_image_size( 'header-image', 940, 250, true );

function breadcrumb() {
	global $post;
	$separater 	= '<li>&gt;</li>';
	$str 		= '';
	if ( ! is_home() && ! is_admin() ) {
		$str .= '<div id="breadcrumb" class="clearfix">';
		$str .= '<ul>';
		$str .= '<li><a href="' . esc_url( home_url( '/' ) ) . '">HOME</a></li>';
		$str .= $separater;
		if ( is_search() ) {
			$str .= '<li>「' . esc_html( get_search_query() ) . '」で検索した結果</li>';
		} elseif ( is_tag() ) {
			$str .= '<li>タグ : ' . single_tag_title( '' , false ) . '</li>';
		} elseif ( is_404() ) {
			$str .= '<li>404 Not found</li>';
		} elseif ( is_date() ) {
			if ( is_day() ) {
				$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>';
				$str .= $separater;
				$str .= '<li><a href="' . get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ) . '">' . get_query_var( 'monthnum' ) . '月</a></li>';
				$str .= $separater;
				$str .= '<li>' . get_query_var( 'day' ) . '日</li>';
			} elseif ( is_month() ) {
				$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>';
				$str .= $separater;
				$str .= '<li>' . get_query_var( 'monthnum' ) . '月</li>';
			} elseif ( is_year() ) {
				$str .= '<li>' . get_query_var( 'year' ) . '年</li>';
			}
		} elseif ( is_category() ) {
			$cat = get_queried_object();
			if ( $cat->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
				foreach ( $ancestors as $ancestor ) {
					$str .= '<li><a href="' . esc_url( get_category_link( $ancestor ) ) . '">' . esc_html( get_cat_name( $ancestor ) ) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li>' . $cat->name . '</li>';
		} elseif ( is_author() ) { 			/** 投稿者アーカイブ */
			$str .='<li>投稿者 : ' . esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ) . '</li>';
		} elseif ( is_page() ) {			/** 固定ページ */
			if ( $post->post_parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $post->ID, 'page' ) );
				foreach ( $ancestors as $ancestor) {
					$str .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li>' . esc_html( $post->post_title ) . '</li>';

		} elseif ( is_attachment() ) { 		/** 添付ファイルページ */
			if ( $post->post_parent != 0 ) {
				$str .= '<li><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '">' . esc_html( get_the_title( $post->post_parent ) ) . '</a></li>';
				$str .= $separater;
			}
			$str .= '<li>' . esc_html( $post->post_title ) . '</li>';
		} elseif ( is_single() ) { 			/** ブログ記事ページ */
			$categories = get_the_category( $post->ID );
			$cat 		= $categories[0];
			if ( $cat->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
				foreach ( $ancestors as $ancestor ) {
					$str .= '<li><a href="' . esc_url( get_category_link( $ancestor ) ) . '">' . esc_html( get_cat_name( $ancestor ) ) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . $cat->cat_name . '</a></li>';
			$str .= $separater;
			$str .= '<li>' . esc_html( $post->post_title ) . '</li>';
		} else{								/** その他のページ */
			$str .= '<li>' . wp_title( '', true ) . '</li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
	}
	echo $str;
}

?>