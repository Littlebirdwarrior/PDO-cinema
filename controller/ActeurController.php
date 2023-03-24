<?php
//gere le traitements des requête acteurs

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs(){
        $pdo = Connect::seConnecter();

        $requeteListActeurs = $pdo->query("
        SELECT
            CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
            p.sexe_personne,
            DATE_FORMAT(date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            GROUP_CONCAT(CONCAT(f.titre_film, ' (', f.annee_sortie_film, ')') SEPARATOR ', ') AS filmographie
        FROM
            acteur a
            INNER JOIN personne p ON p.id_personne = a.id_personne
            INNER JOIN casting c ON c.id_acteur = a.id_acteur
            INNER JOIN film f ON c.id_film = f.id_film
        GROUP BY
            a.id_acteur
        ORDER BY
            p.nom_personne,
            date_naissance_personne
        ");
    
    require "view/listActeurs.php";
    }

    //Détail Acteurs
    public function detailActeur($id){
    //Identité et filmographie, 2 requetes différentes pour plus de clareté
        // Identité
        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare("
        SELECT
            CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
            DATE_FORMAT(p.date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            p.sexe_personne
        FROM
            personne p
            INNER JOIN acteur a ON p.id_personne = a.id_personne
        WHERE
        a.id_acteur = :id
        ");
        $requeteDetailActeur->execute(['id' => $id]);

        // Filmographie (le film et le role de l'acteur)
        $pdo = Connect::seConnecter();
        $requeteFilmographie = $pdo->prepare("
        SELECT
            film.id_film,
            film.titre_film,
            role.nom_role,
            film.annee_sortie_film
        FROM
            casting
            INNER JOIN film ON casting.id_film = film.id_film
            INNER JOIN ROLE ON casting.id_role = role.id_role
        WHERE
            casting.id_acteur = :id
        ORDER BY
            film.annee_sortie_film DESC
        ");
        $requeteFilmographie->execute(["id" => $id]);
        
        require "view/detailActeur.php";

    }


}