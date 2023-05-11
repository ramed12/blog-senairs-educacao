<?php

/** 
 * The search template.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();
include("youtube.php");
echo do_shortcode('[smartslider3 slider="2"]');
?>
<!-- <div><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" class="img-fluid"></div> -->

<nav class="menu-institucional-container-blog">
    <div class="container py-2 ">
        <div class="row">
            <?php include 'search_core.php' ?>
        </div>
    </div>
</nav>

<div class="container p-2">
    <div class="row">
        <div class="col-12 text-center py-5">
            <h2><?php printf(__('<i class="fas fa-search fa-1x"></i> Resultado da pesquisa: %s'), '<span><strong>' . get_search_query() . '</strong></span>'); ?></h2>
        </div>
        <div class="col-12">
            <?php if (have_posts()) { ?>

                <div class="row">

                    <?php while (have_posts()) {
                        the_post(); ?>

                        <div class="col-sm-4 col-12 mb-5">
                            <div class="card shadow" style="height: 350px !important;">
                                <?php $img = (wp_get_attachment_url(get_post_thumbnail_id()) != '') ? wp_get_attachment_url(get_post_thumbnail_id()) : get_template_directory_uri() . '/assets/img/no-copy.webp'; ?>
                                <img src=" <?php echo $img; ?>" style="height: 160px !important;" class="img-fluid">
                                <?php $post_date = get_the_date('j') . ' de ' . get_the_date('F'); ?>
                                <p style="    color: #626262; margin: 10px; margin-left: 15px; font-size: 15px; font-weight: 400;"><?php echo $post_date; ?></p>
                                <div class="card-body">
                                    <h5 style="text-align: left;"> <a href="<?php echo get_permalink(); ?>" style="color:#F39720"> <?php echo (get_the_title()); ?></a></h5>
                                    <!--<div style="text-align: left;"> <?php echo substr(get_the_excerpt(), 0, 100); ?></div>-->
                                </div>
                                <!--<div class="card-footer text-end" style="border-top: none;background:transparent"> 
                            <a href="<?php the_permalink(); ?>" class="btn btn-orange " style="border-radius: 25px;">Saiba mais</a>
                        </div>-->
                            </div>
                        </div>

                    <?php } ?>

                </div>

                <div class="col-12 text-center py-4">
                    <?php echo paginate_links(); ?>
                </div>

            <?php } else { ?>
                <div class="text-center">
                    <img src="<?php echo  get_template_directory_uri() . '/assets/img/Group_2302.png' ?>" class="img-fluid py-4">
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
get_footer();
