<?php

namespace Message\Classes;


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

    /**
    * Generate custom database table
    */
    public function generateCustomTables()
    {
    
        $charset_collate = $this->connector->get_charset_collate();

        $tableName = $this->connector->prefix . 'messages_users_relationships';
        $userTable = $this->connector->prefix . 'users';

        $sql = "
            CREATE TABLE IF NOT EXISTS `{$tableName}` (
                `message_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `sender_id` BIGINT(20) UNSIGNED NOT NULL,
                `recipient_id` BIGINT(20)  UNSIGNED NOT NULL,
                `content` TEXT NOT NULL,
                `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(`message_id`),
                FOREIGN KEY(`sender_id`) REFERENCES {$userTable}(ID),
                FOREIGN KEY(`recipient_id`) REFERENCES {$userTable}(ID)

            ) {$charset_collate};
        ";

        $this->connector->query($sql);
    }

    /**
     * Add message in DB 
     *
     */
    public function addMessage($sender_id, $recipient_id, $content) {
        $tableName = $this->connector->prefix . 'messages_users_relationships';

        $sql = "
            INSERT INTO `{$tableName}` (`sender_id`, `recipient_id`, `content`) VALUES (%d, %d, %s)
        ";

        $this->connector->query($this->connector->prepare($sql, [$sender_id, $recipient_id, $content]), OBJECT);
    }

    /**
     * Recover messages in DB for a user (recipient)
     */
    public function getMessages($recipient_id){

        $tableNameMessage = $this->connector->prefix . 'messages_users_relationships';
        $tableNameUser = $this->connector->prefix . 'users';

        $sql = "
            SELECT messages.`message_id`, messages.`sender_id`, messages.`recipient_id`, messages.`content`, messages.`date`, user.`ID`, user.`user_nicename`
            FROM `{$tableNameMessage}` AS messages
            INNER JOIN `{$tableNameUser}` AS user
            ON messages.`sender_id` = user.`ID`
            WHERE recipient_id = %d
        ";

        $results = $this->connector->get_results( $this->connector->prepare($sql, [$recipient_id]), OBJECT );

        return $results;
    }

}
