<?php

/** 
 * Functions file.
 * 
 * To getting start design the theme, please begins by reading on this link. https://codex.wordpress.org/Theme_Development
 * You can make this theme as your parent theme (design new by modify this theme and make it yours).
 * But I recommend that you use this theme as parent and create your new child theme.
 * 
 * Learn more about template hierarchy, please read on this link. https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package bootstrap-basic4
 */


// Required WordPress variable
if (!isset($content_width)) {
	$content_width = 1140; // this will be override again in inc/classes/BootstrapBasic4.php `detectContentWidth()` method.
}


// Configurations ----------------------------------------------------------------------------
// Left sidebar column size. Bootstrap have 12 columns this sidebar column size must not greater than 12.
if (!isset($bootstrapbasic4_sidebar_left_size)) {
	$bootstrapbasic4_sidebar_left_size = apply_filters('bootstrap_basic4_column_left', 3);
}
// Right sidebar column size.
if (!isset($bootstrapbasic4_sidebar_right_size)) {
	$bootstrapbasic4_sidebar_right_size = apply_filters('bootstrap_basic4_column_right', 3);
}
// Once you specified left and right column size, while widget was activated in all or some sidebar the main column size will be calculate automatically from these size and widgets activated.
// For example: you use only left sidebar (widgets activated) and left sidebar size is 4, the main column size will be 12 - 4 = 8.
// 
// Title separator. Please note that this value maybe able overriden by other plugins.
if (!isset($bootstrapbasic4_title_separator)) {
	$bootstrapbasic4_title_separator = '|';
}


// Require, include files ---------------------------------------------------------------------
require get_template_directory() . '/inc/classes/Autoload.php';
require get_template_directory() . '/inc/functions/include-functions.php';

// Setup auto load for load the class files without manually include file by file.
$Autoload = new \BootstrapBasic4\Autoload();
$Autoload->register();
$Autoload->addNamespace('BootstrapBasic4', get_template_directory() . '/inc/classes');
unset($Autoload);

// Call to actions/filters of the theme to enable features, register sidebars, enqueue scripts and styles.
$BootstrapBasic4 = new \BootstrapBasic4\BootstrapBasic4();
$BootstrapBasic4->addActionsFilters();
unset($BootstrapBasic4);

// Call to actions/filters of theme hook to hook into WordPress and make changes to the theme.
$Bsb4Hooks = new \BootstrapBasic4\Hooks\Bsb4Hooks();
$Bsb4Hooks->addActionsFilters();
unset($Bsb4Hooks);

// Call to auto register widgets.
$AutoRegisterWidgets = new BootstrapBasic4\Widgets\AutoRegisterWidgets();
$AutoRegisterWidgets->registerAll();
unset($AutoRegisterWidgets);

// Call to actions/filters of theme hook to hook into WordPress widgets.
$WidgetHooks = new \BootstrapBasic4\Hooks\WidgetHooks();
$WidgetHooks->addActionsFilters();
unset($WidgetHooks);

// Display theme help page for admin.
$ThemeHelp = new \BootstrapBasic4\Controller\ThemeHelp();
$ThemeHelp->addActionsFilters();
unset($ThemeHelp);


function my_like()
{
	status_header(200);
	//request handlers should exit() when they complete their task
	$post_id = $_REQUEST['post_id'];
	$like = get_post_meta($post_id, 'curtida', TRUE);
	$data = update_post_meta($post_id, "curtida", ($like + 1));

	if ($data >= 1) {
?>
		<script>
			window.history.back();
		</script>
<?php
	}
}
add_action('admin_post_my_like', 'my_like');
add_action('admin_post_nopriv_my_like', 'my_like');



