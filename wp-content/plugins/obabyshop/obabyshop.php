<?php

/**
 * Plugin Name: oBabyShop
 * Author: Team OBabyShop
 * Description: Plugin WordPress Custom for the OBabyShop project
 */

if (!defined('WPINC')) {
    http_response_code(404);
    exit;
}


define('OBABYSHOP_PLUGIN_FILE', __FILE__);

require plugin_dir_path(OBABYSHOP_PLUGIN_FILE) . 'vendor/autoload.php';

$plugin = new oBabyShop\Plugin;
$plugin->run();
