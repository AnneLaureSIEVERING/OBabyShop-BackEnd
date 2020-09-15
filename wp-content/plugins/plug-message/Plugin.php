<?php

namespace Message;

use Message\Classes\Database;

class Plugin {
     /**
     * Start the plugin
     */
    public function run()
    {
        $this->registerPluginHooks();
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