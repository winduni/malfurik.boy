<?php
/**
 * Display Movie Category
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Moview
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
$term = get_queried_object();
?>

    <section class="sect">
        <div class="breadcrumb">
            <a href="/">Главная</a> / <span><?=$term->name;?></span>
        </div>

        <div class="sect__header d-flex">
            <h2 class="sect__title flex-grow-1">Все фильтмы и сериалы в жанре "<?=$term->name;?>"</h2>

        </div>
        <div class="sect__content">

            <div class="sect__content d-grid">

                <?php



                $args = array(
                    'post_type'      => 'movie',
                    'order'             => 'DESC',
                    'orderby'           => 'date',
                    'post_status'    => 'publish',
                    'posts_per_page' => 20,
                    'movie_cat' => $term->slug,
                    'paged'          => get_query_var( 'page' ),
                );

                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $release_year    = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_release_year',true));


                        $terms = get_the_terms(get_the_ID() , 'movie_cat', 'themeum-core');
                        // $term_ids = wp_list_pluck($terms,'term_id');
                        /* print_r('<pre>');
                         print_r($terms[0]->name);
                         print_r('</pre>');*/
                        ?>

                        <a class="poster grid-item d-flex fd-column has-overlay" href="<?=get_permalink()?>">
                            <div class="poster__img img-responsive img-responsive--portrait img-fit-cover">
                                <?

                                if ( has_post_thumbnail() ) { ?>

                                    <img data-src="<?=the_post_thumbnail_url()?>" src="<?=the_post_thumbnail_url()?>" alt="<?=the_title();?>">
                                <? }  ?>

                                <?/* <div class="poster__label">ITunes</div>*/?>
                                <div class="poster__rating rating-<?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?>">  <?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?></div>
                                <div class="has-overlay__mask btn-icon anim"><span class="fal fa-play"></span></div>
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
                        <?
                    }
                } else {
                    echo 'Ничего не найдено';
                }

                wp_reset_postdata();
                ?>








            </div>

            <div class="pagination ignore-select" id="pagination">
                <?
                echo paginate_links( [
                    'base'    => "?page=%#%",
                    'current' => max( 1, get_query_var( 'page' ) ),
                    'total'   => $query->max_num_pages,
                ] );
                ?>

            </div>



        </div>
    </section>
<?php
get_footer();