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
            CONCAT(personne.prenom_personne, ' ', personne.nom_personne) AS realisateurs,
            personne.sexe_personne,
            DATE_FORMAT(date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            GROUP_CONCAT(CONCAT_WS('-', film.titre_film, film.annee_sortie_film) SEPARATOR ' | ') AS films
        FROM
            film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
         GROUP BY
            realisateur.id_realisateur
        ");

        require "view/listRealisateurs.php";
     }

    // public function detailRealisateur($id)
    // {
    // //Identité d'un réalisateurs
    // $pdo = Connect::seConnecter();
    // $requeteDetailReal = $pdo->prepare("
    // SELECT
    //     CONCAT(personne.prenom_personne, ' ', personne.nom_personne) AS realisateurs,
    //     CONCAT(film.titre_film, ' (', film.annee_sortie_film, ')') AS films
    // FROM
    //     film
    //     INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
    //     INNER JOIN personne ON realisateur.id_personne = personne.id_personne
    // WHERE
    //     realisateur.id_realisateur = :id
    // ");
    // $requeteDetailReal -> execute(["id" => $id]);
    // require "view/detailReal.php";
    // }


}