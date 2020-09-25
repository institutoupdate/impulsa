<div class="pagination-flex">
    <?php if($prev) { ?>
    <a href="<?php echo get_permalink($prev).'.?track='.$track_id; ?>" class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__prev"><span class="btn__mobile">Anterior</span><span class="btn__desktop">Materais anterior</span></a>
    <?php } if($next) { ?>
    <a href="<?php echo get_permalink($next).'.?track='.$track_id; ?>" class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__next"><span class="btn__mobile">Siguiente</span><span class="btn__desktop">Siguiente materais</span></a>
    <?php } ?>
</div>
<!--/pagination-flex-->