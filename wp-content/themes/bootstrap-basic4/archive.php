<?php

/**
 * A Simple Category Template
 */
// begins template. -------------------------------------------------------------------------
get_header();
echo do_shortcode('[smartslider3 slider="2"]');
?>
<nav class="menu-institucional-container-blog">
    <div class="container py-2">
        <div class="row">
            <?php include 'search_core.php' ?>
        </div>
    </div>
    </div>
</nav>
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12">
            <?php
            $categories = get_the_category();
            $category_id = $categories[0]->cat_ID;
            ?>
            <h3 class="px-4 py-3 tag-section"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/book.webp"> <?php echo  single_cat_title(); ?></h3>

            <?php

            $new_cat = explode('/', $_SERVER['REDIRECT_URL']);
            $cat = $new_cat[1];
            $my_query = new WP_Query('posts_per_page=3&category_name=' . $cat);
            $total = new WP_Query('category_name=' . $cat);

            $count = $total->found_posts;
            $tags = array("<p>", "<em>", "</em>", "</p>", "<i>", "</i>", "<strong>", "</strong>");
            while ($my_query->have_posts()) {
                $my_query->the_post();
                $do_not_duplicate[] = $post->ID;

                $do_not_duplicate_ajax_princ .= $post->ID . ',';
                $categories = get_the_category();

                if (!empty($categories)) {
                    $category =  esc_html($categories[0]->name);
                }
                $post_date = get_the_date('j') . ' de ' . get_the_date('F');
                $char_limit = 160; //character limit
                $content = $post->post_content; //contents saved in a variable
                $like = get_field('curtida', $post->ID);

                if ($like) {
                    $curtida = $like;
                } else {
                    $curtida = '0';
                }

                $comments_number = get_comments_number();
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
                                    <div class="more-notice-category"><a href="<?php echo esc_url(get_term_link($categories[0]->term_id)); ?>"><?php echo $cat; ?></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 col-xxl-6 col-12 py-3 px-md-2 px-lg-2 px-xl-2 px-xxl-2 px-4">
                            <div class="more-post-date-alt"><?php echo $post_date; ?></div>
                            <div class="more-title-alt py-2"><a href="<?php echo the_permalink() ?>"><?php echo the_title(); ?></a></div>
                            <div class="more-description-alt pe-4"><?php echo substr($search_content, 0, 240); ?>.</div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div id="ajax-posts-cat"></div>
            <div class="text-end"><a href="javascript:void(0)" data-admin-url-cat="<?php echo admin_url('admin-ajax.php'); ?>" data-not-in-posts-cat="<?php echo $do_not_duplicate_ajax_princ ?>" data-category="<?php echo single_cat_title(); ?>" id="more_posts_category_princ" class="btn btn-orange rounded-0 px-4 py-2"><i class="fas fa-ellipsis-h fa-2x"></i></a></div>
            <h3 class="py-3 px-4 tag-section"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/sino.png"> Mais Notícias</h3>

            <?php
            $postsPerPage = 4;
            $args = array(
                'post_type' => array('post'),
                'post__not_in' => $do_not_duplicate,
                'posts_per_page' => $postsPerPage,
            );

            $tags = array("<p>", "<em>", "</em>", "</p>", "<i>", "</i>", "<strong>", "</strong>");
            $loop = new WP_Query($args);
            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();

                    $do_not_duplicate_ajax .= $post->ID . ',';
                    $categories = get_the_category();
                    $count = $loop->found_posts;
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
                                <div class="more-description-alt pe-4"><?php echo substr($search_content, 0, 240); ?>.</div>
                            </div>
                        </div>
                    </div>

            <?php endwhile;
                wp_reset_postdata();
            endif; ?>
            <div id="ajax-posts-other"></div>
            <div class="text-end"><a href="javascript:void(0)" data-admin-url-other="<?php echo admin_url('admin-ajax.php'); ?>" data-total-post="<?php echo $count; ?>" data-not-in-posts-other="<?php echo $do_not_duplicate_ajax ?>" id="more_posts_other" class="btn btn-orange rounded-0 px-4 py-2"><i class="fas fa-ellipsis-h fa-2x"></i></a></div>

        </div> <!-- end col-8 -->
        <div class="col-md-3 col-xxl-3 offset-md-1 offset-lg-1 offset-xl-1 offset-xxl-1 offset-0 col-12">
            <div>

                <h3 class="py-3 tag-section"><img src="<?php echo  site_url(); ?>/wp-content/themes/bootstrap-basic4/assets/img/icon/popular.png"> Populares</h3>
                <?php if (have_posts()) {

                    $my_query = new WP_Query('posts_per_page=4');
                    while ($my_query->have_posts()) {
                        $my_query->the_post();

                        $categories = get_the_category();
                        if (!empty($categories)) {
                            $category =  esc_html($categories[0]->name);
                        }
                        $post_date = get_the_date('j') . ' de ' . get_the_date('F');

                ?>
                        <div class="pt-2 border-bottom border-bottom-2">
                            <div class="row">
                                <div class="popular-description"><a href="<?php echo the_permalink() ?>"><?php echo substr(get_the_excerpt(), 0, 200); ?>.</a></div>
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
