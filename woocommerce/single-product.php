<?php

/*
* Template Name: Produkt
*/


// Tworzenie zapytania
$args = array(
    'posts_per_page' => 8,
    'post_type'      => 'produkty',
    'category_name'  => $wp_query->query_vars['category_name'],
);

// Pobieranie postów na podstawie argumentów
$query = new WP_Query($args);

// Get the product ID from the URL or any other method
$product_id = get_queried_object_id();

// Get the product object
$product = wc_get_product( $product_id );

// Get the product title
$product_title = $product->get_title();

// Get the product description
$product_description = $product->get_description();

// Get the product price
$product_price = $product->get_price();

// Get the product short description
$product_short_description = $product->get_short_description();

// Get the product SKU
$product_sku = $product->get_sku();

// Get the product categories
$product_categories = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'names' ) );

// Get the product tags
$product_tags = wp_get_post_terms( $product_id, 'product_tag', array( 'fields' => 'names' ) );

$regular_price = $product -> regular_price;

// echo 'Product Description: ' .$product. '<br>';

get_header();?>


<main>
    <div class="container-fluid">
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<div id="breadcrumbs" class="container my-4">','</div>' );
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <img src="<?= THEME_IMAGES_URI ?>/crocss.png" alt="crocss" />
                </div>
                <div class="col-5">
                    <div class="mt-1 text-end">
                        <a alt="Dodaj do schowka" href="#" class="">
                            <i class="fa-regular fa-heart" style="color: #005c97;"></i>
                        </a>
                    </div>
                    <h4><?php echo $product_title; ?></h4>
                    <div class="product__price product__price-detailed">
                        <p class="product__price--past mb-0">
                            <small>
                                <span><?php echo number_format(floatval($regular_price), 2, '.', ''); ?>zł</span>
                            </small>
                        </p>
                        <p class="product__price--current mb-0">
                            <span><?php echo number_format($product_price, 2, '.', ''); ?>zł</span>
                        </p>
                    </div>
                    <div class="pb-3">
                        <span class="text-muted">Najniższa cena w ciągu ostatnich 30 dni: <?php echo $regular_price; ?> zł</span>
                    </div>
                    <div class="product__color d-flex gap-2 mb-3">
                        <a title="Szary" class="product__color-item" aria-label="Wariant koloru: " href="/p/spodnie-meskie-gladkie-kolor-szary-1022909">
                            <div style="background: burlywood"></div>
                        </a>
                        <a title="Szary" class="product__color-item" aria-label="Wariant koloru: " href="/p/spodnie-meskie-gladkie-kolor-szary-1022909">
                            <div style="background: gray"></div>
                        </a>
                        <a title="Szary" class="product__color-item" aria-label="Wariant koloru: " href="/p/spodnie-meskie-gladkie-kolor-szary-1022909">
                            <div style="background: palevioletred"></div>
                        </a>
                        <a title="Szary" class="product__color-item" aria-label="Wariant koloru: " href="/p/spodnie-meskie-gladkie-kolor-szary-1022909">
                            <div class="active" style="background: lightblue"></div>
                        </a>
                    </div>
                    <div class="product-size mb-3">
                        <div class="product-size__table d-flex justify-content-end mb-2">
                            <a class="text-decoration-none">Tabela rozmiarów</a>
                        </div>
                        <select name="" id="" class="select--v1">
                            <option value="">XS</option>
                            <option value="">S</option>
                            <option value="">M</option>
                            <option value="">L</option>
                            <option value="">XL</option>
                        </select>
                    </div>
                    <div class="d-flex">
                        <button class="btn--v1 w-100">
                            <i class="fa-solid fa-basket-shopping me-1"></i>
                            Dodaj do koszyka
                        </button>
                    </div>
                    <div class="product__details row my-4">
                        <div class="col-6">
                            <a type="button" class="d-flex gap-3" data-target="#product-description">
                                <span>
                                    <i class="fa-solid fa-shirt" style="color: #005c97;"></i>
                                </span>
                                <p>Szczegóły produktu</p>
                            </a>
                        </div>
                        <div class="col-6">
                            <a type="button" class="d-flex gap-3" data-target="#product-option">
                                <span>
                                    <i class="fa-regular fa-star" style="color: #005c97;"></i>
                                </span>
                                <div>
                                    <p>Opinie</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a type="button" class="d-flex gap-3" data-target="#product-shipment">
                                <span>
                                    <i class="fa-solid fa-truck-fast" style="color: #005c97;"></i>
                                </span>
                                <div>
                                    <p>Wysyłka w 24h</p>
                                    <small>
                                        <p>Informacje o dostawie</p>
                                    </small>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a type="button" class="d-flex gap-3" data-target="#product-return">
                                <span>
                                    <i class="fa-solid fa-reply" style="color: #005c97;"></i>
                                </span>
                                <div>
                                    <p>30 dni na zwrot</p>
                                    <small>
                                        <p>Informacje o zwrotach</p>
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <ul class="btn-group--v1 justify-content-start px-0" id="product-accordion">
                        <li class="btn--v2 active" data-target="#product-description">Opis</li>
                        <li class="btn--v2" data-target="#product-shipment">Wysyłka</li>
                        <li class="btn--v2" data-target="#product-return">Zwrot</li>
                        <li class="btn--v2" data-target="#product-option">Opinie</li>
                    </ul>
                    <div>
                        <div class="product-accordion active" id="product-description">
                            <div>
                                <p><strong>Okulary przeciwsłoneczne marki Smokestory.<br></strong></p>
                                <p>ZDOBIENIA: nadruk<br>FILTR: uv400, bez polaryzacji</p>
                                <p><strong>DODATKOWE INFORMACJE:</strong></p>
                                <ul>
                                    <li>lekko przyciemniane szkła</li>
                                    <li>logotyp nadrukowany po bokach</li>
                                    <li>niezbędny gadżet do chillowania w słoneczne dni</li>
                                </ul>
                            </div>
                            <ul class="list-unstyled">
                                <li>Kolor:<strong><a href="/ona/akcesoria/okulary?filters=112[419]">Camo</a></strong></li>
                                <li>Płeć:<strong><a href="/ona/akcesoria/okulary?filters=114[663]">Uni</a></strong></li>
                                <li>Kategorie:<strong><a href="/ona/akcesoria/okulary?filters=117[930]">Okulary</a></strong></li>
                            </ul>
                        </div>
                        <div class="product-accordion" id="product-shipment">
                            <p><strong>PŁATNOŚĆ:</strong><br></p>
                            <ul>
                                <li><strong>płatność on-line&nbsp;</strong>BlueMedia, PayPal</li>
                                <li><strong>płatność gotówką przy odbiorze</strong>(DPD)</li>
                                <li><strong>przelew tradycyjny</strong><br><br>59 1140 2004 0000 3102 5387 2017<br>New Media Sławomir Krawczyk sp. k.<br>Żmigrodzka 249 B<br>51-129 Wrocław<br>TYTUŁ PRZELEWU: <strong>SKLEP [wpisz swój numer zamówienia]</strong></li>
                            </ul>
                            <p><b>DOSTAWA:</b><br></p>
                            <ul>
                                <li><span><b>paczkomaty InPost: </b>10 zł (1-2 dni)</span></li>
                                <li><span><b>kurier DPD przedpłata: </b>10 zł (1-2 dni)</span></li>
                                <li><span><b>kurier DPD pobranie: </b>15 zł (1-2 dni)</span></li>
                            </ul>
                            <p>Zakupiony towar wysyłany jest w ciągu <b>48h kurierem DPD lub Paczkomaty InPost. </b>Do ceny zamówienia w sklepie należy doliczyć koszty wysyłki. Wszystkie <b>zamówienia krajowe powyżej 100 zł objęte są DARMOWĄ DOSTAWĄ</b>, niezależnie od sposobu płatności czy wybranego kuriera.</p>
                        </div>
                        <div class="product-accordion" id="product-return">
                            <p>Jeśli zakupiony produkt nie spełnia Twoich oczekiwań możesz go zwrócić w ciągu 30 dni. Pieniądze zwracamy przelewem na konto w możliwie najszybszym czasie, ale nie później niż do 14 dni kalendarzowych od daty otrzymania przesyłki zwrotnej.</p>
                            <p><b>Zwrot złożysz za pomocą:</b><br></p>
                            <ul>
                                <li><span>dostępnego FORMULARZA ON-LINE&nbsp;&nbsp; <a href="https://www.urbancity.pl/obsluga-posprzedazowa" class="btn btn-primary">na stronie</a></span></li>
                                <li><span>z poziomu Moje Konto → Szczegóły Zamówienia → klikając przycisk 'UTWÓRZ ZGŁOSZENIE' (dotyczy Klientów zarejestrowanych)</span></li>
                            </ul>
                            <p></p><p></p><p></p><b>W obu przypadkach przygotuj sobie:</b><br>
                            <ul>
                                <li><span>NUMER ZAMÓWIENIA</span></li>
                                <li><span>dane teleadresowe</span></li>
                                <li><span>NUMER KONTA</span></li>
                            </ul>
                            <p></p>Pamiętaj o <b>ZATWIERDZENIU</b> i <b>ZAPISANIU ZWROTU</b>, aby operacja była wykonana oraz o <b>POBRANIU FORMULARZA</b> i <b>ZAŁĄCZENIU</b> go do przesyłki. Natomiast paczkę odeślij na dane: <br><br><p><b>New Media Sławomir Krawczyk sp. k.<br>ul. Żmigrodzka 249B<br>51-129 Wrocław</b></p><p>Zadbaj o swoją przesyłkę! Zalecamy korzystanie z usług firm kurierskich lub nadawanie paczek z potwierdzeniem nadania w trosce o bezpieczeństwo paczki.<br><strong>Uwaga!&nbsp;</strong>Nie przyjmujemy paczek wysłanych do nas za pobraniem, odesłanych do paczkomatów oraz produktów dostarczonych osobiście.</p><p></p><p></p><p></p><p></p>
                        </div>
                        <div class="product-accordion" id="product-option">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="newsletter">
            <div class="container">
                <div class="row mx-0">
                <div class="col-12">
                    <h3 class="newsletter__title">
                    Zapisz się do newslettera Mush
                    </h3>
                    <div class="newsletter__subtitle">
                    Otrzymaj zniżkę 10% na pierwsze zamówienie za min. 200 zł.
                    </br> Nie przegap informacji o rabatach, wyprzedażach i
                    najnowszych trendach.
                    </div>
                </div>
                </div>
                <div class="row mx-0">
                <form class="d-flex justify-content-center">
                    <input
                        class="newsletter__input"
                        type="email"
                        placeholder="Wprowadź adres e-mail"
                    />
                    <button class="btn--v1 ms-3" type="submit">
                        <i class="fa-regular fa-envelope"></i>
                        <span>
                            Zapisz się
                        </span>
                    </button>
                </form>
                </div>
                <div class="row mx-0">
                <div class="d-flex justify-content-center">
                    <small class="newsletter__small">
                    Administratorem podanych danych osobowych jest
                    <strong>Mush</strong> z siedzibą w
                    <strong>Miasto, ul. Hallera 18, 31-564 Miasto</strong>. Możesz w
                    każdym czasie wycofać tę zgodę. Pamiętaj, że przetwarzanie przez
                    nas Twoich danych do czasu cofnięcia zgody jest zgodne z prawem.
                    Szczegóły w
                    <a class="newsletter__link" href="/">
                        polityce prywatności
                    </a>
                    </small>
                </div>
                </div>
            </div>
        </section>
        <section class="productList">
            <div class="container">
                <div class="row">
                    <ul class="btn-group--v1">
                        <li class="btn--v2 active">Polecane</li>
                        <li class="btn--v2">Nowości</li>
                        <li class="btn--v2">Wyprzedaż</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="product col-3">
                        <div class="position-relative">
                            <a href="/">
                                <ul class="product__badges">
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--new">
                                                Nowość
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--discount">
                                                Okazja
                                            </span>
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
                    <div class="product col-3">
                        <div class="position-relative">
                            <a href="">
                                <ul class="product__badges">
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--new">
                                                Nowość
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--discount">
                                                Okazja
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div>
                                    <img draggable="false" alt="CLASSIC - Drewniaki i Chodaki - white/grey" src="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300" srcset="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300 300w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=400 400w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=500 500w" sizes="(max-width: 767px) calc(50vw - 36px), (min-width: 768px) and (max-width: 1280px) calc(25vw - 64px), 284px" loading="lazy" width="100%" height="433">
                                </div>
                            </a>
                            <div class="product__btn--fav">
                                <button>
                                    <i class="fa-solid fa-heart" style="color: #005c97;"></i>
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
                    <div class="product col-3">
                        <div class="position-relative">
                            <a href="">
                                <ul class="product__badges">
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--new">
                                                Nowość
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--discount">
                                                Okazja
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div>
                                    <img draggable="false" alt="CLASSIC - Drewniaki i Chodaki - white/grey" src="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300" srcset="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300 300w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=400 400w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=500 500w" sizes="(max-width: 767px) calc(50vw - 36px), (min-width: 768px) and (max-width: 1280px) calc(25vw - 64px), 284px" loading="lazy" width="100%" height="433">
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
                    <div class="product col-3">
                        <div class="position-relative">
                            <a href="">
                                <ul class="product__badges">
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--new">
                                                Nowość
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-decoration-none">
                                            <span class="product__badge product__badge--discount">
                                                Okazja
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div>
                                    <img draggable="false" alt="CLASSIC - Drewniaki i Chodaki - white/grey" src="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300" srcset="https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=300 300w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=400 400w, https://img01.ztat.net/article/spp-media-p1/6356d0bb2b79351fbda440895eba514a/a4b21e7ed7d04049981f2655df2bb4a1.jpg?imwidth=500 500w" sizes="(max-width: 767px) calc(50vw - 36px), (min-width: 768px) and (max-width: 1280px) calc(25vw - 64px), 284px" loading="lazy" width="100%" height="433">
                                </div>
                            </a>
                            <div class="product__btn--fav">
                                <button>
                                    <i class="fa-solid fa-heart" style="color: #005c97;"></i>
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
                </div>
                <div class="row my-4">
                    <div class="d-flex justify-content-center">
                        <button class="btn--v1" type="submit">
                        <span>
                            Zobacz więcej
                        </span>
                    </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
