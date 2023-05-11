<?php

/** 
 * The single post.<br>
 * This file works as display full post content page and its comments.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();

// echo do_shortcode('[smartslider3 slider="2"]'); 
?>
<img src="<?php echo the_post_thumbnail_url(); ?>" class="img-fluid w-100 img-header ">
<!-- <div><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-fluid"></div> -->


<nav class="menu-institucional-container-blog">
    <div class="container">
        <div class="row">
            <?php include 'search_core.php' ?>
        </div>
    </div>
</nav>
<div class="container p-5">
    <div class="row">
        <div class="col-2 text-end py-3 d-none d-sm-block">
            <div class="col-12">
                <span class="fa-stack fa-1x i-facebook">
                    <a href="javascript:void(0)" title="Compartilhe no Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.title)); return false;">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
            <div class="col-12 mt-2">
                <span class="fa-stack fa-1x i-linkedin">
                    <a href="javascript:void(0)" target="_blank" onclick="window.open('http://www.linkedin.com/ShareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title)); return false;">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
            <div class="col-12 mt-2">
                <span class="fa-stack fa-1x i-youtube">
                    <a href="javascript:void(0)" target="_blank" onclick="window.open('mailto:subject=' + encodeURIComponent(document.title) + '&body=' + encodeURIComponent(document.URL)); return false;">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
            <div class="col-12 mt-2">
                <span class="fa-stack fa-1x i-instagram">
                    <a href="https://www.youtube.com/channel/UCfYDyZ9XxOFw9J3ijgd8pYA">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
            <div class="col-12 mt-2">
                <span class="fa-stack fa-1x i-youtube">
                    <a href="<?php echo admin_url('admin-post.php?action=my_like&post_id=' . $post->ID); ?>" id="more_posts">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-heart fa-stack-1x fa-inverse"></i>
                    </a>
                </span>
            </div>
        </div>
        <div class="col-sm-10 col-12">
            <div class="col-12">
                <div class="single-title">
                    <h1><?php echo the_title(); ?></h1>
                </div>
            </div>
            <div class="col-12 py-2">
                <div class="single-date"><?php echo get_the_date('j/m/Y'); ?></div>
            </div>
            <div class="col-12 d-block d-sm-none text-center">
                <div class="row">
                    <div class="col-2">
                        <span class="fa-stack fa-1x i-facebook">
                            <a href="javascript:void(0)" title="Compartilhe no Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.title)); return false;">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </a>
                        </span>
                    </div>
                    <div class="col-2">
                        <span class="fa-stack fa-1x i-linkedin">
                            <a href="javascript:void(0)" target="_blank" onclick="window.open('http://www.linkedin.com/ShareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' + encodeURIComponent(document.title)); return false;">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
                            </a>
                        </span>
                    </div>
                    <div class="col-2">
                        <span class="fa-stack fa-1x i-youtube">
                            <a href="javascript:void(0)" target="_blank" onclick="window.open('mailto:subject=' + encodeURIComponent(document.title) + '&body=' + encodeURIComponent(document.URL)); return false;">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
                            </a>
                        </span>
                    </div>
                    <div class="col-2">
                        <span class="fa-stack fa-1x i-instagram">
                            <a href="https://www.youtube.com/channel/UCfYDyZ9XxOFw9J3ijgd8pYA">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-link fa-stack-1x fa-inverse"></i>
                            </a>
                        </span>
                    </div>
                    <div class="col-2">
                        <span class="fa-stack fa-1x i-youtube">
                            <a href="<?php echo admin_url('admin-post.php?action=my_like&post_id=' . $post->ID); ?>" id="more_posts">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-heart fa-stack-1x fa-inverse"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-12 py-2">
                <div class="single-description"><?php echo get_the_content(); ?></div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col012 col-sm-10 offset-sm-2">
            <?php
            if (comments_open() || '0' != get_comments_number()) {
                comments_template();
            }
            echo "\n\n";
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
