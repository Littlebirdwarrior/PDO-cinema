<?php

namespace Controller;
use Model\Connect;

class CastingController {


    public function addCasting(){

        //Connexion BDD
        $pdo = Connect::seConnecter();

        //*Afficher les données
        //Lister id et nom de la table film
        $requeteSelectFilms = $pdo->query('
        SELECT 
            f.titre_film,
            f.id_film
        FROM 
            casting c
            INNER JOIN film f ON f.id_film = c.id_film
        ORDER BY
            f.titre_film ASC
        ');

        //Lister id et nom de la table acteurs
        $requeteSelectActeurs = $pdo->query('
        SELECT
            a.id_acteur,
            p.prenom_personne,
            p.nom_personne,
        FROM
            casting c
            INNER JOIN acteur a ON a.id_acteur = c.id_acteur
            INNER JOIN personne p ON p.id_personne = a.id_personne
        GROUP BY
            c.id_acteur
        ORDER BY
            p.nom_personne, p.prenom_personne ASC
        ');

        //Lister id et nom de la table role
        $requeteSelectRoles = $pdo->query('
        SELECT
            r.id_role,
            r.nom_role
        FROM
            casting c
            INNER JOIN ROLE r ON r.id_role = c.id_role
        ORDER BY
            r.nom_role ASC
        ');

        //*Quand on submit le form
        if (isset($_POST['submitCasting'])){

            //Connexion BDD
            $pdo = Connect::seConnecter();
            
            //filtre
            $roleId = filter_input(INPUT_POST, (int)"roleId", FILTER_VALIDATE_INT);
            $acteurId = filter_input(INPUT_POST, (int)"acteurId", FILTER_VALIDATE_INT);
            $filmId = filter_input(INPUT_POST, (int)"filmId", FILTER_VALIDATE_INT);

            //Preparation requete en ciblant casting
            $addCastingRequest = $pdo ->prepare("
            INSERT INTO casting (id_film, id_role, id_acteur) 
            VALUES(:filmId, :roleId, :acteurId)
            ");

            

            $addCastingRequest->execute([
                "roleId" => $roleId,
                "acteurId" => $acteurId,
                "filmId" => $filmId,
            ]);
        }  

        //j'affiche vers le bonne page
        require 'view/addCasting.php';

    }

}