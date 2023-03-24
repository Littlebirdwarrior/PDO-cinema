<?php

namespace Controller;
use Model\Connect;


class RealisteurController 
{

     //Lister les Réalisateurs
     public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requeteDetailRealisateur = $pdo->query("
        SELECT
            CONCAT(personne.prenom_personne, ' ', personne.nom_personne) AS realisateurs,
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

//     public function detailRealisateur($id)
//     {
//     //Identité d'un réalisateurs
//     $pdo = Connect::seConnecter();
//     $requeteDetailReal = $pdo->prepare("
//         SELECT 
//             CONCAT(prenom, ' ', nom) as nomReal,
//         FROM 
//             personne p
//             INNER JOIN realisateur r ON p.id_personne = r.id_personne
//         WHERE 
//         p.id_personne 
//             IN (SELECT r.id_personne FROM realisateur r)
//         ORDER BY 
//             nomReal
//     ");
//     $requeteDetailReal -> execute(["id" => $id]);
//     require "view/detailReal.php";
//     }


}