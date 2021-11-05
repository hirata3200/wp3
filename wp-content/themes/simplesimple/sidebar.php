<?php
//書き写し
?>
<!-- sidebar.php -->
<!-- sidebar -->



<div id="sidebar">
	<p></p>

	<!--  -->
	<div class="widget">
		<h2>Recent Posts</h2>
	<?php
		/**
		 * 
		 */
		$args = array(
			'posts_per_page' => 3,
		);
		$my_query = new WP_Query( $args );

		// 
		if ( $my_query->have_posts() ) :  ?>
			<ul id="sidebar-recent-posts" class="sidebar-posts">
		<?php
			// 
			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

				<?php
				/**
				 * 
				 * 
				 * 
				 */
				get_template_part( 'sidebarposts' ); ?>
		<?php
			// 
			endwhile; ?>
			</ul>
	<?php
		else :
			/**
			 * 
			 * 
			 * 
			 */
			get_template_part( 'sidebarposts', 'none' );

		// 
		endif;
		wp_reset_postdata(); ?>
	</div>
	<!--  -->

	<!--  -->
	<div class="widget">
		<h2>Popular Posts</h2>
	<?php
		/**
		 * 
		 */
		$args = array(
			'posts_per_page'	=> 3,
			'orderby' 			=> 'comment_count',
		);
		$my_query = new WP_Query( $args );

			// 
		if ( $my_query->have_posts() ) : ?>
			<ul id="sidebar-recent-posts" class="sidebar-posts">
		<?php
			// 
			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

				<?php
				/**
				 * 
				 * 
				 * 
				 */
				 get_template_part( 'sidebarposts' ); ?>

		<?php
			//
			endwhile; ?>
			</ul>
	<?php
		else :
			/**
			


			 */
			get_template_part( 'sidebarposts', 'none' );

		// 
		endif;
		wp_reset_postdata(); ?>
	</div>
	<!--  -->

	<!--  -->
	<div class="widget">
		<h2>Tag Cloud</h2>
		<?php $args = array(
			'smallest' 	=> 14,
			'largest' 	=> 18,
			'unit' 		=> 'px',
			'number' 	=> 0,
			'format' 	=> 'flat',
			'taxonomy' 	=> 'post_tag',
			'echo' 		=> true,
		); ?>
		<p class="tagcloud">
			<?php wp_tag_cloud( $args ); ?>
		</p>
	</div>
	<!--  -->

<?php
	// 
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		dynamic_sidebar( 'sidebar-1' );
	endif; ?>

</div><!-- /sidebar -->

<!-- /sidebar.php -->