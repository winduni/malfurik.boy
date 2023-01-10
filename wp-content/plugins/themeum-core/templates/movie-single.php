<?php
/**
 * Display Single Movie 
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Moview
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
?>
<?php
while ( have_posts() ) : the_post();

    $image_cover = get_post_meta($post->ID,'themeum_movie_image_cover', true);
    $cover = '';
    if ( $image_cover ) {
        $cover_img   = wp_get_attachment_image_src($image_cover, 'full');
        $cover = 'style="background-image:url('.esc_url($cover_img[0]).');background-repeat:no-repeat;background-size: cover;background-position: 50% 50%;"';
    } else {
        $cover = 'style="background-color: #333;"';
    }
    $release_date    = esc_attr(get_post_meta(get_the_ID(),'themeum_release_date',true));

    $release_year    = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_release_year',true));
    $movie_type   	 = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_type',true));
    $movie_length    = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_length',true));

    $movie_director  = get_post_meta(get_the_ID(),'themeum_movie_director');
    $movie_actor   	 = get_post_meta(get_the_ID(),'themeum_movie_actor');
    $movie_info   	 = get_post_meta(get_the_ID(),'themeum_movie_info',true);




    $facebook_url   	= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_facebook_url',true));
    $twitter_url   		= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_twitter_url',true));
    $google_plus_url   	= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_google_plus_url',true));
    $youtube_url   		= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_youtube_url',true));
    $movie_vimeo_url   	= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_vimeo_url',true));
    $instagram_url   	= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_instagram_url',true));
    $website_url   		= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_website_url',true));

    $movie_trailer_info   	= get_post_meta(get_the_ID(),'themeum_movie_trailer_info',true);
    $movie_showtimes_info   = get_post_meta(get_the_ID(),'themeum_showtimes_info',true);

    $theatre_name   	= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_theatre_name',true));
    $theatre_location   = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_theatre_location',true));
    $show_time   		= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_show_time',true));
    $ticket_url   		= esc_attr(get_post_meta(get_the_ID(),'themeum_movie_ticket_url',true));

    $trailer_image   = wp_get_attachment_image_src($movie_trailer_info[0]["themeum_video_trailer_image"], 'moview-medium');

    $poster = wp_get_attachment_image_src($movie_trailer_info[0]['themeum_video_trailer_image'][0], 'moview-large');

    if ($movie_trailer_info[0]['themeum_video_trailer_image'][0] == 1493){
        $poster = wp_get_attachment_image_src($movie_trailer_info[14]['themeum_video_trailer_image'][0], 'moview-medium');
    }
   // print_r($movie_trailer_info[0]['themeum_video_link']);

    $terms = get_the_terms(get_the_ID() , 'movie_cat', 'themeum-core');
//    print_r('<pre>');
//    print_r(wp_get_attachment_image_src($movie_trailer_info[0]['themeum_video_trailer_image'][0], 'moview-large'));

  //

//    print_r('<pre>');
//    print_r($movie_trailer_info);
//    print_r('</pre>');
    ?>
    <article class="page ignore-select pmovie">
        <div class="breadcrumb">
            <a href="/">Главная</a> / <a href="/movie_cat/<?=$terms[0]->slug?>/"><?=$terms[0]->name?></a> / <span><?=the_title();?></span>
        </div>


        <div class="page__subcols d-flex">

            <div class="page__subcol-side">
                <div class="pmovie__poster img-fit-cover">
                    <img data-src="<?=$poster[0]?>" src="<?=$poster[0]?>" alt="<?php the_title(); if ($release_year) { echo ' ('.$release_year.')'; } ?>">
                </div>
            </div>

            <!-- END PAGE SUBCOL SIDE -->

            <header class="page__subcol-main flex-grow-1 d-flex fd-column">
                <h1><?php the_title(); if ($release_year) { echo ' ('.$release_year.')'; } ?></h1>
                <?/* <div class="pmovie__original-title">original title</div>*/?>
                <?/*  <div class="pmovie__year">США, Россия, <?=$release_year?>, 123 мин</div>*/?>
                <div class="pmovie__genres"><b>Жанр:</b> <?
                    $key = 0;
                    foreach($terms as  $term){
                        $key++;
                        if($key > 1) echo ', ';
                        echo $term->name;
$arrSlug[] =  $term->slug;

                    }
                    ?></div>
                <?/*  <div class="pmovie__age order-first"><div>18+</div></div>*/?>
                <div class="pmovie__subinfo d-flex ai-center">
                    <div class="pmovie__subrating pmovie__subrating--kp">
                        <img data-src="<?php echo esc_url(get_template_directory_uri()); ?>/images/kp.svg"
                             src="<?php echo esc_url(get_template_directory_uri()); ?>/images/kp.svg" alt="">
                        <?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?>
                    </div>
          <div class="pmovie__btn btn icon-at-left flex-grow-1 js-scroll-to">смотреть онлайн</div>
                </div>
            </header>

            <!-- END PAGE SUBCOL MAIN -->

            <ul class="page__subcol-side2 pmovie__header-list">
                <?/*   <li>
                    <div>Режиссер:</div>
                    Дени Вильнев
                </li>
                <li>
                    <div>Доп поле:</div>
                    Сюда вставляем само поле xfvalue...
                </li>
                <li>
                    <div>Доп поле:</div>
                    Сюда вставляем само поле xfvalue...
                </li>*/


                ?>
            </ul>

        </div>

        <!-- END PAGE SUBCOLS -->

        <div class="pmovie__caption">
            Смотрите  <b>новый сезон «<?php the_title();?>»</b> совершенно бесплатно на нашем сайте Malfurik.ru в профессиональной озвучке!
            Делитесь мнением в комментариях, мы рады каждому отзыву!
        </div>

       <div class="page__cols d-flex">
            <div class="page__col-main flex-grow-1 d-flex fd-column">
                <h2 class="page__subtitle">Сюжет фильма</h2>
                <div class="page__text full-text clearfix js-hide-text" data-rows="9"><?php the_content();?></div>
             <div class="page__tags d-flex"><span class="fal fa-tags"></span> </div>
                <div class="flex-grow-1"></div>
                <h2 class="page__subtitle">Смотреть онлайн "<?php the_title();?>" бесплатно</h2>
            </div>
        </div>

        <!-- END PAGE COLS -->

        <div class="pmovie__player tabs-block">
            <div class="pmovie__player-controls d-flex ai-center">
                <div class="tabs-block__select d-flex flex-grow-1">
                    <span>Смотреть онлайн</span>
                   <?/* <span>Другой плеер</span>*/?>
                </div>

            </div>

            <video id="player" playsinline controls>
                <? /* foreach( $movie_trailer_info as $number => $value ):
                    if ($number > 0) break;
                    $name = str_replace('https://video.malfurik.ru/mp4/','',$value["themeum_video_link"]);
                    $secret = 'lfqvekmnbr';
                    $time = time() + 18000; //ссылка будет рабочей три часа
                    $link = base64_encode(md5($secret.'/real_mp4/'.$name.$time, TRUE));
                    $key = str_replace("=", "", strtr($link, "+/", "-_"));
                    $videolink = "https://video.malfurik.ru/mp4/$key/$time/$name";?>

                    <source id="film_main" src="<?=$videolink?>"  type="video/mp4">
                <?php

                endforeach;*/
                ?>

            </video>

