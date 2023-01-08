<?php get_header();
$post_id_banner_header = 4079;
$banner_header = get_post( $post_id_banner_header );
$banner_header->post_content;

?>
<section class="sect">
    <div class="breadcrumb">
        <a href="/">Главная</a> / <span><?= the_title(); ?></span>
    </div>
    <div class="sect__header d-flex">
        <h2 class="sect__title flex-grow-1"><?php the_title(); ?></h2>

    </div>
    <div class="sect__content">
        <div class="page__text full-text clearfix ">
            <?php the_content(); ?>
            <?php   comments_template();?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
