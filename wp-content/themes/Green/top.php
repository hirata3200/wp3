<?php
/****************************************

	Template Name: Top

	CHAPTER 22
	固定ページ「トップページ」用の
	テンプレートファイル

*****************************************/

get_header(); ?>

<!-- top.php -->
<div id="main-visual">
	<div class="wrapper">
		<?php /** カスタムヘッダー画像を表示 */ ?>
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
		<?php /** カスタム投稿タイプを表示（CHAPTER23）*/ ?>
		<aside id="information">
			<h2>お知らせ</h2>
			<p class="right-align"><a href="<?php echo esc_url( home_url( '/' ) ); ?>information/">お知らせ一覧へ</a></p>
			<div class="scroll">
				<?php /** カスタム投稿タイプ「お知らせ」を表示 */
				$args = array(
					'post_type' 		=> 'information',
					'posts_per_page' 	=> 5,
				);
				$information = new WP_Query( $args );
				if ( $information->have_posts() ) : /** 「お知らせ」用のサブループ開始 */ ?>
					<ul>
						<?php while ( $information->have_posts() ) : $information->the_post(); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?>&nbsp;<span>- <?php the_time( get_option( 'date_format' ) ); ?></span></a>
							</li>

						<?php endwhile; ?>
					</ul>
				<?php else : ?>
					<p>現在お知らせはありません。</p>
				<?php endif; /** サブループ終了 */
				wp_reset_postdata(); ?>
			</div>
		</aside><!-- / information -->
	</div>
</div><!-- / main-visual -->

<div id="container" class="container_12 clearfix">
	<?php if ( have_posts() ) : /** WordPressループ開始（メインループ） */
		while ( have_posts() ) : the_post();
			remove_filter ( 'the_content', 'wpautop' ); /** 投稿に自動挿入される <p> タグを削除 */
			the_content();
		endwhile;
	else : ?>
		<h3>Not Found</h3>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; /** WordPressループ終了 */ ?>
<!-- / top.php -->

<?php get_footer(); ?>