<?php

namespace Controller;
use Model\Connect;

class RoleController
{
    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requeteListRoles = $pdo->query("
            SELECT 
            * 
            FROM role
            ");

            require "view/listRoles.php";
    }

}

