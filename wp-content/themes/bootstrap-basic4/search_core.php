<div class="container">
    <div class="row">
        <div class="col-12">
            <button id="next_scroll"><i class="fa-solid fa-angle-right iconNext_scroll"></i></button>
            <div class="scrollmenu_ text-center" id="scrollDemo_" style="margin-top: 15px;">
                <ul class="menu-blog-category" id="slider_custom">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'category',
                        'hide_empty' => false,
                        'exclude' => array(1)
                    ));
                    foreach ($terms as $key => $item) {
                    ?>
                        <li id="<?php echo 'sldItem' . $key ?>"><a href="<?php echo esc_url(get_term_link($item)); ?>"><?php echo $item->name ?></a></li>
                    <?php } ?>
                    <input type="hidden" id="sldItemCount" value="<?php echo count($terms); ?>">
                </ul>
            </div>
            <button id="call_backScroll"><i class="fa-solid fa-angle-left iconCall_backScroll"></i></button>
        </div>
    </div>
</div>
<script>
    const scrollDemo_ = document.querySelector("#scrollDemo_");
    let countLeft_ = 0;
    document.getElementById('next_scroll').addEventListener('click', function() {
        if (countLeft_ <= scrollDemo_.scrollWidth) {
            countLeft_ = countLeft_ + 100;
            scrollDemo_.scrollLeft = countLeft_;
        }
    });
    document.getElementById('call_backScroll').addEventListener('click', function() {
        if (countLeft_ >= 0) {
            countLeft_ = countLeft_ - 100;
            scrollDemo_.scrollLeft = countLeft_;
        }
    });
</script>