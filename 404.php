<?php get_header();
?>
<div class="">
    <div class="container">
        <div class="row align-self-center" style="height: 50vh">
            <div class="col-md-6 align-self-center">
                <h1>404</h1>
            </div>
            <div class="col-md-6 align-self-center"  >
                <div class="row" >
                    <div class="col-md-12">
                        <h2><?php _e('404 Bad Gateway' ,'exchange') ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><?php _e('Click' ,'exchange') ?>j <a href="<?= get_home_url() ?>"><?php _e('here' ,'exchange') ?> </a> <?php _e('to come to home page' ,'exchange') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();