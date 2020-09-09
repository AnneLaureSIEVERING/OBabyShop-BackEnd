<?php

namespace oBabyShop;

use oBabyShop\PostType\Product;


class Plugin
{

    /**
     * Start the plugin
     */
    public function run()
    {
        $this->registerPluginHooks();
        $this->addInitActions();
    }


    /**
     * Add init actions
     */
    public function addInitActions()
    {
        add_action(
            'init',
            [
                $this,
                'registerPostTypes'
            ]
        );
    }

    /**
     * Declare custom post types
     */
    public function registerPostTypes()
    {
        $productPostType = new Product;
        $productPostType->register();
    }

    /**
     * Unregister custom post types
     */
    public function unregisterPostTypes()
    {
        $productPostType = new Product;
        $productPostType->unregister();
    }

    /**
     * Set plugin hooks
     */
    private function registerPluginHooks()
    {
        register_activation_hook(
            OBABYSHOP_PLUGIN_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OBABYSHOP_PLUGIN_FILE,
            [
                $this,
                'deactivate'
            ]
        );
    }


    /**
     * triggered on plugin activation
     */
    public function activate()
    {
        $this->registerPostTypes();

        flush_rewrite_rules();
    }

    /**
     * triggered on plugin deactivate
     */
    public function deactivate()
    {
        $this->unregisterPostTypes();

        flush_rewrite_rules();
    }
}
