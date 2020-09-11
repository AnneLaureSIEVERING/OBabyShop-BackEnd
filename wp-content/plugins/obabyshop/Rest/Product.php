<?php

namespace oBabyShop\Rest;

use oBabyShop\PostType\Product as ProductPostType;

class Product {

    public static function register_rest_fields_meta() {

	    register_rest_field( 
		    ProductPostType::NAME,
            'meta',
		    [
			    
                'get_callback' => function ($productArray) {
                $productMeta = get_post_meta($productArray['id']);

                return $productMeta;
                }
		    ]
        );
    }

}