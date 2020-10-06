<div class="pagination-flex">
    <?php if($prev) { ?>
    <a href="<?php echo get_permalink($prev).'.?track='.$track_id; ?>" class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__prev"><span class="btn__mobile"><?php echo pll__('Anterior'); ?></span><span class="btn__desktop"><?php echo pll__('Materais anterior'); ?></span></a>
    <?php } if($next) { ?>
    <a href="<?php echo get_permalink($next).'.?track='.$track_id; ?>" class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__next"><span class="btn__mobile"><?php echo pll__('Seguinte'); ?></span><span class="btn__desktop"><?php echo pll__('Seguinte materais'); ?></span></a>
    <?php } ?>
</div>
<!--/pagination-flex-->