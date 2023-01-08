<aside class="col-side">

    <?/*  <div class="side-block js-this-in-mobile-menu">
        <div class="side-block__title">Что вас интересует?</div>
        <ul class="side-block__content side-block__menu">
            <li><a href="#">Фильмы</a><span>123</span></li>
            <li><a href="#">Сериалы</a><span>123</span></li>
            <li><a href="#">Мультфильмы</a><span>123</span></li>
            <li><a href="#">Коллекции</a><span>123</span></li>
        </ul>
    </div>*/?>

    <div class="soc-channels side-block">
        <a href="https://t.me/AnimauntDorama" target="_blank" class="soc-channels__item tlg">Мы в <div>Телеграм</div></a>
        <a href="https://vk.com/animaunt" target="_blank" class="soc-channels__item vk">Группа <div>ВКонтакте</div></a>
        <a href="https://www.youtube.com/@animauntst" target="_blank" class="soc-channels__item yt">Наш канал <div>Youtube</div></a>
    </div>


<?php

$categories = get_categories( [
    'taxonomy'     => 'movie_cat',
    'type'         => 'post',
  'parent'  => 0,
    'orderby'      => 'name',
    'order'        => 'ASC',
    'hide_empty'   => 1,
    'hierarchical' => 1,
    'exclude'      => '',
    'include'      => '',
    'number'       => 0,
    'pad_counts'   => false,
] );
if( $categories ){
foreach( $categories as $cat ){
    //echo $cat->name;  $cat->term_id?>

    <div class="side-block js-this-in-mobile-menu">
        <div class="side-block__title"><?=$cat->name?></div>
        <ul class="side-block__content side-block__menu" data-showitems="5">
            <?php
            $categories = get_categories( [
                'taxonomy'     => 'movie_cat',
                'type'         => 'post',
                'child_of'     => 0,
                'parent'       => $cat->term_id,
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 1,
                'hierarchical' => 1,
                'exclude'      => '',
                'include'      => '',
                'number'       => 0,
                'pad_counts'   => false,
            ] );

            if( $categories ){
                foreach( $categories as $cat ){
                    ?>

                    <li><a href="/movie_cat/<?=$cat->slug;?>/"><?=$cat->name;?></a></li>
                    <?
                }
            }
            ?>
        </ul>
    </div>

<?}
}
?>





    <?/*  <div class="side-block">
        <div class="side-block__title">Ожидаемые новинки</div>
        <div class="side-block__content">

            <a class="popular d-flex ai-center" href="#">
                <div class="popular__img img-fit-cover">
                    <img data-src="images/no-img.png" src="images/no-img.png" alt="#">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Артемикс файлс</div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Дорамы</li>
                    </ul>
                </div>
            </a>


        </div>
    </div>
 */ ?>
   <?/* <div class="side-block">
        <div class="side-block__title">Комментируют</div>
        <div class="side-block__content">
            <div class="lcomm">
                <div class="lcomm__meta d-flex ai-center">
                    <div class="lcomm__author flex-grow-1 ws-nowrap">{login}</div>
                    <div class="lcomm__date">{date=d.m.y}</div>
                </div>
                <div class="lcomm__text">{comment limit="80"}</div>
                <a class="lcomm__link ws-nowrap icon-at-left" href="{news-link}"><span class="fal fa-arrow-circle-right"></span>{news-title}</a>
            </div>
        </div>
    </div>*/?>



<?/*<a href="http://2021.exilelink.com/go/b5dd626c-f6e9-4b44-8370-c03eba640af0" target="_blank">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bare/Frame_240_400_2.png">
</a>*/
$post_id_banner_side = 4088;
$banner_side = get_post( $post_id_banner_side );
echo $banner_side->post_content;
?>



</aside>