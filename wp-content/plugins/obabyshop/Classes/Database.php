<?php

namespace oBabyShop\Classes;


class Database {

    /**
     * Access to database
     */
    private $connector;

   
    public function __construct()
    {
        global $wpdb;
        $this->connector = $wpdb;
    }

    public function getProducts($city){

        $tableNamePostMeta = $this->connector->prefix . 'postmeta';
        $tableNamePosts = $this->connector->prefix . 'posts';

        $sql = "
            SELECT meta.`post_id`, meta.`meta_id`, meta.`meta_key`, meta.`meta_value`, post.`post_title`, post.`post_excerpt`
            FROM `{$tableNamePostMeta}` AS meta
            INNER JOIN `{$tableNamePosts}` AS post
            ON post.`ID` = meta.`post_id`
            WHERE meta_value = %s
        ";

        $results = $this->connector->get_results( $this->connector->prepare($sql, [$city]), OBJECT );

        return $results;
    }
}
