<?php

namespace Controller;
use Model\Connect;

class GenreController 
{
    public function addGenre(){

        if (isset($_POST['submitGenre'])){
             //Connexion BDD
        $pdo = Connect::seConnecter();

        //filtre
        $libelleGenre = filter_input(INPUT_POST, "libelleGenre", FILTER_SANITIZE_SPECIAL_CHARS);

        //*Ajout Genre (id généré automatiquement)
        $addGenreRequest = $pdo->prepare("
        INSERT INTO genre (libelle_genre) 
        VALUES (:libelleGenre)
        ");

        $addGenreRequest->execute([
            "libelleGenre" => $libelleGenre,
        ]);
        }

        require "view/addGenre.php";
    }
}