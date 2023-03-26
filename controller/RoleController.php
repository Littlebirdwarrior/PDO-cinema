<?php

namespace Controller;
use Model\Connect;

class RoleController
{
    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requeteListRoles = $pdo->query("
            SELECT
                r.id_role,
                r.nom_role,
                a.id_acteur,
                CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
                f.id_film,
                f.titre_film,
                f.annee_sortie_film
            FROM
                ROLE r
                INNER JOIN casting c ON c.id_role = r.id_role
                INNER JOIN film f ON f.id_film = c.id_film
                INNER JOIN acteur a ON c.id_acteur = a.id_acteur
                INNER JOIN personne p ON p.id_personne = a.id_acteur
            ORDER BY nom_role
            ");

            require "view/listRoles.php";
    }

}

