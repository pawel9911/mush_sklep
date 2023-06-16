<?php
    global $wp_query, $paged;
    $currentPage = 1;
    if (isset($_GET['strona'])) {
        $currentPage = esc_attr($_GET['strona']);
    }

    if (isset($_GET['status']) && $_GET['status'] === 'wyprzedaz') {
       $status_id = wc_attribute_taxonomy_id_by_name('status');
       $status_term = get_term_by('slug', 'wyprzedaz', 'pa_status');
       if ($status_id && $status_term) {
           $args['tax_query'][] = array(
               'taxonomy' => 'pa_status',
               'field'    => 'term_id',
               'terms'    => $status_term->term_id,
           );
           $wp_query = new WP_Query($args);
       } else {
           echo 'Brak atrybutu "status" o wartości "Wyprzedaż".';
           return;
       }
    }
    else if (isset($_GET['status']) && $_GET['status'] === 'nowosci') {
           $status_id = wc_attribute_taxonomy_id_by_name('status');
           $status_term = get_term_by('slug', 'nowosci', 'pa_status');
           if ($status_id && $status_term) {
               $args['tax_query'][] = array(
                   'taxonomy' => 'pa_status',
                   'field'    => 'term_id',
                   'terms'    => $status_term->term_id,
               );
               $wp_query = new WP_Query($args);
           } else {
               echo 'Brak atrybutu "status" o wartości "Nowości".';
               return;
           }
    }
    else{
       $args = array(
       'posts_per_page' => 8,
       'post_type'      => 'product',
       'paged'          => $currentPage,
       'category_name'  => $wp_query->query_vars['category_name'],
       );
       $wp_query = new WP_Query($args);
    }

    get_header();
?>

<main>
    <div class="productList">
        <div class="container">
             <div class="row">
                <?php
                while ($wp_query->have_posts()) : $wp_query->the_post();
                $product = wc_get_product(get_the_ID());
                $status = $product->get_attribute('status');
                ?>
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
                            <h3 class="product__title">CLASSIC - Drewniaki i Chodaki - white/grey</h3>
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
                <?php endwhile; ?>
            </div>
            <?php
                 if ($wp_query->max_num_pages > 1) :; ?>
                    <div class="row">
                        <div class="pagination">
                            <div class="container">
                                <?php $pagination = array(
                                    'end_size'  => 2,
                                    'format'    => '?strona=%#%',
                                    'mid_size'  => 2,
                                    'current'   => $currentPage,
                                    'total'     => $wp_query->max_num_pages,
                                    'prev_next' => true,
                                    'prev_text'    => '<i class="fa-solid fa-arrow-left" style="color: #212529;"></i>',
                                    'next_text'    => '<i class="fa-solid fa-arrow-right" style="color: #212529;"></i>',
                                    'type'      => 'list',
                                );
                                $listString = paginate_links($pagination);
                                $listString = str_replace("<ul class='page-numbers'>", '<ul class="pagination pagination-rounded">', $listString);
                                $listString = str_replace('page-numbers', 'page-link', $listString);
                                $listString = str_replace('<li>', '<li class="page-item">', $listString);
                                $listString = str_replace(
                                    '<li class="page-item"><span aria-current="page" class="page-link current">',
                                    '<li class="page-item active"><span aria-current="page" class="page-link bg-dark bg-gradient">',
                                    $listString);
                                    ?>
                                <div class="wp-pager d-flex justify-content-center my-4">
                                    <?= $listString; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;
                wp_reset_query(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
