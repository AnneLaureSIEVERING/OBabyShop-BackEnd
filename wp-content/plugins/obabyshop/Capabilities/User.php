<?php

namespace oBabyShop\Capabilities;

class User {

    public const ROLE_NAME = 'user';

    public const CAPABILITIES = [
        'read' => true,
        'edit_product' => true,
        'read_product' => false,
        'delete_product' => true,
        'edit_products' => true,
        'edit_others_products' =>false,
        'delete_products' => true,
        'publish_products' => true,
        'read_private_products' => false,
        'delete_private_products' => false,
        'delete_published_products' => false,
        'delete_others_products' => false,
        'edit_private_products' => false,
        'edit_published_products' => false,
        'create_products' => true,
        'manage_category' => false,
        'upload_files' => true
    ];

    /**
     * Add caps
     */
    static public function setupCapabilities(){
        $role = get_role(self::ROLE_NAME);

        foreach (self::CAPABILITIES as $capName => $capValue) {
            $role->add_cap($capName, $capValue);
        }
    }

    /**
     * Remove caps
     */
    static public function removeCapabilities() {
        $role = get_role(self::ROLE_NAME);
       
        $capabilitiesList = array_keys(self::CAPABILITIES);

        if ($role) {
            foreach($capabilitiesList as $capability) {
                $role->remove_cap($capability);
            }
        }
    }
}