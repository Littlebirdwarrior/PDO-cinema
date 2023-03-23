<?php
//gere le traitements des requête acteurs

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs(){
        $pdo = Connect::seConnecter();

        $requeteListActeurs = $pdo->query('
        SELECT 
            p.prenom_personne,
            p.nom_personne,
            p.sexe_personne,
            p.date_naissance_personne 
        FROM 
            acteur a
            INNER JOIN personne  p ON a.id_personne = p.id_personne
        ');
    
    require "view/listActeurs.php";
    }

    //Détail Acteurs
    public function detailActeur($id){

        // Identité
        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare('
        SELECT
            CONCAT(prenom_personne, " ", nom_personne) AS qui,
            DATE_FORMAT(date_naissance_personne, "%d/%m/%Y") AS date_naissance,
            sexe_personne
        FROM
            personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        WHERE
            acteur.id_acteur = :id
        ');
        $requeteDetailActeur->execute(["id" => $id]);

        // Filmographie
        $pdo = Connect::seConnecter();
        $requeteFilmographie = $pdo->prepare("
        SELECT 
            f.titre_film, 
            nom_role, 
            f.id_film
        from casting c 
            INNER JOIN role r on c.id_role = r.id_role
            INNER JOIN acteur a ON c.id_acteur = a.id_acteur
            INNER JOIN personne p ON a.id_personne = p.id_personne 
            INNER JOIN film f ON c.id_film = f.id_film
        WHERE a.id_acteur = :id
        ");
        $requeteFilmographie->execute(["id" => $id]);
        
        require "view/detailActeur.php";
    }


}