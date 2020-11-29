<?php

 use PHPUnit\Framework\TestCase;

 // Convention de nommage la class doit porter le même nom que le fichier (relatif à ce qu'on chercher à tester)
 // ici notre classe va hériter du comportement par défaut de TestCase 

 // ici on test que la récupération des données suite à l'envoi d'un message par un utilisateur fonctionne bien


 class obabyshopMessagingTest extends TestCase {

     /**
     * Client HTTP => une librairie qui permet de réaliser des appels HTTML (requêtes)
     */
     private $http;
     private $jwtToken;

     // Cette méthode sera déclenchée à chaque démarrage d'un test
     // :void = on a pas de valeur à retourner. Ici on est obligé de l'indiquer pour que la méthode corresponde à la méthode setUp de TestCase
    // dans la méthode ci dessous, je créer une nouvelle instale de GuzzleHttp\Client et je lui donne l'url de base
     function setUp():void {
         $this->http = new GuzzleHttp\Client(['base_uri' => WP_HOME . '/']);
     }
    


    /**
     * Test ObabyShop messaging
     */

     Public function testUserLogin () {

        global $jwtToken;

        $loginTestData = [
            'username' => 'JohnDoe',
            'password' => 'obabyshop'
        ];

        $loginActionURL = WP_HOME . '/wp-json/jwt-auth/v1/token';

        $response = $this->http->request(
            'POST',
            $loginActionURL,
            [
                'form_params' => $loginTestData
            ]
        );

        $bodyToken = $response->getBody()->getContents();

        $bodyToken = json_decode($bodyToken);

        $jwtToken = $bodyToken->data->token;

        $this->assertEquals(200, $response->getStatusCode());
     }


     public function testUserMessaging () {

        global $jwtToken;
         
        // définir les données qui seront utilisées pour l'envoi d'un message (données de test)
        $messageTestData = [
            'recipient_id' => 12,
            'content' => 'coucou le test unitaire'
        ];

        // récupérer l'adresse qui sert d'action pour les messages 
        $messagingActionURL = WP_HOME . '/wp-json/wp/v2/users/messages';

        // enregistrer les données en base de données
        // pour faire ça en va utiliser la librairie guzzlehttp qui permet de réaliser des requêtes
        // Ici on va utiliser la méthode POST, on indique la route à utiliser puis dans l'array on indique les données à envoyer dans la requête
        $response = $this->http->request(
            'POST',
            $messagingActionURL,
            [
                // la clé form_params est imposée par Guzzle, elle doit contenir les données du form sous la forme clé => valeur
                'json' => $messageTestData,
                'headers' => [
                    'Authorization' => 'Bearer ' . $jwtToken
                ]
            ]
         );

         // on s'assure de ne pas avoir d'erreur côté serveur
         // assertEquals () est une méthode qui sert à vérifier que les deux arguments qu'on lui donne sont égaux
         $this->assertEquals(200, $response->getStatusCode());

        // vérifier si on arrive à récuper un message qui correspond à nos données de test 
        // => faire une assertion : assertTrue($unedonnée) : si $unedonnée est false, le test à échoué
        $response = $this->http->request(
            'GET',
            $messagingActionURL,
         );

         $this->assertEquals(200, $response->getStatusCode());
    
     }
  
 }