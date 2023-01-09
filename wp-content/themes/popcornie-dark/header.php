<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(62726638, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/62726638" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=wp_get_document_title()  ?></title>

    <?php wp_head(); ?>

    <meta name="theme-color" content="#303d4a">

    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/webfonts/manrope-400.woff2">
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/webfonts/manrope-500.woff2">
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/webfonts/fredoka-one-400.woff2">
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/webfonts/fa-light-300.woff2">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/images/favicon.svg" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/common.css?ver=1" type="text/css" rel="stylesheet" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/styles.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/engine.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/fontawesome.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css-custom/plyr.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo esc_url(get_template_directory_uri()); ?>/css-custom/sda.css?ver=1.21" type="text/css" rel="stylesheet" />
</head>

<body id="pmovie">
<?php
global $current_user;
get_currentuserinfo();
?>
<div class="wrapper">


    <div class="wrapper-container wrapper-main d-flex fd-column" <?/*if($current_user->user_login == "Mitsuki"){?> style="max-width: 84%;" <?}*/?>>

        <header class="header d-flex ai-center vw100">
            <div class="header__search d-none">
            <?/*    <form id="quicksearch" method="post">
                    <input type="hidden" name="do" value="search">
                    <input type="hidden" name="subaction" value="search">
                    <div class="header__search-box">
                        <input id="story" name="story" placeholder="Поиск по сайту..." type="text" autocomplete="off">
                        <button type="submit" class="search-btn"><span class="fal fa-search"></span></button>
                    </div>
                </form>*/?>

                <form action="/" method="get" autocomplete="off">
                    <input type="text" name="s" placeholder="Поиск..." id="keyword" class="input_search" onkeyup="fetch()">

                </form>

                <div class="search_result" id="datafetch">

                </div>

            </div>

            <a href="/" class="logo header__logo">

                <div class="logo__title">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-s.png" width="111px"></div>
                <p class="logo__caption"><?/*Аниме портал*/?>&nbsp;</p>
            </a>
            <ul class="header__menu d-flex flex-grow-1 js-this-in-mobile-menu">
                <li><a href="/"><span class="fal fa-home"></span>Главная</a></li>
                <li><a href="/movie_cat/anime/"><span class="fal fa-fire-alt"></span>Аниме</a></li>
                <li><a href="/movie_cat/dorama/"><span class="fal fa-play"></span>Дорамы</a></li>
                <li><a href="/movie_cat/film/">Фильмы</a></li>
                <li><a href="/movie_cat/serial/">Сериалы</a></li>
                <li><a href="/movie_cat/multfilmy/">Мультики</a></li>

            </ul>
            <div class="header__btn-search btn-icon js-toggle-search"><span class="fal fa-search"></span></div>

            <?php if ( is_user_logged_in() ) { ?>

                <?php
                $current_user = wp_get_current_user();
                echo get_avatar( $current_user->user_email, 32 );

                if( $current_user->display_name != '' ){
                    if( get_option('review_page_id') != '' ){
                       // echo '<a class="review-page hidden-xs" href="'.get_permalink( get_option('review_page_id') ).'">';
                    }
                    _e('Hi','moview');
                    echo ','. esc_attr($current_user->display_name);
                    if( get_option('review_page_id') != '' ){ echo '</a>';  }
                }else{
                    if( get_option('review_page_id') != '' ){
                       // echo '<a class="review-page hidden-xs" href="'.get_permalink( get_option('review_page_id') ).'">';
                    }
                    _e('Hi','moview');
                    echo ','. esc_attr( $current_user->user_login );
                    if( get_option('review_page_id') != '' ){ /*echo '</a>'; */ }
                }
                ?>

              <a style="margin-left:15px;" href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>">Выйти</a>
            <?php } else { ?>
                <div class="btn-accent centered-content js-show-login">Войти</div>
            <?php } ?>

            <div class="header__btn-menu d-none js-show-mobile-menu"><span class="fal fa-bars"></span></div>


        </header>

        <!-- END HEADER -->

        <div class="content flex-grow-1 cols d-flex banner-header">
            <div class="carou carou_first">
                <?/* <a href="http://2021.exilelink.com/go/b5dd626c-f6e9-4b44-8370-c03eba640af0" target="_blank">
                 <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bare/Frame-8_04.gif" style="margin-bottom: -4px;">
             </a>  */

                $post_id_banner_header = 4079;
                $banner_header = get_post( $post_id_banner_header );
                echo $banner_header->post_content;

                ?>


            </div>
            <?php
            if( is_front_page() ) {
                ?>

                <div class="carou">
                    <div class="carou__content" id="owl-carou">
                        <?php
                        $args = array(
                            'post_type' => 'movie',
                            'order' => 'DESC',
                            'orderby' => 'date',
                            //'post_status'    => 'publish',
                            // 'posts_per_page' => - 1,
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();

                                $movie_trailer_info   	= get_post_meta(get_the_ID(),'themeum_movie_trailer_info',true);
                                $poster = wp_get_attachment_image_src($movie_trailer_info[0]['themeum_video_trailer_image'][0], 'moview-large');
                                ?>

                                <a class="top d-flex fd-column has-overlay" href="<?= get_permalink() ?>">
                                    <div class="top__img img-fit-cover img-responsive img-responsive--portrait img-mask">
                                        <?

                                        if ( has_post_thumbnail() ) { ?>

                                            <img  src="<?=the_post_thumbnail_url('medium')?>" alt="<?=the_title();?>">
                                        <? }
                                        else{ ?>
                                            <img  src="<?=$poster[0]?>" alt="<?=the_title();?>">
                                        <?   }

                                        ?>
                                        <div class="poster__rating rating-<?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?>"> <?php  if (function_exists('themeum_wp_rating')) { echo themeum_wp_rating(get_the_ID(),'single'); } ?></div>
                                        <div class="has-overlay__mask btn-icon anim"><span class="fal fa-play"></span>
                                        </div>
                                        <div class="top__desc">
                                            <div class="top__title line-clamp"><?= the_title(); ?></div>
                                        </div>
                                    </div>
                                </a>

                                <?
                            }
                        }

                        wp_reset_postdata();
                        ?>


                    </div>

                    <div class="carou__desc d-flex fd-column jc-center">
                        <div class="carou__title">Новинки недели</div>

                    </div>
                </div>
                <?php
            }?>
            <?php


           // if($current_user->user_login != "Mitsuki"){
                get_sidebar();
          //  }?>


            <!-- END COL SIDE -->

            <main class="col-main flex-grow-1 d-flex fd-column grid-2" id="grid">
             <? $post_id_banner_pixel = 4090;
$banner_pixel = get_post( $post_id_banner_pixel );
echo $banner_pixel->post_content;
?>