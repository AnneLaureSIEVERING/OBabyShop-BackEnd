<?php

namespace oBabyShop;

use oBabyShop\PostType\Product;
use oBabyShop\Taxonomy\Category as TaxonomyCategory;
use oBabyShop\Roles\User;
use oBabyShop\Rest\Product as RestProduct;
use oBabyShop\Rest\User as RestUser;
use oBabyShop\Capabilities\Administrator as AdministratorCapabilities;
use oBabyShop\Capabilities\Editor as EditorCapabilities;
use oBabyShop\Capabilities\User as UserCapabilities;



class Plugin
{

    /**
     * Start the plugin
     */
    public function run()
    {
        $this->registerPluginHooks();
        $this->addInitActions();
        $this->addRestInitActions();
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

        add_action(
            'init',
            [
                $this,
                'registerTaxonomies'
            ]
        );
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
                'registerRestMetaFields'
            ]
        );

        add_action(
            'rest_api_init',
            [
                $this,
                'registerFormRestUserEndpoints'
            ]
        );

        add_action(
            'rest_api_init',
            [
                $this,
                'registerRestCustomFields'
            ]
        );
    }

    /**
     * Register custom fields in REST API
     */
    public function registerRestMetaFields()
    {
        RestProduct::register_product_meta_fields();
    }

    public function registerFormRestUserEndpoints($request)
    {
        RestUser::wp_rest_user_endpoints($request);
    }

    public function registerRestCustomFields()
    {
        RestProduct::registerCustomFields();
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
     * Register taxonomies
     */
    public function registerTaxonomies()
    {
        $categoryTaxonomy = new TaxonomyCategory;
        $categoryTaxonomy->register();
    }

    /**
     * Unregister taxonomies
     */
    public function unregisterTaxonomies()
    {

        $categoryTaxonomy = new TaxonomyCategory;
        $categoryTaxonomy->unregister();
    }

    /**
     * Add custom roles
     */
    public function addRoles()
    {
        $userRole = new User;
        $userRole->add();
    }

    /**
     * Remove custom roles
     */
    public function removeRoles()
    {
        $userRole = new User;
        $userRole->remove();
    }

    /**
     * Setup capabilities
    */
    public function setupCapabilities()
    {
        AdministratorCapabilities::setupCapabilities();
        EditorCapabilities::setupCapabilities();
        UserCapabilities::setupCapabilities();
    }

    /**
     * Remove capabilities
     */
    public function removeCapabilities()
    {
        AdministratorCapabilities::removeCapabilities();
        EditorCapabilities::removeCapabilities();
        UserCapabilities::removeCapabilities();
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
        $this->registerTaxonomies();

        flush_rewrite_rules();

        $this->addRoles();
        $this->setupCapabilities();
        
        
    }

    /**
     * triggered on plugin deactivate
     */
    public function deactivate()
    {
        $this->unregisterPostTypes();
        $this->unregisterTaxonomies();

        flush_rewrite_rules();

        $this->removeRoles();
        $this->removeCapabilities();
        
    }
}