<?/*  <div class="tabs-block__content d-none video-inside video-responsive">
                <iframe data-src="" frameborder="0" allowfullscreen></iframe>
            </div>

            <video id="player" playsinline controls>
                    <source src="https://video.malfurik.ru/mp4/vrvq8gUcU_82DY1N4Xta_Q/1670247106/%5BAnimaunt%5D%20Брамс/1.mp4"
  type="video/mp4" />

                </video>

*/?>


            <div class="pmovie__player-bottom d-flex ai-center">

                <div class="pmovie__share flex-grow-1">
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,viber,whatsapp,telegram" data-counter="ig"></div>
                </div>
                <?  /* <div class="pmovie__fav icon-at-left"><a href="#" class="js-show-login"><span class="fal fa-bookmark"></span>В избранное</a></div>  */ ?>



                <div class="pmovie__series-select d-flex ai-center">
                    <div class="pmovie__series-select-caption">Выбор серии</div>
                    <select name="pmovie__select-items" class="flex-grow-1" id="pmovie__select-items" <?/*onchange="javascript:urla=this.value;document.getElementById('film_main').src=urla;"*/?>>

                      <?
                      foreach( $movie_trailer_info as $number => $value ):
                        $name = str_replace('https://video.malfurik.ru/mp4/','',$value["themeum_video_link"]);
                        $secret = 'lfqvekmnbr';
                        $time = time() + 18000; //ссылка будет рабочей три часа
                        $link = base64_encode(md5($secret.'/real_mp4/'.$name.$time, TRUE));
                        $key = str_replace("=", "", strtr($link, "+/", "-_"));
                        $videolink = "https://video.malfurik.ru/mp4/$key/$time/$name";?>

                        <option value="<?=$videolink?>" data-src="<?=$videolink?>"  data-number="<?=$number?>"><?=$value['themeum_video_info_title']?> </option>
        <?php
        endforeach;
        ?>
                    </select>
                </div> 
            </div>


            <?php if( current_user_can('editor') || current_user_can('administrator') || current_user_can('role_see')) {  ?>
            <div class="d-flex ai-center timecode_parent">
                <div>  Таймкоды рекламы:&nbsp;</div>
                <?php
                foreach ($movie_trailer_info as $key => $movie_trailer_info):?>
                    <div class="timecode_series <? if($key == 0): ?>show <? endif;?>" data-number="<?=$key?>">
                        <?
                        if($movie_trailer_info['themeum_timecodes']):
                            foreach ($movie_trailer_info['themeum_timecodes'] as $timecode):
                                $str_time = $timecode;
                                $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
                                sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                                $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                                ?>
                                <div class="timecode" data-timecode="<?= $time_seconds ?>"><?= $timecode ?></div>


                            <?php
                            endforeach;
                        else:?>
                            <a href="/wp-admin/post.php?post=<?=get_the_ID()?>&action=edit" style="color: var(--accent);">Не заполнено</a>
                        <?  endif;?>
                    </div>
                <?  endforeach;
                ?>
            </div>
            <?php } ?>



        </div>
        <?php
     //   comments_open(get_the_ID()) = true;
       // echo get_comments_number();
        // If comments are open or we have at least one comment, load up the comment template.
        //if ( comments_open() || get_comments_number() ) {

           // comments_template();
       // }

       // print_r(comments_open());


        ?>
        <?php comments_template() ?>
        <section class="sect pmovie__related">
            <h2 class="sect__title sect__header">Смотрите также:</h2>
            <div class="sect__content d-grid">
                <?php

                $args = array(
                    'post_type'      => 'movie',
                    'order'             => 'RAND',
                    'orderby'           => 'date',
                    'post_status'    => 'publish',
                    'posts_per_page' => 5,
                    'movie_cat' => $arrSlug,
                    'post__not_in'           => [get_the_ID()],
                    'paged'          => get_query_var( 'page' ),
                );

                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $release_year    = esc_attr(get_post_meta(get_the_ID(),'themeum_movie_release_year',true));


                        $terms = get_the_terms(get_the_ID() , 'movie_cat', 'themeum-core');
                        ?>

                        <a class="poster grid-item d-flex fd-column has-overlay" href="<?=get_permalink()?>">
                            <div class="poster__img img-responsive img-responsive--portrait img-fit-cover">
                                <?

                                if ( has_post_thumbnail() ) { ?>

                                    <img  src="<?=the_post_thumbnail_url('medium')?>" alt="<?=the_title();?>">
                                <? }  ?>

                                <?/* <div class="poster__label">ITunes</div>*/?>
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
                        <?
                    }
                } else {
                    echo 'Ничего не найдено';
                }

                wp_reset_postdata();
                ?>


            </div>
        </section>




    </article>














<?php endwhile; ?>


<?php get_footer();