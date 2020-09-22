<?php

namespace oBabyShop\Rest;

use oBabyShop\Classes\Database;

class SearchCity { 

    public static function rest_city_endpoints() {

        /**
         * Handle Message request.
         */
        register_rest_route('wp/v2', '/search/city', array(
        'methods' => 'GET',
        'callback' => __CLASS__  . '::get_products_city',
        'permission_callback' => '__return_true'
        ));
    }

    /**
    * function to get products with a filter "city"
    */
    public static function get_products_city($request = null) {

        $parameters = $request->get_json_params();
        $city = sanitize_text_field($parameters['city']);
        
        $database = new Database();
        $results= $database->getProducts($city);
        
        $error = new \WP_Error();
        if (empty($city)) {
          $error->add(400, __("la ville n'a pas été renseignée"), array('status' => 400));
          return $error;
        } else {
            return new \WP_REST_Response($results);
        }
    }

}