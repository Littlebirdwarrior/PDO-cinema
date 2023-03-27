<?php

namespace Controller;
use Model\Connect;


class RealisateurController 
{
    //Lister les Réalisateurs
    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requeteListRealisateurs = $pdo->query("
        SELECT
            r.id_realisateur,
            CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomReal,
            p.sexe_personne,
            DATE_FORMAT(p.date_naissance_personne, '%d/%m/%Y') AS date_naissance
        FROM
            realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
        GROUP BY
            r.id_realisateur
        ");

    require "view/listRealisateurs.php";
     }

    public function detailRealisateur($id)
    {
        //Identité d'un réalisateurs
        $pdo = Connect::seConnecter();
        $requeteDetailReal = $pdo->prepare("
        SELECT
            CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomReal,
            DATE_FORMAT(p.date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            p.sexe_personne
        FROM
            realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE
            r.id_realisateur = :id
        ");
        $requeteDetailReal -> execute(["id" => $id]);

        // Filmographie (le film et le role de l'acteur)
        $pdo = Connect::seConnecter();
        $requeteFilmographie = $pdo->prepare("
        SELECT
            film.id_film,
            film.titre_film,
            film.annee_sortie_film
        FROM
        film
        WHERE
            film.id_realisateur = :id
        ORDER BY
            film.annee_sortie_film DESC
        ");
        $requeteFilmographie->execute(["id" => $id]);
        
        require "view/detailRealisateur.php";

    }





}