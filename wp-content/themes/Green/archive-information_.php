<?php
/****************************************

	archive-information.php

	CHAPTER 24

	カスタム投稿「information」を表示する archive.php

*****************************************/

get_header(); ?>

<!-- archive-information.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<div class="box-middle">
		<?php if ( have_posts() ) : /** ループ開始 */
			while ( have_posts() ) : the_post(); ?>
				<article class="post">
					<h3><?php the_title(); ?></h3>
					<time datetime="<?php echo get_the_date( 'Y-m-j' ) ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<?php the_content(); ?>
				</article>
		<?php endwhile;
		else : ?>
				<article class="post">
					<h3>Not Found</h3>
					<p>Sorry, but you are looking for something that isn't here.</p>
				</article>
		<?php endif; /* ループ終了 */ ?>
	</div>
	<div class="box-bottom"></div>

	<?php if ( function_exists( 'wp_pagenavi' ) ) : /** ページャープラグイン WP Pagenavi 用 */
		wp_pagenavi();
	else :
		if ( $wp_query->max_num_pages > 1 ) : /** 複数ページ用のナビゲーション */ ?>
			<nav class="navigation">
				<div class="alignleft"><?php previous_posts_link( '&laquo; NEXT' ); ?></div>
				<div class="alignright"><?php next_posts_link( 'PREV &raquo; ' ); ?></div>
			</nav>
		<?php endif;
	endif; ?>
</div><!-- / main -->
<!-- / archive-information.php -->

<?php get_sidebar();
get_footer(); ?>