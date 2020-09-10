<?php

namespace oBabyShop\Roles;

class Customer {
    
    public const NAME = 'customer';

    public function add()
    {
        add_role(self::NAME, 'Utilisateur');
    }

    public function remove()
    {
        remove_role(self::NAME);
    }
}