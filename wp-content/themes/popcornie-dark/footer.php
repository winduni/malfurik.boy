
</main>

<!-- END COL MAIN -->

</div>

<!-- END CONTENT -->

<footer class="footer d-flex ai-center">
    <a href="/pravoobladateljam/" class="btn-accent centered-content">Правообладателям</a>
    <div class="logo footer__logo">
        <div class="logo__title">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo-s.png" width="111px">
    </div>

    </div>
    <div class="footer__text flex-grow-1">
        © <?= date ( 'Y' ) ; ?> "malfurik.ru" Лучший кинотеатр рунета онлайн.
        <br>Все права защищены.
    </div>
    <div class="footer__counter">
        <?/* <img data-src="images/counter.gif" src="images/no-img.png" alt="">*/?>
    </div>
</footer>

<!-- END FOOTER -->

</div>

<!-- END WRAPPER-MAIN -->



</div>

<!-- END WRAPPER -->
<div class="login login--not-logged d-none">
    <div class="login__header d-flex jc-space-between ai-center">
        <div class="login__title stretch-free-width ws-nowrap">Войти <a href="/reg/">Регистрация</a></div>
        <div class="login__close"><span class="fal fa-times"></span></div>
    </div>

        <div class="login__content">
            <?php  $args = array(
        'echo'           => true,
        'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
        'form_id'        => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => NULL,
        'value_remember' => false
    );
    wp_login_form( $args );?>
       </div>



</div>

<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/libs.js?ver=1.351"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/plyr.js"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/custom.js?ver=1.24"></script>

<?php wp_footer(); ?>

</body>
</html>
