<div class="social-bar">
    <div class="social-box">
        <span class="social__text">Goustou?</span>
        <div class="social social--bg">
            <a class="btn-circle" href="#"><i class="icon-thumbs-up"></i></a>
            <a class="btn-circle" href="#"><i class="icon-thumbs-down"></i></a>
        </div>
        <!--/social-->
    </div>
    <!--/social-box-->

    <div class="social-box">
        <span class="social__text">Compartilhe</span>
        <div class="social social--bg">
            <a class="btn-circle" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><i class="icon-facebook"></i></a>
            <a class="btn-circle" target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title() ?>&url=<?php the_permalink()?>"><i class="icon-twitter"></i></a>
            <a class="btn-circle" href="https://api.whatsapp.com/send?text=<?php echo rawurlencode(the_title().' '.the_permalink()); ?>" target="_blank"><i class="icon-whatsapp"></i></a>
        </div>
        <!--/social-->
    </div>
    <!--/social-box-->
</div>
<!--/social-bar-->