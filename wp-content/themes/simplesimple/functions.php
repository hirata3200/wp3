<?php
// 書き写し




if ( ! isset( $content_width ) ) $content_width = 600;

add_theme_support( 'automatic-feed-links' );

register_sidebar( array(
	'name'			=> 'サイドバーウィジット-1',
	'id'			=> 'sidebar-1',
	'description'	=> 'サイドバーのウィジットエリアです。デフォルトのサイドバーと丸ごと入れ替えたいときに使ってください。',
    'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
    'after_widget'	=> '</div>',
) );
add_theme_support( 'menus' );

register_nav_menu( 'header-navi', 'ヘッダーのナビゲーション' );
register_nav_menu( 'sidebar-navi', 'サイドバーのナビゲーション' );
register_nav_menu( 'footer-navi', 'フッターのナビゲーション' );

add_theme_support( 'post-thumbnails' );

function new_excerpt_more( $more ) {
	return ' ... ';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

$args = array(
	'width'			=> 940,
	'height'		=> 250,
	'flex-height'	=> true,
	'header-text'	=> true,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
	'uploads'		=> true,
);
add_theme_support( 'custom-header', $args );

function header_style()
{ ?>
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



add_image_size('header-image', 940, 250, true);



function breadcrumb()
{
	global $post;
	$separater 	= '<li>&gt;</li>';
	$str 		= '';
	if (!is_home() && !is_admin()) {

		$str .= '<div id="breadcrumb" class="clearfix">';
		$str .= '<ul>';
		$str .= '<li><a href="' . esc_url(home_url('/')) . '">HOME</a></li>';
		$str .= $separater;
		if (is_search()) {
			$str .= '<li>「' . esc_html(get_search_query()) . '」で検索した結果</li>';
		} elseif (is_tag()) {
			$str .= '<li>タグ : ' . single_tag_title('', false) . '</li>';
		} elseif (is_404()) {
			$str .= '<li>404 Not found</li>';
		} elseif (is_date()) {
			if (is_day()) {
				$str .= '<li><a href="' . get_year_link(get_query_var('year')) . '">' . get_query_var('year') . '年</a></li>';
				$str .= $separater;
				$str .= '<li><a href="' . get_month_link(get_query_var('year'), get_query_var('monthnum')) . '">' . get_query_var('monthnum') . '月</a></li>';
				$str .= $separater;
				$str .= '<li>' . get_query_var('day') . '日</li>';
			} elseif (is_month()) {
				$str .= '<li><a href="' . get_year_link(get_query_var('year')) . '">' . get_query_var('year') . '年</a></li>';
				$str .= $separater;
				$str .= '<li>' . get_query_var('monthnum') . '月</li>';
			} elseif (is_year()) {
				$str .= '<li>' . get_query_var('year') . '年</li>';
			}
		} elseif (is_category()) {
			$cat = get_queried_object();
			if ($cat->parent != 0) {
				$ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
				foreach ($ancestors as $ancestor) {
					$str .= '<li><a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html(get_cat_name($ancestor)) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li>' . $cat->name . '</li>';
		} elseif (is_author()) {
			$str .= '<li>投稿者 : ' . esc_html(get_the_author_meta('display_name', get_query_var('author'))) . '</li>';
		} elseif (is_page()) {
			if ($post->post_parent != 0) {
				$ancestors = array_reverse(get_ancestors($post->ID, 'page'));
				foreach ($ancestors as $ancestor) {
					$str .= '<li><a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li>' . esc_html($post->post_title) . '</li>';
		} elseif (is_attachment()) {
			if ($post->post_parent != 0) {
				$str .= '<li><a href="' . esc_url(get_permalink($post->post_parent)) . '">' . esc_html(get_the_title($post->post_parent)) . '</a></li>';
				$str .= $separater;
			}
			$str .= '<li>' . esc_html($post->post_title) . '</li>';
		} elseif (is_single()) {

			$categories = get_the_category($post->ID);
			$cat 		= $categories[0];
			if ($cat->parent != 0) {
				$ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
				foreach ($ancestors as $ancestor) {
					$str .= '<li><a href="' . esc_url(get_category_link($ancestor)) . '">' . esc_html(get_cat_name($ancestor)) . '</a></li>';
					$str .= $separater;
				}
			}
			$str .= '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . $cat->cat_name . '</a></li>';
			$str .= $separater;
			$str .= '<li>' . esc_html($post->post_title) . '</li>';
		} else {
			$str .= '<li>' . wp_title('', true) . '</li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
	}
	echo $str;
}




function my_main_query($query)
{
	if (!is_admin() && $query->is_main_query()) {
		if ($query->is_search) {

			$query->set('post_type', 'post');
		} elseif ($query->is_category || $query->is_tag) {
		} elseif ($query->is_home) {
		}
	}
}
add_action('pre_get_posts', 'my_main_query');




function my_comment_list($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="clearfix">
			<div class="comment-author clearfix">
				<?php echo get_avatar($comment->comment_author_email, 65); ?>
				<p class="comment-author-name"><?php comment_author_link(); ?><span class="says">says:</span></p>
				<p class="comment-meta"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php comment_date(); ?>
						<span><?php comment_time(); ?></span></a><br />
					<?php edit_comment_link('(編集)'); ?>
				</p>
			</div>
			<div class="comment-body">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em>あなたのコメントは承認待ちです。</em></p>
				<?php endif;
				comment_text(); ?>
				<p class="reply">
					<?php comment_reply_link(array_merge($args, array(
						'reply_text' => '返信',
						'depth' => $depth,
						'max_depth' => $args['max_depth'],
					))); ?>
				</p>
			</div>
		</div>
	<?php }




add_filter('comment_form_default_fields', 'comment_form_custom_fields');



function comment_form_custom_fields($fields)
{
	$commenter 	= wp_get_current_commenter();
	$req 		= get_option('require_name_email');
	$aria_req 	= ($req ? " aria-required='true'" : '');

	$fields['author'] 	= '<p class="comment-form-author"><label for="author">お名前</label> ' . ($req ? '<span class="required">*</span>' : '') . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';

	$fields['email']	= '<p class="comment-form-email"><label for="email">メールアドレス</label> ' . ($req ? '<span class="required">*</span> <span class="small">（メールアドレスは公開されません）</span>' : '') . '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';








	$fields['url'] 		= '';
	return $fields;
}



add_filter('comment_form_defaults', 'comment_form_custom');

function comment_form_custom($form)
{
	global $user_identity, $post;
	$req 			= get_option('require_name_email');
	$required_text 	= '<span class="required">*</span> が付いている項目は、必須項目です！';

	$form['comment_field'] 			=  '<p class="comment-form-comment"><label for="comment">コメント</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

	$form['must_log_in'] 			= '<p class="must-log-in">' .  sprintf('コメントを残すには、<a href="%s">ログイン</a>してください。', wp_login_url(apply_filters('the_permalink', get_permalink($post->ID)))) . '</p>';

	$form['logged_in_as'] 			= '<p class="logged-in-as">' . sprintf('<a href="%1$s">%2$s</a> としてログインしています。<a href="%3$s" title="Log out of this account">ログアウト</a>しますか？', admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post->ID)))) . '</p>';


	$form['comment_notes_before'] 	= '<p class="comment-notes">' . ($req ? $required_text : '') . '</p>';









	$form['comment_notes_after'] 	= '';

	$form['id_form'] 				= 'commentform';

	$form['id_submit'] 				= 'submit';


	$form['title_reply'] 			= 'Leave a Reply';

	$form['title_reply_to'] 		= 'Leave a Reply to %s';

	$form['cancel_reply_link'] 		= '(or Cancel)';

	$form['label_submit'] 			= 'Post Comment';
	return $form;
}
	?>