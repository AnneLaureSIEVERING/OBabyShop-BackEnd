<?php

namespace oBabyShop\Taxonomy;

use oBabyShop\PostType\Product as ProductPostType;

class Category
{

    public const NAME = 'category';

    /**
     * Register taxonomy
     */
    public function register()
    {
        register_taxonomy(
            self::NAME,
            ProductPostType::NAME,
            [
                'label'        => __('Catégories'),
                'public'       => true,
                'hierarchical' => false,
                'show_in_rest' => true,
                'capabilities' => [
                    'manage_terms' => 'manage_category',
                    'edit_terms' => 'manage_category',
                    'delete_terms' => 'manage_category',
                    'assign_terms' => 'edit_products'
                ]
            ]
        );
    }

    /**
     * Unregister taxonomy
     */
    public function unregister()
    {
        unregister_taxonomy(self::NAME);
    }

    static public function getAllTerms()
    {

        $terms = get_terms([
            'taxonomy' => self::NAME,
            'hide_empty' => false
        ]);

        return $terms;
    }
}
