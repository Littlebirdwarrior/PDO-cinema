<?php

namespace Controller;
use Model\Connect;

class RoleController
{
    public function listRoles(){
        $pdo = Connect::seConnecter(); 
        
        //ici casting est obligatoire pour enregister les role dans la BDD
        $requeteListRoles = $pdo->query("
            SELECT
                r.id_role,
                r.nom_role,
                c.id_acteur,
                CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
                f.id_film,
                f.titre_film,
                f.annee_sortie_film
            FROM
                casting c
                INNER JOIN role r ON c.id_role = r.id_role
                INNER JOIN film f ON f.id_film = c.id_film
                INNER JOIN acteur a ON c.id_acteur = a.id_acteur
                INNER JOIN personne p ON p.id_personne = a.id_personne
            ORDER BY nom_role
            ");

            require "view/listRoles.php";
    }

    public function detailRole($id)
    {
        //Afficher les informations sur le film (id dans url)
        $pdo = Connect::seConnecter();
        $requeteDetailRole = $pdo->prepare("
            SELECT
                r.id_role,
                r.nom_role,
                a.id_acteur,
                CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
                f.id_film,
                f.titre_film,
                f.annee_sortie_film
            FROM
                role r
                INNER JOIN casting c ON c.id_role = r.id_role
                INNER JOIN film f ON f.id_film = c.id_film
                INNER JOIN acteur a ON c.id_acteur = a.id_acteur
                INNER JOIN personne p ON p.id_personne = a.id_personne
            WHERE
                r.id_role = :id
            ");
        $requeteDetailRole->execute(["id" => $id]);

        require "view/detailRole.php";
    }

    public function addRole(){

        if (isset($_POST['submitRole'])){
             //Connexion BDD
        $pdo = Connect::seConnecter();

        //filtre
        $nomRole = filter_input(INPUT_POST, "nomRole", FILTER_SANITIZE_SPECIAL_CHARS);

        //*Ajout Role (id généré automatiquement)
        $addRoleRequest = $pdo->prepare("
        INSERT INTO role (nom_role) 
        VALUES (:nomRole)
        ");

        $addRoleRequest->execute([
            "nomRole" => $nomRole,
        ]);
        }

        require "view/addRole.php";
    }


}

