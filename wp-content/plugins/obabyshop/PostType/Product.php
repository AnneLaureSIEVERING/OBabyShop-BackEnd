<?php

namespace oBabyShop\PostType;

class Product
{
    /**
     * Post type name
     *
     * @var string
     */
    public const NAME = 'product';

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
                'supports'              => [
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'excerpt'
                ],

            ]
        );

        add_theme_support('post-thumbnails', [self::NAME]);
    }

    public function __construct() {

        add_action('add_meta_boxes',[$this,'initialisation_metaboxes']);
        add_action('save_post',[$this, 'save_metaboxes']);

    }

    public function initialisation_metaboxes() {

        add_meta_box('prix_produit', 'Prix', [$this,'metabox_function'], self::NAME, 'normal', 'default');
        add_meta_box('dispo_produit', 'Disponibilité du produit', [$this,'dispo_produit_function'], self::NAME, 'normal', 'default');

    }

    public function metabox_function($post) {

        $prix = get_post_meta($post->ID,'_prix_produit',true);
        echo '<label for="meta_prix"> Prix: </label>';
        echo '<input id="meta_prix" type="textarea" name="prix_produit" value="'.$prix.'"/>';
        
    }

    public function dispo_produit_function($post){
        
        $dispo = get_post_meta($post->ID,'_dispo_produit',true);
        echo '<label for="dispo_meta">Indiquez la disponibilité du produit :</label>';
        echo '<select name="dispo_produit">';
        echo '<option ' . selected( 'Disponible', $dispo, false ) . ' value="disponible">Disponible</option>';
        echo '<option ' . selected( 'Réservé', $dispo, false ) . ' value="réservé">Réservé</option>';
        echo '<option ' . selected( 'Indisponible', $dispo, false ) . ' value="indisponible">Indisponible</option>';
        echo '</select>';

    }

    public function save_metaboxes($post_ID){
        if(isset($_POST['prix'])){
            update_post_meta($post_ID,'_prix_produit', esc_html($_POST['prix_produit']));
        }

        if(isset($_POST['dispo_produit'])) {
            update_post_meta($post_ID, '_dispo_produit', $_POST['dispo_produit']);
        }
    }


    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(self::NAME);
    }






}
