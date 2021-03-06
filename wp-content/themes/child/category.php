<?php
/****************************************

	index.php

	WordPressサイトには、なくてはならない
	テンプレートファイルです。

	index.php のコードに関しては、
	CHAPTER 9 で詳しく解説しています。

*****************************************/

get_header(); ?>

<!-- index.php -->
<div id="main">
	<p>これは category.php です！</p>
	<?php
		if ( have_posts() ) :

			// ループ開始
			while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<p class="post-meta">
						<?php
							/**
							 * 下記の the_date() を the_time( get_option( 'date_format' ) ) に書き換える（CHAPTER 9）
							 */
						?>
						<span class="post-date"><?php the_time( get_option('date_format' ) ); ?></span>
						<span class="category">Category - <?php the_category( ', ' ); ?></span>
						<span class="comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></span>
					</p>

					<?php
						/**
						 * コンテンツを表示する
						 */
						the_content( '続きを読む &raquo;', true );
					?>

				</div><!-- /#post -->

		<?php
			// ループ終了
			endwhile;


		// ここから記事が見つからなかった場合の処理
		else :  ?>

			<div class="post">

				<h2>記事はありません</h2>
				<p>お探しの記事は見つかりませんでした。</p>

			</div>

	<?php
		// if 文終了
		endif; ?>

	<?php
		/**
		 * ページャーを表示する
		 */
		if ( $wp_query->max_num_pages > 1 ) : ?>

			<div class="posts-navigation">
				<div class="nav-next"><?php previous_posts_link( '&laquo; NEXT' ); ?></div>
				<div class="nav-previous"><?php next_posts_link( 'PREV &raquo;' ); ?></div>
			</div>

	<?php
		// if 文終了
		endif; ?>

	<?php
		/**
		 * ページャーに the_posts_navigation() を使う場合は下記のコメントアウトを削除して有効化ください。
		 */

		//$args = array(
		//	'prev_text'          => 'PREV &raquo;',
		//	'next_text'          => '&laquo; NEXT',
		//	'screen_reader_text' => 'ページナビゲーション',
		//);

		//the_posts_navigation( $args );
	?>

	<?php
		/**
		 * ページネーション the_posts_pagination() を使う場合はコメントアウトを削除して有効化ください。
		 */

		//$args = array(
		//	'prev_text'          => '&laquo; NEXT',
		//	'next_text'          => 'PREV &raquo;',
		//	'mid_size'			 => 1,
		//	'show_all'			 => false,
		//	'screen_reader_text' => 'ページナビゲーション',
		//);

		//the_posts_pagination( $args );
	?>

</div><!-- /#main -->
<!-- / index.php -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>