<?php

//un seul fichier pour le moment également qui contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues 

namespace Controller;

use Model\Connect;

//Mon controlleur (c'est une classe dont on crée des instances)
class CinemaController
{
    //lister les films
    public function listFilms()
    {
        //Lister les info de la table film
        $pdo = Connect::seConnecter();
        $requeteListFilms = $pdo->query('
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

        //Lister les reals pour le formulaire
        
        //Lister les genres pour le formulaire

        //Envoyer les informations à la vue
        require "view/listFilms.php";
    }

    //afficher le detail des films 
    //(nb, avec un id, utiliser la méthode prépare et non query)
    public function detailFilm($id)
    {
        //Afficher les informations sur le film (id dans url)
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare('
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
            $requeteDetailFilm->execute(["id" => $id]);
        

          
        require "view/detailFilm.php";
    }

        public function addFilm() {
            if (isset($_POST['submit'])) {
                //Fitrage des données
                $pdo = Connect::seConnecter();

                //Les filtre pour eviter les failles XSS (sans image)
                $titreFilm = filter_input(INPUT_POST, "titreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $synopsisFilm = filter_input(INPUT_POST, "synopsisFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $anneeSortieFilm = filter_input(INPUT_POST, "anneeSortieFilm", FILTER_VALIDATE_INT);
                $dureeFilm = filter_input(INPUT_POST, "dureeFilm", FILTER_VALIDATE_INT);
                $noteFilm = filter_input(INPUT_POST, "noteFilm", FILTER_VALIDATE_INT);
                $realisateurFilm =  filter_input(INPUT_POST, "id_realisateurFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $genreFilm = filter_input(INPUT_POST, "genreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //il manque les images

                //ici prépare les films (il manque les images)
                $requeteAddfilm = $pdo->prepare("
                        INSERT INTO film (titre_film, synopsis_film, annee_sortie_film, duree_film,  note_film, id_realisateur, genre_film) 
                        VALUES (:titreFilm, :synopsisFilm, :anneeSortieFilm,  :dureeFilm,  :notefilm, :idRealisateur, :genreFilm)
                        ");

                //On récupère le dernier ID rentré dans la BDD
                $idFilm = $pdo -> lastInsertId();

                $requeteGenreFilm = $pdo->prepare("
                        ");
                $requeteGenreFilm->execute(["id" => $idFilm, "genre" => $genreFilm]);
            }
        header("Location: index.php?action=listFilms");
    }
}//fin controller
