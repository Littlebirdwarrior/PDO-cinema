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
            CONCAT (prenom, ' ', nom) as nomReal,
        FROM 
            personne p
            INNER JOIN realisateur r ON p.id_personne = r.id_personne
            WHERE p.id_personne IN 
                (SELECT r.id_personne FROM realisateur r)
        ORDER BY 
            nomReal
        ");

        require "view/listRealisateurs.php";
     }

    public function detailRealisateur($id)
    {
    //Identité d'un réalisateurs
    $pdo = Connect::seConnecter();
    $requeteDetailReal = $pdo->prepare("
        SELECT 
            CONCAT(prenom, ' ', nom) as nomReal,
        FROM 
            personne p
            INNER JOIN realisateur r ON p.id_personne = r.id_personne
        WHERE 
        p.id_personne 
            IN (SELECT r.id_personne FROM realisateur r)
        ORDER BY 
            nomReal
    ");
    $requeteDetailReal -> execute(["id" => $id]);
    require "view/detailReal.php";
    }


}