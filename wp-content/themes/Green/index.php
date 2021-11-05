<?php
/****************************************

		index.php

*****************************************/

get_header(); ?>

<!-- index.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<div class="box-middle">
		<?php if ( have_posts() ) : /** ループ開始 */
			while ( have_posts() ) : the_post(); ?>
				<article <div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<time datetime="<?php echo get_the_date( 'Y-m-j' ) ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<p class="eyecatch">
						<?php if ( has_post_thumbnail() ) : /** アイキャッチ画像 */ ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="" /></a>
						<?php endif; ?>
					</p>
					<?php the_excerpt(); ?>
					<p class="right-align link">
						<a href="<?php the_permalink(); ?>">続きを読む »</a>
					</p>
				</article>
			<?php endwhile;
		else : ?>
				<article class="post">
					<h3>Not Found</h3>
					<p>Sorry, but you are looking for something that isn't here.</p>
				</article>
		<?php endif; /** ループ終了 */ ?>
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
<!-- / index.php -->

<?php get_sidebar();
get_footer(); ?>