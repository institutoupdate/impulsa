<?php
// Template name: External Links
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
?>

<main class="block block--pad-3 block--search js-first-block">
    <div class="container">
        <h2 class="title-2 title-2--m-bottom">Im.pulsa na mídia</h2>
        <div class="grid grid--4y8">

            <aside class="sidebar ">

                <div class="box box--m-bottom">
                    <h5 class="title-3 title-3--sm title-3--uppercase title-3--m-bottom-xsm">Contacto</h5>
                    <ul class="list">
                        <li><a href="mailto:contacto@impulsa.voto">contacto@impulsa.voto</a></li>
                        <li><a href="tel:+52123455612">+52 123 455612</a></li>
                        <li>Lorem ipsum 123, Rio de Janeiro, Brasil</li>
                    </ul>
                </div>
                <!--/box-->

                <div class="box">
                    <h5 class="title-3 title-3--sm title-3--uppercase title-3--m-bottom-xsm">MEDIAKIT</h5>
                    <ul class="list list--download">
                        <li><a href="download.txt" download><i class="icon-download-cloud"></i><span><span>Manual de marca</span> (2MB, PDF)</span></a></li>
                        <li><a href="download.txt" download><i class="icon-download-cloud"></i><span><span>Logo y regursos</span> (3MB, AI)</span></a></li>
                    </ul>
                </div>
                <!--/box-->

            </aside>
            <!--/sidebar-->

            <section class="block__main">

                <h3 class="title title--m-bottom"><strong class="title__block title__900">Publicaciones en los medios</strong>Lorem ipsum dolor sit amet</h3>
                
                <div class="grid grid--1-box">

                    <div class="box box--radius box--stackable box--bg-white box--pad">
                        <article class="article article--2 article--c-2">

                            <div class="article__header">
                                <ul class="article__tag-list">
                                    <li><span class="article__tag article__tag--bg-2">Midia</span></li>
                                </ul>
                                <span class="article__header__text">2 materais, 9 minutos</span>
                            </div>
                            <!--/article__header-->

                            <div class="article__content">
                                <h5 class="article__title"><a href="#">Comunicação para planejamento da campanha</a></h5>
                                <p class="article__excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            </div>
                            <!--/article__content-->

                            <div class="article__footer">
                                <a href="#" class="btn" target="_blank" rel="nofollow noopener noreferrer">Abrir en sitio externo <i class="icon-external-link"></i></a>
                            </div>
                            <!--/article__footer-->

                        </article>
                        <!--/article-->
                    </div>
                    <!--/box-->

                </div>
                <!--/grid-1-box-->

            </section>
            <!--/block-main-->

        </div>
        <!--/grid-4y8-->
    </div>
    <!--/container-->
</main>
<!--/block-->

<?php 
endwhile; else: endif;
get_footer();
?>