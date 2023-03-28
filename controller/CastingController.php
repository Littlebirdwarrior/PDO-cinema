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
            film f
        GROUP BY
            f.id_film
        ORDER BY
            f.titre_film ASC
        ');

        //Lister id et nom de la table acteurs
        $requeteSelectActeurs = $pdo->query('
        SELECT
            a.id_acteur,
            p.prenom_personne,
            p.nom_personne
        FROM
            acteur a
            INNER JOIN personne p ON p.id_personne = a.id_personne
        GROUP BY
            a.id_acteur
        ORDER BY
            p.nom_personne, p.prenom_personne ASC
        ');

        //Lister id et nom de la table role
        $requeteSelectRoles = $pdo->query('
        SELECT
            r.id_role,
            r.nom_role
        FROM
            role r
        GROUP BY
            r.id_role
        ORDER BY
            r.nom_role ASC
        ');

        //*Quand on submit le form
        if (isset($_POST['submitCasting'])){

            //Connexion BDD
            $pdo = Connect::seConnecter();
            
            //filtre
            /*Il existe 2 types de filtres de base : les filtres de validation, 
            qui renvoient la valeur qu'on leur a donné ou false, et les filtres de nettoyage 
            ("sanitize") qui renvoient la valeur qu'on leur a donné privée de certains éléments. 
            FILTER_VALIDATE_URL renverra false si une URL contient des caractères incompatibles, 
            alors que FILTER_SANITIZE_URL retirera les caractères interdits et renverra l'URL ainsi nettoyée.
            NB : ici, le validate transforme les string en int
            Source : https://zestedesavoir.com/tutoriels/295/les-filtres-en-php/
            * */

            $roleId = filter_input(INPUT_POST, "roleId", FILTER_VALIDATE_INT);
            $acteurId = filter_input(INPUT_POST, "acteurId", FILTER_VALIDATE_INT);
            $filmId = filter_input(INPUT_POST, "filmId", FILTER_VALIDATE_INT);

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