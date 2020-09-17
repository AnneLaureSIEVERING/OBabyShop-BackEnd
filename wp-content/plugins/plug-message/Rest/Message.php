<?php

namespace Message\Rest;

use Message\Classes\Database;

class Message {

    public static function rest_message_endpoints($request) {

        /**
         * Handle Message request.
         */
        register_rest_route('wp/v2', '/users/messages', array(
        'methods' => 'GET',
        'callback' => __CLASS__  . '::get_user_messages',
        'permission_callback' => '__return_true'
        ));

        register_rest_route('wp/v2', '/users/messages', array(
        'methods' => 'POST',
        'callback' => __CLASS__  . '::post_user_message',
        'permission_callback' => '__return_true'
        ));
    }

    /**
     * function to get current user message
     */
    public static function get_user_messages() {

        $recipient_id = get_current_user_id();
        
        $database = new Database();
        $results= $database->getMessages($recipient_id);
        
        return new \WP_REST_Response($results);
    }

    
    /**
     * function to post a message
     */
    public static function post_user_message($request = null) {

        global $post;

        $sender_id =  get_current_user_id();

        $recipient_id = $post->post_author;

        $parameters = $request->get_json_params();
        $content = sanitize_text_field($parameters['content']);
        
        $database = new Database();
        $database->addMessage($sender_id, $recipient_id, $content);

        $error = new \WP_Error();
        if (empty($sender_id)) {
          $error->add(400, __("l'ID de l'expéditeur n'est pas renseigné"), array('status' => 400));
          return $error;
        }
        if (empty($recipient_id)) {
            $error->add(400, __("l'ID du destinataire n'est pas renseigné"), array('status' => 400));
            return $error;
        }
        if (empty($content)) {
            $error->add(400, __("le message est vide"), array('status' => 400));
            return $error;
        } else {
            $response = new \WP_REST_Response(array('message' => 'Le message a été envoyé avec succés'));
            $response->set_status(200);
            return $response;
        }
    }
}