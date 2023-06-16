<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$term = get_queried_object();

if ($term) {
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 8,
		'tax_query' => array(
			array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $term->slug,
			),
		),
	);

	$products_query = new WP_Query($args);

	if ($products_query->have_posts()) {
		while ($products_query->have_posts()) {
			$products_query->the_post();
			?>
            <main>
                <div class="productList">
                    <div class="container">
                        <div class="row">
                            <div class="product col-12 col-md-6 col-xl-3 mb-5">
                                <div class="position-relative">
                                    <a href="/">
                                        <ul class="product__badges">
                                            <li>
                                                <a href="#" class="text-decoration-none">
                                                    <?php
                                                    if ($status === 'Nowości') {
                                                        echo '<span class="product__badge product__badge--new">Nowość</span>';
                                                    } elseif ($status === 'Wyprzedaż') {
                                                        echo '<span class="product__badge product__badge--discount">Okazja</span>';
                                                    }
                                                    ?>
                                                </a>
                                            </li>
                                        </ul>
                                        <div>
                                            <img draggable="false" alt="CLASSIC - Drewniaki i Chodaki - white/grey"
                                            src="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300"
                                            sizes="(max-width: 767px) calc(50vw - 36px), (min-width: 768px) and (max-width: 1280px) calc(25vw - 64px), 284px" loading="lazy" width="100%" height="433">
                                        </div>
                                    </a>
                                    <div class="product__btn--fav">
                                        <button>
                                            <i class="fa-regular fa-heart" style="color: #005c97;"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="" class="text-decoration-none d-block pt-2">
                                    <div>
                                        <h3 class="product__brand">Crocs</h3>
                                        <h3 class="product__title"><?php the_title(); ?> - white/grey</h3>
                                    </div>
                                    <div class="product__price">
                                        <p class="product__price--past">
                                            <span>200,00 zł</span>
                                        </p>
                                        <p class="product__price--current">
                                            <span>200,00 zł</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
		}
	} else {
		echo 'Brak produktów w tej kategorii.';
	}

	wp_reset_postdata();
} else {
	echo 'Nieznana kategoria.';
}
get_footer(); ?>
