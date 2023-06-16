<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3154688168633900"
     crossorigin="anonymous"></script>
</head>
<body <?php body_class() ?> >
    <header>
        <div class="header__info-bar">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <?php
                     $args = array(
                        'post_type'      => 'shop_coupon',
                        'posts_per_page' => -1, // Display all coupons
                    );

                    $coupons = new WP_Query( $args );

                    if ( $coupons->have_posts() ) {
                        while ( $coupons->have_posts() ) {
                            $coupons->the_post();
                            $coupon_data = get_post();
                            $excerpt = $coupon_data->post_excerpt;
                                echo '<span>' . $excerpt . ' -20% na wybrane kategorie produktowe przy zakupach powyżej 100 PLN z kodem: ' . get_the_title() . '</span>';
                        }
                        wp_reset_postdata();
                    }?>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg sticky-top" id="navbar">
        <div class="px-5 w-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="d-flex align-items-center justify-content-between w-100">
                <ul class="navbar-nav navbar-center" id="navbar-navlist">
                    <li class="nav-item active">
                        <a data-scroll="" href="<?= HOME_URL.'/sklep/odziez'?>" class="nav-link active">Odzież</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll="" href="<?= HOME_URL.'/sklep/obuwie'?>" class="nav-link">Obuwie</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll="" href="<?= HOME_URL.'/sklep/akcesoria'?>" class="nav-link">Akcesoria</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll="" href="<?= HOME_URL.'/sklep/?status=nowosci'?>" class="nav-link">Nowości</a>
                    </li>
                    <li class="nav-item">
                        <a data-scroll="" href="<?= HOME_URL.'/sklep/?status=wyprzedaz'?>" class="nav-link">Wyprzedaż</a>
                    </li>
                </ul>
                <a class="navbar-brand text-uppercase" href="/">
                <img src="<?= THEME_IMAGES_URI ?>/Mush-logo.png" class="logo" alt="Mush logo"/>
                </a>
                <div class="nav-button">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <button type="button" class="btn navbar-btn btn-rounded " type="button"  data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="fa-solid fa-magnifying-glass" style="color: #005c97;"></i>
                            </button>
                        </li>
                        <li>
                            <a href="<?= HOME_URL.'/login'?>" type="button" class="btn navbar-btn btn-rounded waves-effect waves-light">
                                <i class="fa-regular fa-user" style="color: #005c97;"></i>
                            </a>
                        </li>
                        <li>
                            <button type="button" class="btn navbar-btn btn-rounded waves-effect waves-light">
                                <i class="fa-regular fa-heart" style="color: #005c97;"></i>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn navbar-btn btn-rounded waves-effect waves-light">
                                <i class="fa-solid fa-basket-shopping" style="color: #005c97;"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </nav>





<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="container">
            <div class="search-engine">
                <div for="" class="position-relative w-75 mx-auto">
                    <!-- <i class="fa-solid fa-magnifying-glass" style="color: #005c97;"></i>
                    <input type="text" class="input--v1" id="" placeholder="Szukaj"> -->
                    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                </div>
            </div>

        </div>
    </div>
  </div>
</div>