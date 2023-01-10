<?php
/**
 * Имя шаблона: Страница поиска
 */
?>
<?php get_header(); ?>
    <section class="sect">
        <div class="breadcrumb">
            <a href="/">Главная</a> / <span>Результаты поиска</span>
        </div>
        <div class="sect__header d-flex">
            <h2 class="sect__title flex-grow-1">Результаты поиска для "<?=$_GET['search']?>"</h2>

        </div>
        <div class="sect__content">
            <div class="sect__content d-grid">


<?php

$the_query = new WP_Query(
    array(
        'posts_per_page' => -1,
        's' => $_GET['search'],
        'post_type'   => 'movie' )
);
if( $the_query->have_posts() ) :
    while( $the_query->have_posts() ): $the_query->the_post();

        $myquery = mb_strtolower($_GET['search']);

        $search = mb_strtolower(get_the_title());
        if( stripos("/{$search}/", $myquery) !== false) { ?>


            <a class="poster grid-item d-flex fd-column has-overlay" href="<?php echo esc_url(post_permalink()); ?>">
                <div class="poster__img img-responsive img-responsive--portrait img-fit-cover">
                    <?

                    if ( has_post_thumbnail() ) { ?>

                        <img  src="<?=the_post_thumbnail_url('medium')?>" alt="<?=the_title();?>">
                    <? }
                    ?>

                    <div class="poster__rating rating-<?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?>">  <?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?></div>
                    <div class="has-overlay__mask btn-icon anim"><span class="fal fa-play"></span>
                        <?= pvc_post_views( get_the_ID(), false );  ?>
                    </div>
                </div>
                <div class="poster__desc">
                    <h3 class="poster__title ws-nowrap"><?=the_title();?></h3>
                    <ul class="poster__subtitle ws-nowrap">
                        <?php if($release_year):?>
                            <li><?=$release_year?></li>
                        <?php endif;?>
                        <?php if($terms[0]->name):

                            ?>
                            <li><?
                                $key = 0;
                                foreach($terms as  $terms){
                                    $key++;
                                    if($key > 1) echo ', ';
                                    echo $terms->name;


                                }
                                ?></li>
                        <?php endif;?>
                    </ul>
                    <div class="poster__text line-clamp"><?=the_title();?></div>
                </div>
            </a>
            <?php

        }
    endwhile;

    wp_reset_postdata();
else: ?>
    <ul><li>Ничего не найдено</li></ul>

<?  endif; ?>

            </div>
        </div>
    </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>