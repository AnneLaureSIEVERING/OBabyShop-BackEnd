<?php

namespace oBabyShop\Rest;

class User {

    public static function wp_rest_user_endpoints($request) {
        /**
         * Handle Register User request.
         */
        register_rest_route('wp/v2', 'users/register', array(
          'methods' => 'POST',
          'callback' => __CLASS__ . '::wc_rest_user_endpoint_handler'
        ));
      }
    public function wc_rest_user_endpoint_handler($request = null) {
        $response = array();
        $parameters = $request->get_json_params();
        $username = sanitize_text_field($parameters['username']);
        $email = sanitize_text_field($parameters['email']);
        $password = sanitize_text_field($parameters['password']);
        $firstname = sanitize_text_field($parameters['first_name']);
        $lastname = sanitize_text_field($parameters['last_name']);
        $address = sanitize_text_field($parameters['municipalité']);
        
        // $role = sanitize_text_field($parameters['role']);
        $error = new \WP_Error();
        if (empty($username)) {
          $error->add(400, __("Votre identifiant n'a pas été renseigné.", 'wp-rest-user'), array('status' => 400));
          return $error;
        }
        if (empty($email)) {
          $error->add(401, __("Votre email n'a pas été renseigné.", 'wp-rest-user'), array('status' => 400));
          return $error;
        }
        if (empty($password)) {
          $error->add(404, __("Le mot de passe n'a pas été renseigné.", 'wp-rest-user'), array('status' => 400));
          return $error;
        }
        if (empty($firstname)) {
            $error->add(404, __("Votre prénom n'a pas été renseigné.", 'wp-rest-user'), array('status' => 400));
            return $error;
        }
        if (empty($lastname)) {
            $error->add(404, __("Votre nom n'a pas été renseigné.", 'wp-rest-user'), array('status' => 400));
            return $error;
        }
        if (empty($address)) {
            $error->add(404, __("Votre municipalité n'a pas été renseignée.", 'wp-rest-user'), array('status' => 400));
            return $error;
        }
    
        $user_id = username_exists($username);
        if (!$user_id && email_exists($email) == false) {
          $user_id = wp_create_user($username, $password, $email);
          if (!is_wp_error($user_id)) {
            // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
            $user = get_user_by('id', $user_id);
            // $user->set_role($role);
            $user->set_role('user');

            $user->first_name=$firstname;
            $user->last_name=$lastname;

            wp_update_user($user);

            add_user_meta($user_id, 'municipalité', $address);

            // Ger User Data (Non-Sensitive, Pass to front end.)
            $response['code'] = 200;
            $response['message'] = __("User '" . $username . "' Vous êtes maintenant inscrit !", "wp-rest-user");
          } else {
            return $user_id;
          }
        } else {
          $error->add(406, __("Un compte utilisant cet email, existe déjà. Veuillez vous connecter ou générer un nouveau mot de passe", 'wp-rest-user'), array('status' => 400));
          return $error;
        }
        return new \WP_REST_Response($response, 123);
      }
}