function more_post_ajax()
{


	header("Content-Type: text/html");

	$args = array(
		'suppress_filters' => true,
		'post_type' => 'post',
		'posts_per_page' => $_POST["ppp"],
		'paged'    =>  $_POST['pageNumber'],
		'post__not_in' => explode(',', $_POST['not_in'])
	);

	$loop = new WP_Query($args);

	$out = '';

	if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();


			$img = (wp_get_attachment_url(get_post_thumbnail_id()) != '') ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/assets/img/no-copy.webp';
			$categories = get_the_category();
			/* $content = the_content(); //contents saved in a variable  */
			$out .= '<div class="mb-5" style="background-color: #E4E4E4;">';
			$out .= '<div class="row">';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12">';
			$out .= '<div class="more-cover"  style="height: 240px;">';
			$out .= '<img src="' . $img . '" class="more-img-thumbnail" >';
			$out .= '<div class="more-text">';
			$out .= '<div class="more-comment"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/contorno-em-forma-de-coracao-com-forro-na-borda-direita.webp"> ' . (get_field('curtida', $loop->ID) != '' ? '0' : get_field('curtida', $loop->ID)) . '</div>';
			$out .= '<div class="more-liked"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/comente.webp"> ' . get_comments_number() . '</div>';
			$out .= '<div class="more-notice-category"><a href="' . esc_url(get_term_link($categories[0]->term_id)) . '">' .  esc_html($categories[0]->name) . '</a></div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12 py-3 px-md-2 px-lg-2 px-xl-2 px-xxl-2 px-4">';
			$out .= '<div class="more-post-date-alt">' . get_the_date('j') . ' de ' . get_the_date('F') . '</div>';
			$out .= '<div class="more-title-alt py-2"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
			$out .= '<div class="more-description-alt pe-4">' . substr(get_the_excerpt(), 0, 200)  . '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';


		endwhile;
	endif;
	die(print_r($out));
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');



function more_post_ajax_cat()
{


	header("Content-Type: text/html");

	$args = array(
		'suppress_filters' => true,
		'post_type' => 'post',
		'posts_per_page' => $_POST["ppp"],
		'paged'    =>  $_POST['pageNumber'],
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $_POST['cat'],
			),
			'post__not_in' => explode(',', $_POST['not_in'])
		)
	);

	$loop = new WP_Query($args);

	$out = '';
	if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();


			$img = (wp_get_attachment_url(get_post_thumbnail_id()) != '') ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/assets/img/no-copy.webp';
			$categories = get_the_category();
			/* $content = the_content(); //contents saved in a variable  */
			$out .= '<div class="mb-5" style="background-color: #E4E4E4;">';
			$out .= '<div class="row">';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12">';
			$out .= '<div class="more-cover"  style="height: 240px;">';
			$out .= '<img src="' . $img . '" class="more-img-thumbnail" >';
			$out .= '<div class="more-text">';
			$out .= '<div class="more-comment"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/contorno-em-forma-de-coracao-com-forro-na-borda-direita.webp"> ' . (get_field('curtida', $loop->ID) != '' ? '0' : get_field('curtida', $loop->ID)) . '</div>';
			$out .= '<div class="more-liked"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/comente.webp"> ' . get_comments_number() . '</div>';
			$out .= '<div class="more-notice-category"><a href="' . esc_url(get_term_link($categories[0]->term_id)) . '">' .  esc_html($categories[0]->name) . '</a></div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12 py-3 px-md-2 px-lg-2 px-xl-2 px-xxl-2 px-4">';
			$out .= '<div class="more-post-date-alt">' . get_the_date('j') . ' de ' . get_the_date('F') . '</div>';
			$out .= '<div class="more-title-alt py-2"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
			$out .= '<div class="more-description-alt pe-4">' . substr(get_the_excerpt(), 0, 200)  . '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';


		endwhile;
	endif;

	die(print_r($out));
}

add_action('wp_ajax_nopriv_more_post_ajax_cat', 'more_post_ajax_cat');
add_action('wp_ajax_more_post_ajax_cat', 'more_post_ajax_cat');



function more_post_ajax_other()
{


	header("Content-Type: text/html");

	$args = array(
		'suppress_filters' => true,
		'post_type' => 'post',
		'posts_per_page' => $_POST["ppp"],
		'paged'    =>  $_POST['pageNumber'],
		'post__not_in' => explode(',', $_POST['not_in'])
	);

	$loop = new WP_Query($args);

	$out = '';

	if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();


			$img = (wp_get_attachment_url(get_post_thumbnail_id()) != '') ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/assets/img/no-copy.webp';
			$categories = get_the_category();
			/* $content = the_content(); //contents saved in a variable  */
			$out .= '<div class="mb-5" style="background-color: #E4E4E4;">';
			$out .= '<div class="row">';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12">';
			$out .= '<div class="more-cover"  style="height: 240px;">';
			$out .= '<img src="' . $img . '" class="more-img-thumbnail" >';
			$out .= '<div class="more-text">';
			$out .= '<div class="more-comment"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/contorno-em-forma-de-coracao-com-forro-na-borda-direita.webp"> ' . (get_field('curtida', $loop->ID) != '' ? '0' : get_field('curtida', $loop->ID)) . '</div>';
			$out .= '<div class="more-liked"><img src="' . site_url() . '/wp-content/themes/bootstrap-basic4/assets/img/icon/comente.webp"> ' . get_comments_number() . '</div>';
			$out .= '<div class="more-notice-category"><a href="' . esc_url(get_term_link($categories[0]->term_id)) . '">' .  esc_html($categories[0]->name) . '</a></div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="col-md-6 col-xl-6 col-xxl-6 col-12 py-3 px-md-2 px-lg-2 px-xl-2 px-xxl-2 px-4">';
			$out .= '<div class="more-post-date-alt">' . get_the_date('j') . ' de ' . get_the_date('F') . '</div>';
			$out .= '<div class="more-title-alt py-2"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
			$out .= '<div class="more-description-alt pe-4">' . substr(get_the_excerpt(), 0, 200)  . '</div>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';


		endwhile;
	endif;
	die(print_r($out));
}

add_action('wp_ajax_nopriv_more_post_ajax_other', 'more_post_ajax_other');
add_action('wp_ajax_more_post_ajax_other', 'more_post_ajax_other');
