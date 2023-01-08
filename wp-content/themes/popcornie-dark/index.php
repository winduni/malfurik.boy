<?php get_header(); ?>

    <section class="sect">
        <div class="sect__header d-flex">
            <h2 class="sect__title flex-grow-1">Все фильмы и сериалы</h2>


            <?/* <div class="sect__btn-filter" data-text="Фильтр" >подобрать с фильтром</div>  */?>
        </div>
        <div class="sect__content">

                <div class="sect__content d-grid">

                    <?php
                    //   Жанр  'movie_cat' => value
                    //   Год    movie_release_year
                    //
                    $args = array(
                        'post_type'      => 'movie',
                        'order'             => 'DESC',
                        'orderby'           => 'date',
                        'post_status'    => 'publish',

                        /*'meta_query' => array(
                            array(
                                'key' => 'themeum_movie_release_year',
                                'value' => '2021',
                            ),
                        ),*/
                        'posts_per_page' => 20,
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


                            $movie_trailer_info   	= get_post_meta(get_the_ID(),'themeum_movie_trailer_info',true);
                            $poster = wp_get_attachment_image_src($movie_trailer_info[0]['themeum_video_trailer_image'][0], 'moview-large');
                    ?>

                            <a class="poster grid-item d-flex fd-column has-overlay" href="<?=get_permalink()?>">
                                <div class="poster__img img-responsive img-responsive--portrait img-fit-cover">
                                    <?

                                    if ( has_post_thumbnail() ) { ?>

                                        <img  src="<?=the_post_thumbnail_url('medium')?>" alt="<?=the_title();?>">
                                   <? }
                                   else{ ?>
                                    <img  src="<?=$poster[0]?>" alt="<?=the_title();?>">
                                    <?   }

                                   ?>

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


    <div class="filter-block order-first d-none">
        <form data-dlefilter="dle-filter" class="filter-block__form" method="post">

                <div class="filter-block__cell-content">
                    <select name="PARAM">
                        <option value="VALUE">Выберите жанр</option>
                        <option value="VALUE">Два</option>
                        <option value="VALUE">Три</option>
                    </select>
                   <?/* <select name="PARAM">
                        <option value="VALUE">Страна выпуска</option>
                        <option value="VALUE">Два</option>
                        <option value="VALUE">Три</option>
                    </select>*/?>
                </div>

                <div class="filter-block__cell-content filter-block__cell-content--two-columns">
                    <input type="text" placeholder="Впишите год" name="year">
                </div>


            <div class="filter-block__cell filter-block__cell--padding">
                <div class="filter-block__cell-content filter-block__cell-content--two-columns">
                    <input type="submit" data-dlefilter="submit" value="Подобрать">
                    <input type="button" data-dlefilter="reset" value="Сбросить">
                </div>
            </div>
        </form>
    </div>
    <section class="desc order-last">
        <h1>Новинки, фильмы и сериалы онлайн в качественном дубляже</h1>
        <p>Malfurik предлагает зрителям погрузиться в мир дорам, аниме и мультсериалов. Мы постоянно обновляем новинки и стараемся делать качественный дубляж.</p>

        <p>  С нами можно:</p>
        <ul>
            <li>Обсудить дорамы и сериалы</li>
            <li>Собрать коллекцию любимых фильмов</li>
            <li>Отмечать дорамы, аниме и сериалы в желания</li>
        </ul>

        <p>На сайте Malfurik можно найти как новинки дорам «Внутренний дворец: Легенда о Жуи» или «Первая любовь» от Netflix, а также те мультсериалы, которые уже стали классикой: «Симпсоны» или «Гриффины» в профессиональной многоголосой озвучке.</p>
    </section>
<?php get_footer();