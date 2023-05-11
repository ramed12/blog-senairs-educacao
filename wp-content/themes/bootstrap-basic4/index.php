<?php

/**
 * The main template file.
 * 
 * To override home page (for listing latest post) add home.php into the theme.<br>
 * If front page displays is set to static, the index.php file will be use.<br>
 * If front-page.php exists, it will be override any home page file such as home.php, index.php.<br>
 * To learn more please go to https://developer.wordpress.org/themes/basics/template-hierarchy/ .
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();
echo do_shortcode('[smartslider3 slider="2"]');
?>
<style>
    .search-input:active {
        border-color: none;
    }
</style>
<nav class="menu-institucional-container-blog">
    <div class="container">
        <div class="row">
            <?php include 'search_core.php' ?>
        </div>
    </div>
</nav>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12">
            <h3 class="px-4 py-3 tag-section"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/book.png"> Últimos Conteúdos</h3>
            <div class="owl-carousel owl-theme">
                <?php $my_query = new WP_Query('posts_per_page=3');

                $tags = array("<p>", "<em>", "</em>", "</p>", "<i>", "</i>", "<strong>", "</strong>");
                ?>
                <?php while ($my_query->have_posts()) {
                    $my_query->the_post();
                    $do_not_duplicate[] = $post->ID;

                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $category =  esc_html($categories[0]->name);
                    }
                    $post_date = get_the_date('j') . ' de ' . get_the_date('F');
                    $content = get_the_content(); //contents saved in a variable
                    $search_text = get_the_excerpt();
                    $search_content = str_replace($tags, "", $content);
                ?>
                    <div class="item" style="background: #f4f4f4">

                        <img src="<?php echo the_post_thumbnail_url(); ?>" class="img-carousel" style="image-rendering: -webkit-optimize-contrast;">

                        <div class="px-4 py-4">
                            <div class="row">
                                <div class="tag-category w-50 py-4"><a href="<?php echo esc_url(get_term_link($categories[0]->term_id)); ?>"><?php echo $category; ?></a></div>
                                <div class="tag-post-date w-50 py-4"><?php echo $post_date; ?></div>
                                <div class="py-3 tag-title"><?php echo the_title(); ?></div>
                                <div class="tag-description"><?php echo get_the_excerpt(); ?></div>
                                <div class="text-end"><a href="<?php echo the_permalink() ?>" class="btn btn-orange rounded-0 px-5 py-2">LEIA MAIS</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div> <!-- end owl-carousel -->

            <?php if (count($do_not_duplicate) >= 3) : ?>
                <h3 class="py-3 px-4 tag-section"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/sino.png"> Mais Conteúdos</h3>

                <?php
                $postsPerPage = 4;
                $args = array(
                    'post_type' => array('post'),
                    'post__not_in' => $do_not_duplicate,
                    'posts_per_page' => $postsPerPage,
                );

                $loop = new WP_Query($args);
                $tags = array("<p>", "<em>", "</em>", "</p>", "<i>", "</i>", "<strong>", "</strong>");
                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();

                        $do_not_duplicate_ajax .= $post->ID . ',';
                        $categories = get_the_category();
                        $post_date = get_the_date('j') . ' de ' . get_the_date('F');
                        if (!empty($categories)) {
                            $category =  esc_html($categories[0]->name);
                        }


                        $like = get_field('curtida', $post->ID);

                        if ($like) {
                            $curtida = $like;
                        } else {
                            $curtida = '0';
                        }
                        $comments_number = get_comments_number();

                        $char_limit = 200; //character limit
                        $content = get_the_content(); //contents saved in a variable
                        $search_text = get_the_excerpt();
                        $search_content = str_replace($tags, "", $content);
                        $img = (wp_get_attachment_url(get_post_thumbnail_id()) != '') ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/assets/img/no-copy.webp';
                ?>

                        <div style="background-color: #E4E4E4;" class="mb-5">
                            <div class="row">
                                <div class="col-md-6 col-xl-6 col-xxl-6 col-12">
                                    <div class="more-cover" style="height: 240px;">
                                        <img src="<?php echo $img; ?>" class="more-img-thumbnail">
                                        <div class="more-text">
                                            <div class="more-comment"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/contorno-em-forma-de-coracao-com-forro-na-borda-direita.png"> <?php echo  $curtida; ?></div>
                                            <div class="more-liked"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/comente.png"> <?php echo $comments_number; ?></div>
                                            <div class="more-notice-category"><a href="<?php echo esc_url(get_term_link($categories[0]->term_id)); ?>"><?php echo $category; ?></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-6 col-xxl-6 col-12 py-3 px-md-2 px-lg-2 px-xl-2 px-xxl-2 px-4">
                                    <div class="more-post-date-alt"><?php echo $post_date; ?></div>
                                    <div class="more-title-alt py-2"><a href="<?php echo the_permalink() ?>"><?php echo the_title(); ?></a></div>
                                    <div class="more-description-alt pe-4"><?php echo substr($search_text, 0, 200,) ?>...</div>
                                </div>
                            </div>
                        </div>

                <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
                <div id="ajax-posts"></div>
                <div class="text-end"><a href="javascript:void(0)" data-pagenumber="1" data-admin-url="<?php echo admin_url('admin-ajax.php'); ?>" data-not-in-posts="<?php echo $do_not_duplicate_ajax ?>" id="more_posts" class="btn btn-orange rounded-0 px-4 py-2"><i class="fas fa-ellipsis-h fa-2x"></i></a></div>
            <?php endif; ?>
        </div> <!-- end col-8 -->
        <div class="col-md-3 col-xxl-3 offset-md-1 offset-lg-1 offset-xl-1 offset-xxl-1 offset-0 col-12">
            <div>

                <h3 class="py-3 tag-section "><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/popular.webp"> Populares</h3>
                <?php if (have_posts()) { ?>

                    <?php $my_query = new WP_Query('posts_per_page=4'); ?>
                    <?php while ($my_query->have_posts()) {
                        $my_query->the_post();

                        $categories = get_the_category();
                        if (!empty($categories)) {
                            $category =  esc_html($categories[0]->name);
                        }
                        $post_date = get_the_date('j') . ' de ' . get_the_date('F');

                    ?>
                        <div class="pt-2 border-bottom border-bottom-2">
                            <div class="row">
                                <div class="popular-description"><a href="<?php echo the_permalink() ?>"><?php echo the_title(); ?></a></div>
                                <div class="tag-category py-4"><a href="<?php echo esc_url(get_term_link($categories[0]->term_id)); ?>"><?php echo $category; ?></a></div>
                            </div>
                        </div>
                <?php }
                }
                ?>
            </div>
            <div>
                <h3 class="py-3 tag-section"><i class="fab fa-instagram"></i> Estamos no insta!</h3>
                <div id="instafeed"></div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

<script src="<?php echo get_template_directory_uri() . '/assets/js/carousel.js'; ?>"></script>