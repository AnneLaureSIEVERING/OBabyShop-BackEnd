<?php

namespace oBabyShop\Rest;

class Product {

    public static function register_product_meta_fields() {

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
            'municipalité',
		    array(
                'type' => 'string',
                'single' => true,
                'show_in_rest' => true
            )
        );
    }
}