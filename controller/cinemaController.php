<?php
//un seul fichier pour le moment également qui contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues 

namespace Controller;
use Model\Connect;


class CinemaController {
    //lister les film

  
    public function listFilms(){
        $pdo = Connect::seConnecter();

        $requete = $pdo->query('
        SELECT
                film.titre_film,
                film.annee_sortie_film,
                TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS duree_film,
                personne.prenom_personne,
                personne.nom_personne,
                film.note_film
            FROM
            film
                INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                INNER JOIN personne ON realisateur.id_personne = personne.id_personne
    ');

    require "view/listFilms.php";
    }
}


// use Controller\CinemaController;

// //On autocharge les classes du projet 
// spl_autoload_register(function($class_name){
//    include $class_name . 'php';
// });

// $ctrlCinema = new CinemaController();

// if(isset($GET["action"])){
//    switch ($_GET["action"]){
//        case "listFilms" : $ctrlCinema->listFilms(); break;
//        case "listActeurs" : $ctrlCinema->listActeurs(); break;
//    }
// }


