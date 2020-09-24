<?php

namespace oBabyShop\Rest;

use oBabyShop\PostType\Product as ProductPostType;

class Product
{
    public static function register_product_meta_fields()
    {
        register_meta(
            'post',
            'prix_produit',
            array(
                'type' => 'string',
                'single' => true,
                'show_in_rest' => true
            )
        );

        register_meta(
            'post',
            'dispo_produit',
            array(
                'type' => 'string',
                'single' => true,
                'show_in_rest' => true
            )
        );

        register_meta(
            'post',
            'localite_produit',
            array(
                'type' => 'string',
                'single' => true,
                'show_in_rest' => true
            )
        );

        register_meta(
            'user',
            'city',
            array(
                'type' => 'string',
                'single' => true,
                'show_in_rest' => true
            )
        );
    }

    /**
     * Add custom fields to product post type API calls
     */
    public static function registerCustomFields()
    {
        register_rest_field(
            ProductPostType::NAME,
            'featured_media_url',
            [
                'get_callback' => function ($productArray) {
                    $featuredMediaUrl = get_the_post_thumbnail_url($productArray['id']);

                    return $featuredMediaUrl;
                }
            ]
        );
    }

}