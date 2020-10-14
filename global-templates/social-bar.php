<div class="social-bar">
    <div class="social-box">
        <span class="social__text"><?php echo pll__('Gostou?'); ?></span>
        <div id="post-vote" data-postid="<?php the_ID(); ?>" class="social social--bg">
            <a id="post-upvote" class="btn-circle" href="#">
              <i class="icon-thumbs-up"></i>
              <?php if(current_user_can("edit_pages")) echo '<span class="count">' . get_post_meta($post->ID, "impulsa_votes_up", true) . '</span>'; ?>
            </a>
            <a id="post-downvote" class="btn-circle" href="#">
              <i class="icon-thumbs-down"></i>
              <?php if(current_user_can("edit_pages")) echo '<span class="count">' . get_post_meta($post->ID, "impulsa_votes_down", true) . '</span>'; ?>
            </a>
        </div>
        <!--/social-->
    </div>
    <!--/social-box-->

    <div class="social-box">
        <span class="social__text"><?php echo pll__('Compartilhe'); ?></span>
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
