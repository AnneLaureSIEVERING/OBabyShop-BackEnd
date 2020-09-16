<?php

namespace Message\Rest;

use Message\Classes\Database;

class Message {

    public static function rest_message_endpoints($request) {

        /**
         * Handle Message request.
         */
        register_rest_route('wp/v2', '/messages_users_relationships/messages', array(
        'methods' => 'GET',
        'callback' => __CLASS__  . '::get_user_message',
        'permission_callback' => '__return_true'
        ));

        register_rest_route('wp/v2', '/messages_users_relationships/messages', array(
        'methods' => 'POST',
        'callback' => __CLASS__  . '::post_user_message',
        'permission_callback' => '__return_true'
        ));
    }

    /**
     * function to get current user message
     */
    public static function get_user_message() {

        $recipient_id = get_current_user_id();
        
        $database = new Database();
        $result= $database->getMessage($recipient_id);
        
        return new \WP_REST_Response($result, 123);
    }

    public static function post_user_message($request = null) {
        global $post;

        $sender_id =  get_current_user_id();

        $recipient_id=$post->post_author;

        $parameters = $request->get_json_params();
        $content = sanitize_text_field($parameters['content']);

        $database = new Database();
        $result=$database->addMessage($sender_id, $recipient_id, $content);

        return new \WP_REST_Response($result, 123);
    }
}