<?php get_header();
/*$args = array(
    'show_option_all'    => '',
    'show_option_none'   => __('No categories'),
    'orderby'            => 'name',
    'order'              => 'ASC',
    'style'              => 'list',
    'show_count'         => 0,
    'hide_empty'         => 1,
    'use_desc_for_title' => 0,
    'child_of'           => 0,
    'feed'               => '',
    'feed_type'          => '',
    'feed_image'         => '',
    'exclude'            => '',
    'exclude_tree'       => '',
    'include'            => '',
    'hierarchical'       => true,
    'title_li'           => __( 'Categories' ),
    'number'             => NULL,
    'echo'               => 1,
    'depth'              => 0,
    'current_category'   => 0,
    'pad_counts'         => 0,
    'taxonomy'           => 'movie_cat',
    'walker'             => 'Walker_Category',
    'hide_title_if_empty' => false,
    'separator'          => '<br />',
);

echo '<ul>';
wp_list_categories( $args );
echo '</ul>';*/
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
        </div>
    </div>
</section>
<?php get_footer(); ?>
