<?php
/****************************************

		page.php

		固定ページ用のデフォルトテンプレート

*****************************************/

get_header(); ?>

<!-- page.php -->
<div class="grid_9 push_3" id="main">
	<div class="box-top"></div>
	<article id="post-<?php the_ID(); ?>" <?php post_class('box-middle post'); ?>>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		else : ?>
			<h3>Not Found</h3>
			<p>Sorry, but you are looking for something that isn't here.</p>
		<?php endif; ?>
	</article>
	<div class="box-bottom"></div>
</div><!-- / main -->
<!-- / page.php -->

<?php get_sidebar();
get_footer(); ?>