<?php

namespace oBabyShop\PostType;

class Product
{
    /**
     * Post type name
     */
    public const NAME = 'product';

    public const CAPABILITIES = [
        'read'                   => 'read',
        'edit_post'              => 'edit_product',
        'read_post'              => 'read_product',
        'delete_post'            => 'delete_product',
        'edit_posts'             => 'edit_products',
        'edit_others_posts'      => 'edit_others_products',
        'delete_posts'           => 'delete_products',
        'publish_posts'          => 'publish_products',
        'read_private_posts'     => 'read_private_products',
        'delete_private_posts'   => 'delete_private_products',
        'delete_published_posts' => 'delete_published_products',
        'delete_others_posts'    => 'delete_others_products',
        'edit_private_posts'     => 'edit_private_products',
        'edit_published_posts'   => 'edit_published_products',
        'create_posts'           => 'create_products'
    ];


    // function called from the instantiation of the custom post type for setting up the meta-boxes ("Prix" and "Disponibilité" and "Localité")
    public function __construct() {

        add_action('add_meta_boxes',[$this,'initialisation_metaboxes']);
        add_action('save_post',[$this, 'save_metaboxes']);
        add_filter('map_meta_cap', [$this, 'mapMetaCaps'], 10, 4);
        add_filter('excerpt_length', [$this, 'new_excerpt_length'], 999);
    }

    /**
     * Register this post type
     */
    public function register()
    {
        register_post_type(
            self::NAME,
            [
                'label'                 => __('Produits'),
                'public'                => true,
                'hierarchical'          => false,
                'show_in_rest'          => true,
                'rest_base'             => 'products',
                'supports'              => [
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'excerpt',
                    'custom-fields'
                ],
                'capabilities' => self::CAPABILITIES
            ]
        );

        add_theme_support('post-thumbnails', [self::NAME]);
    }

    // Modify the word count of excerpts
    function new_excerpt_length($length) {
        global $post;
        if ($post->post_type == 'post') {
            return 40;
        }
        else if ($post->post_type == self::NAME){
            return 20;
        }
        else {
            return 50;  
        }
    }
    
    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(self::NAME);
    }

    // Add meta-box in back-office
    public function initialisation_metaboxes() {

        add_meta_box('prix_produit', 'Prix', [$this,'metabox_function'], self::NAME, 'normal', 'default');
        add_meta_box('dispo_produit', 'Disponibilité du produit', [$this,'dispo_product_function'], self::NAME, 'normal', 'default');
        add_meta_box('localite_produit', 'Localité', [$this,'localite_product_function'], self::NAME, 'normal', 'default');
    }

    // meta-box "Prix" function
    public function metabox_function($post) {

        $prix = get_post_meta($post->ID,'prix_produit',true);
        echo '<label for="meta_prix"> Prix: </label>';
        echo '<input id="meta_prix" type="textarea" name="prix_produit" value="'.$prix.'"/>';
        
    }

    // meta-box "Disponibilité" function
    public function dispo_product_function($post){
        
        $dispo = get_post_meta($post->ID,'dispo_produit',true);
        echo '<label for="dispo_meta">Indiquez la disponibilité du produit :</label>';
        echo '<select name="dispo_produit">';
        echo '<option ' . selected( 'Disponible', $dispo, false ) . ' value="disponible">Disponible</option>';
        echo '<option ' . selected( 'Réservé', $dispo, false ) . ' value="réservé">Réservé</option>';
        echo '<option ' . selected( 'Vendu', $dispo, false ) . ' value="vendu">Vendu</option>';
        echo '</select>';

    }

    // meta-box "Localité" function
    public function localite_product_function($post) {

        $localite = get_post_meta($post->ID,'localite_produit',true);
        echo '<label for="meta_localite"> Localité: </label>';
        echo '<input id="meta_localite" type="textarea" name="localite_produit" value="'.$localite.'"/>';
        
    }

    // meta-boxing data saving function
    public function save_metaboxes($post_ID){
        if(isset($_POST['prix_produit'])){
            update_post_meta($post_ID,'prix_produit', esc_html($_POST['prix_produit']));
        }

        if(isset($_POST['dispo_produit'])) {
            update_post_meta($post_ID, 'dispo_produit', $_POST['dispo_produit']);
        }

        if(isset($_POST['localite_produit'])) {
            update_post_meta($post_ID, 'localite_produit', $_POST['localite_produit']);
        }
    }

    public function mapMetaCaps($caps, $cap, $user_id, $args)
    {
        /* If editing, deleting, or reading a product, get the post and post type object. */
        if ( 'edit_product' === $cap || 'delete_product' === $cap || 'read_product' === $cap ) {
            $post = get_post( $args[0] );
            $post_type = get_post_type_object( $post->post_type );
    
            /* Set an empty array for the caps. */
            $caps = [];
        }
    
        /* If editing a product, assign the required capability. */
        if ( 'edit_product' == $cap ) {
            if ( $user_id == $post->post_author ) {
                $caps[] = $post_type->cap->edit_posts;
            } else {
                $caps[] = $post_type->cap->edit_others_posts;
            }
        }
    
        /* If deleting a recipe, assign the required capability. */
        elseif ( 'delete_product' == $cap ) {
            if ( $user_id == $post->post_author )
                $caps[] = $post_type->cap->delete_posts;
            else
                $caps[] = $post_type->cap->delete_others_posts;
        }
    
        /* If reading a private recipe, assign the required capability. */
        elseif ( 'read_product' == $cap ) {
    
            if ( 'private' != $post->post_status )
                $caps[] = 'read';
            elseif ( $user_id == $post->post_author )
                $caps[] = 'read';
            else
                $caps[] = $post_type->cap->read_private_posts;
        }
    
        /* Return the capabilities required by the user. */
        return $caps;
    }

}
