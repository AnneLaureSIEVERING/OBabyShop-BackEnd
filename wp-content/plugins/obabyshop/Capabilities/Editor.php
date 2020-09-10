<?php

namespace oBabyShop\Capabilities;

class Editor {

    public const ROLE_NAME = 'editor';

    public const CAPABILITIES = [
        'read' => true,
        'edit_product' => true,
        'read_product' => true,
        'delete_product' => true,
        'edit_products' => true,
        'edit_others_products' => true,
        'delete_products' => true,
        'publish_products' => true,
        'read_private_products' => true,
        'delete_private_products' => true,
        'delete_published_products' => true,
        'delete_others_products' => true,
        'edit_private_products' => true,
        'edit_published_products' => true,
        'create_products' => false,
        'manage_category' => true, 
    ];

    /**
     * Add caps
     */
    static public function setupCapabilities()
    { 
        $role = get_role(self::ROLE_NAME);
        foreach (self::CAPABILITIES as $capName => $capValue) {
            $role->add_cap($capName, $capValue);
        }
    }

    /**
     * Remove caps
     */
    static public function removeCapabilities()
    {
        $role = get_role(self::ROLE_NAME);
        $capabilitiesList = array_keys(self::CAPABILITIES);

        if ($role) {
            foreach($capabilitiesList as $capability) {
                $role->remove_cap($capability);
            }
        }
    }
}