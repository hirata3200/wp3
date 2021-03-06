<?php
/****************************************

	single-product.php

	カスタム投稿「product」の
	個別投稿用テンプレートファイル

	CHAPTER 24

*****************************************/

get_header(); ?>

<!-- single-product.php -->

<div class="grid_9 push_3" id="main">

	<div class="box-top"></div>
	<article class="box-middle post">

		<?php if (have_posts()) : /* ループ開始 */

			while (have_posts()) : the_post(); ?>

				<h3><?php the_title(); /* タイトル */ ?></h3>

				<?php the_content(); /* 投稿のコンテンツ */

			endwhile;

		else : ?>

			<h3>Not Found</h3>

			<p>Sorry, but you are looking for something that isn't here.</p>

		<?php endif; /* ループ終了 */ ?>

	</article>
	<div class="box-bottom"></div>

<?php

/**
 * ここから関連記事の表示
 */

if( get_the_terms( $post->ID, 'roomtype' ) || get_the_terms( $post -> ID, 'item' ) ) :
	$args = array(
		'post_type' 		=> 'product',
		'post__not_in' 		=>  array( $post->ID ),
		'orderby' 			=> 'rand',
		'posts_per_page' 	=> 6,
		'tax_query' 		=> array(
			'relation' 		=> 'OR',
			array(
				'taxonomy' 	=> 'roomtype',
				'field' 	=> 'slug',
				'terms' 	=> get_my_terms_array( 'roomtype' ),
			),
			array(
				'taxonomy' 	=> 'item',
				'field' 	=> 'slug',
				'terms' 	=> get_my_terms_array( 'item' ),
			)
		)
	);
	$related = new WP_Query( $args );

	if ( $related -> have_posts() ) : /* サブループ開始 */ ?>
		<aside class="related">
			<div class="related hgroup clearfix">
				<h2>関連製品</h2>
				<h3>Related products</h3>
			</div>
			<?php while ( $related->have_posts() ) : $related->the_post(); /* 繰り返し処理開始 */ ?>
				<article class="grid_3 <?php echo add_class( $related ); /* Green 独自関数 - テーマ用のクラスを付ける */ ?>">
					<div class="box-link">
						<div class="box-s-top"></div>
						<div class="box-s-middle equal-height">

							<!-- 見出し -->
							<div class="hgroup">
								<h3><?php the_title(); ?></h3>
								<?php if ( get_post_meta($post->ID, 'sub-title', true) ) : ?>
									<h4 class="subtitle"><?php echo esc_html( get_post_meta( $post->ID, 'sub-title', true) ); ?></h4>
								<?php else : ?>
									<h4 class="subtitle">SUBTITLE</h4>
								<?php endif; ?>
							</div>

							<?php /*  アイキャッチ画像 */
							if ( has_post_thumbnail() ) :
								the_post_thumbnail();
							else : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/default.jpg" alt="" />
							<?php endif; ?>
							<p class="rigft-align link">
								<a href="<?php the_permalink(); ?>">詳しく見る</a>
							</p>
						</div>
						<div class="box-s-bottom"></div>
					</div>
				</article>
			<?php endwhile; /* 繰り返し処理終了 */ ?>
		</aside>
	<?php endif; /* サブループ終了 */
	wp_reset_postdata();
endif; ?>
</div>
<!-- /main -->
<!-- /single-products.php -->
<?php get_sidebar();
get_footer(); ?>