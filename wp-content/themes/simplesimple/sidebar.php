<?php
//書き写し
?>
<!-- sidebar.php -->
<!-- sidebar -->
<div id="sidebar">
	<div class="widget">
		<h2>Recent Posts</h2>
		<?php $args = array( 'posts_per_page' => 3, );
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ) :  ?>
			<ul id="sidebar-recent-posts" class="sidebar-posts">
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<li class="clearfix">
					<div class="sidebar-recent-posts-title">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="sidebar-date"><?php  the_time( get_option( 'date_format' ) ); ?></p>
						<p class="sidebar-comment-num"><?php comments_popup_link( 'Comment : 0', 'Comment : 1', 'Comments : %' ); ?></p>

					</div>
					<p class="sidebar-thumbnail-box">
						<a href="<?php the_permalink(); ?>">ここから</a>
					</p>
			</li>
		</ul>
	</div>

	if ( is_active_sidebar( 'sidebar-1' )) :
		dynamic_sidebar('sidebar-1');
	endif;
	?>
</div>
<!-- /sidebar -->
<!-- /sidebar.php -->