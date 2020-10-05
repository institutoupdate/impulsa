<?php


// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');

function data_fetch(){

    $args = array(
        'post_type' => array('post', 'materials', 'tracks'),
        'posts_per_page' => -1,
        's' => esc_attr( $_POST['s'] )
    );
    $the_query = new WP_Query($args);
    
    if( $the_query->have_posts() ) :

        while( $the_query->have_posts() ): $the_query->the_post();
            $post_type = get_post_type(get_the_ID());
            ?>

            <a href="<?php the_permalink(); ?>" class="search__item article article--sz-sm">
                <p class="article__title"><?php the_title(); ?></p>
                <?php if($post_type === 'post') { ?>
                <span class="article__tag article__tag--bg-3">Blog</span>
                <?php } elseif($post_type == 'materials') { ?>
                <span class="article__tag article__tag--bg-2">Material</span>
                <?php } else { ?>
                <span class="article__tag article__tag--bg-1">Sendero</span>
                <?php } ?>
            </a>

        <?php endwhile;
        wp_reset_postdata();

        else :

        echo '<div class="search__container"><p>No se han encontrado resultados. Prueba con otra búsqueda.</p></div>';

    endif;
    
    die();
}