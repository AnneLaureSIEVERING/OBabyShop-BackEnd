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
                    'custom-fields',
                    'author',
                    'thumbnail',
                    'excerpt'
                ],

            ]
        );

        add_theme_support('post-thumbnails', [self::NAME]);
    }

    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(self::NAME);
    }
}
