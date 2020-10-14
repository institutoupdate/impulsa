<?php
/*
3	YARPP Template: Posts
4	Description: Posts related posts template.
5	Author: Impulsa
6	*/

if(have_posts()) :
  ?>
  <section class="block block--p-bottom-lg">
      <div class="container">
          <div class="grid grid--12">
              <div class="col-8 col-8--center">
                <h3 class="title-3 title-3--uppercase title-3--m-bottom"><?php echo pll__('Publicações relacionadas'); ?></h3>
  				<div class="grid grid--1-box">
  					<?php
  					while(have_posts()) { the_post();
  						get_template_part('loop-templates/article-blog');
  					}
  					?>
  				</div>
  				<!--/grid-->
              </div>
              <!--/col-8-center-->
          </div>
          <!--/grid-12-->
      </div>
      <!--/container-->
  </section>

  <?php
endif;
?>
