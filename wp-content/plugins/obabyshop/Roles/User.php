<?php

namespace oBabyShop\Roles;

class User {
    
    public const NAME = 'user';

    public function add()
    {
        add_role(self::NAME, 'Utilisateur');
    }

    public function remove()
    {
        remove_role(self::NAME);
    }
}