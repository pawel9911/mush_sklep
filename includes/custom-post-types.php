 <?php
/**
 *  Register cutom post types
 */

if ( ! function_exists('register_produkty') ) {

// Register Custom Post Type
    function register_produkty() {

        $labels = array(
            'name'                  => _x( 'Posty', 'Post Type General Name', 'kpp' ),
            'singular_name'         => _x( 'Produkt', 'Post Type Singular Name', 'kpp' ),
            'menu_name'             => __( 'Posty', 'kpp' ),
            'name_admin_bar'        => __( 'Posty', 'kpp' ),
            'archives'              => __( 'Archiwum produktów', 'kpp' ),
            'attributes'            => __( 'Item Attributes', 'kpp' ),
            'parent_item_colon'     => __( 'Parent Item:', 'kpp' ),
            'all_items'             => __( 'Wszystkie produkty', 'kpp' ),
            'add_new_item'          => __( 'Dodaj nowy produkt', 'kpp' ),
            'add_new'               => __( 'Dodaj produkt', 'kpp' ),
            'new_item'              => __( 'Nowy produkt', 'kpp' ),
            'edit_item'             => __( 'Edytuj produkt', 'kpp' ),
            'update_item'           => __( 'Aktualizuj produkt', 'kpp' ),
            'view_item'             => __( 'Zobacz produkt', 'kpp' ),
            'view_items'            => __( 'Zobacz produkty', 'kpp' ),
            'search_items'          => __( 'Szukaj produktu', 'kpp' ),
            'not_found'             => __( 'Nie znaleziono produktu', 'kpp' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'kpp' ),
            'featured_image'        => __( 'Featured Image', 'kpp' ),
            'set_featured_image'    => __( 'Set featured image', 'kpp' ),
            'remove_featured_image' => __( 'Remove featured image', 'kpp' ),
            'use_featured_image'    => __( 'Use as featured image', 'kpp' ),
            'insert_into_item'      => __( 'Insert into item', 'kpp' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'kpp' ),
            'items_list'            => __( 'Items list', 'kpp' ),
            'items_list_navigation' => __( 'Items list navigation', 'kpp' ),
            'filter_items_list'     => __( 'Filter items list', 'kpp' ),


        );
        $args = array(
            'label'                 => __( 'Posty', 'kpp' ),
            'description'           => __( 'Posty', 'kpp' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'excerpt' ),
            'taxonomies'            => array( 'category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'menu_icon'           => 'dashicons-tag',
        );
        register_post_type( 'produkty', $args );
    }
    add_action( 'init', 'register_produkty', 0 );
}
