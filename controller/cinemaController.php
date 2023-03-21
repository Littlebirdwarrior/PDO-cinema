<?php
//un seul fichier pour le moment également qui contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues 

namespace Controller;
use Model\Connect;


class CinemaController {
    //lister les films  
    public function listFilms(){
        $pdo = Connect::seConnecter();

        $requeteListFilm = $pdo->query('
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
    
    //afficher le detail des films
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
            $requeteDetailFilm = $pdo->query('
        SELECT
            film.titre_film,
            film.annee_sortie_film,
            TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS duree_film,
            film.synopsis_film,
            personne.prenom_personne,
            personne.nom_personne,
            film.affiche_film,
            film.note_film
        FROM
        film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE film.id_film = :id 
    ');
    $requeteDetailFilm->execute(["id" => $id]);//ici, quelque chose ne marche pas

    require "view/detailFilm.php";        
    }

    }//fin controller



