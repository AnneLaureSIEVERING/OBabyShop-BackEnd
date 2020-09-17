<?php

/**
 * Plugin Name: Messagerie
 * Author: Team OBabyShop
 * Description: Plugin WordPress Custom for the OBabyShop project - Message
 */

if (!defined('WPINC')) {
    http_response_code(404);
    exit;
}


define('OBABYSHOP_MESSAGE_PLUGIN_FILE', __FILE__);

require plugin_dir_path(OBABYSHOP_MESSAGE_PLUGIN_FILE) . 'vendor/autoload.php';

$plugin = new Message\Plugin;
$plugin->run();
