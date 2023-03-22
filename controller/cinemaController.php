<?php

//un seul fichier pour le moment également qui contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues 

namespace Controller;

use Model\Connect;

//Mon controlleur (c'est une classe dont on crée des instances)

/** 
 Error: Call to a member function query() on string 
 * Le message signifie que tu appelles la fonction query sur une chaîne de caractères.
* Comme tu l'appelles par $bdd->query($query), cela signifie (si l'erreur est bien à cette ligne) que $bdd est une chaîne, et non pas une connexion à mysql.
* Montrer le code où est définie la variable $bdd ?
*/
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
        $pdo = Connect::seConnecter();
        $requeteFormListReal = $pdo->query("
        SELECT 
             CONCAT(p.prenom_personne,' ',p.nom_personne) as identite, 
             r.id_realisateur
         FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne;
            ");
        
        //Libelle genre
        $pdo = Connect::seConnecter();
        $requeteFormListGenre = $pdo->query("
        SELECT libelle_genre, 
            id_genre
        FROM genre;
            ");

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

// //Formulaire d'ajout des films
//         public function addFilm() {
//             if (isset($_POST['submit'])) {
//                 //Fitrage des données
//                 $pdo = Connect::seConnecter();

//                 //Les filtre pour eviter les failles XSS
//                 $titreFilm = filter_input(INPUT_POST, "titreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//                 $anneeSortieFilm = filter_input(INPUT_POST, "anneeSortieFilm", FILTER_VALIDATE_INT);
//                 $dureeFilm = filter_input(INPUT_POST, "dureeFilm", FILTER_VALIDATE_INT);
//                 $noteFilm = filter_input(INPUT_POST, "noteFilm", FILTER_VALIDATE_INT);
//                 //$realisateurFilm =  filter_input(INPUT_POST, "id_realisateurFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//                 //$genreFilm = filter_input(INPUT_POST, "genreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//                 $afficheFilm = filter_input(INPUT_POST, "afficheFilm", FILTER_VALIDATE_URL);
//                 $synopsisFilm = filter_input(INPUT_POST, "synopsisFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//                 //ici prépare les films
//                 $requeteAddFilm = $pdo->prepare("
//                         INSERT INTO film (titre_film, annee_sortie_film, duree_film,  note_film, id_realisateur, genre_film, affiche_film, affiche_film, synopsis_film,) 
//                         VALUES (:titreFilm, :anneeSortieFilm,  :dureeFilm,  :notefilm, :idRealisateur, :genreFilm, :afficheFilm, :synopsisFilm, )
//                         ");
                
//                 //Après avoir filtrer les champs, il sont vérifiés en vrai ou false
                

//                 //On récupère le dernier ID rentré dans la BDD
//                 $idFilm = $pdo -> lastInsertId();

//                 $requeteGenreFilm = $pdo->prepare("
//                         INSERT INTO appartenir (id_film, id_genre)
//                         VALUES (:id, :genre)
//                         ");
//                 $requeteGenreFilm->execute(["id" => $idFilm, "genre" => $genreFilm]);
//             }
//         header("Location: index.php?action=listFilms");
//    }


}//fin controller
