<?php

namespace Message;

use Message\Classes\Database;
use Message\Rest\Message;

class Plugin {

    /**
     * Start the plugin
     */
    public function run()
    {
        $this->registerPluginHooks();
        $this->addRestInitActions();
    }

     /**
     * Add REST API init actions
     */
    public function addRestInitActions()
    {
        add_action(
            'rest_api_init',
            [
                $this,
                'registerRestEndpoints'
            ]
        );
    }

    /**
     * Register Rest Endpoints API
     */
    public function registerRestEndpoints($request)
    {
     Message::rest_message_endpoints($request);
    }

    /**
     * Register activation and deactivation hooks
     */
    public function registerPluginHooks()
    {
        register_activation_hook(
            OBABYSHOP_MESSAGE_PLUGIN_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OBABYSHOP_MESSAGE_PLUGIN_FILE,
            [
                $this,
                'deactivate'
            ]
        );
    }

    /**
    * Activate plugin
    */
    public function activate()
    {
        
        flush_rewrite_rules();

        $this->generateCustomTables();
    }

    /**
     * Generate custom database tables
    */
    private function generateCustomTables()
    {
        $database = new Database();
        $database->generateCustomTables();
    }

    /**
     * Deactivate plugin
     */
    public function deactivate()
    {
       
    }

}