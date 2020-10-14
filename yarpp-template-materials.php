<?php
/*
3	YARPP Template: Materials
4	Description: Materials related posts template.
5	Author: Impulsa
6	*/

if(have_posts()) :
  ?>
  <section class="block block--p-bottom-lg">
      <div class="container">
          <div class="box box--border box--bg-gray box--pad-3">

              <div class="box__header">
                <?php if(isset($_GET['track'])) { ?>
                <h4 class="title-3 title-3--uppercase"><?php echo pll__('Trilhas relacionadas'); ?></h4>
                <?php } else { ?>
                <h4 class="title-3 title-3--uppercase"><?php echo pll__('Materais relacionadas'); ?></h4>
                <?php } ?>
              </div>
              <!--/box-header-->
              <div class="grid grid--3-box">


  <?php
  while(have_posts()) : the_post();
      set_query_var( 'article_excerpt', 125);
      if(isset($_GET['track'])) {
          get_template_part('loop-templates/article-track');
      } else {
          get_template_part('loop-templates/article-material');
      }
  endwhile;
  ?>
</div>
</div>
<!--/box-->
</div>
<!--/container-->
</section>
<!--/block-->

  <?php
endif;
