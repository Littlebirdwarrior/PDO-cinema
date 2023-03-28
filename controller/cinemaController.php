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
        $requeteListFilms = $pdo->query("
        SELECT
            film.id_realisateur,
            film.id_film,
            film.titre_film,
            film.annee_sortie_film,
            TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), '%H:%i') AS duree_film,
            CONCAT(personne.prenom_personne, ' ', personne.nom_personne) AS nomReal,
            film.note_film
        FROM
            film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ORDER BY
            annee_sortie_film DESC
        ");

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
            film.id_realisateur,
            CONCAT(prenom_personne, " ", nom_personne) AS nomReal,
            film.affiche_film,
            film.note_film
        FROM
            film
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE
            film.id_film = :id
        GROUP BY
            film.id_film
            ');
        $requeteDetailFilm->execute(["id" => $id]);

        // Afficher le Casting
        $pdo = Connect::seConnecter();
        $requeteDetailCasting = $pdo->prepare('
        SELECT
            c.id_acteur,
            CONCAT(p.prenom_personne," ",p.nom_personne) as nomAct, 
            r.nom_role
        from casting c
            INNER JOIN acteur a ON c.id_acteur = a.id_acteur
            INNER JOIN personne p ON a.id_personne = p.id_personne
            INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_film = :id
        ORDER BY nomAct
        ');
        $requeteDetailCasting->execute(["id" => $id]);

        /**Prépare une requête SQL à être exécutée par la méthode PDOStatement::execute(). 
         * Le modèle de déclaration peut contenir zéro ou plusieurs paramètres nommés (:nom) ou marqueurs (?). 
         * Ces paramètres sont utiliser pour pour lier les entrées utilisateurs. */

        // Afficher tous les genres
        $pdo = Connect::seConnecter();
        $requeteDetailGenre = $pdo->prepare("
        SELECT
            gf.id_film,
            gf.id_genre,
            g.libelle_genre
        FROM 
            genre_film gf
            INNER JOIN genre g ON gf.id_genre = g.id_genre
        WHERE gf.id_film = :id
        ");

        $requeteDetailGenre->execute(["id" => $id]);

        require "view/detailFilm.php";
    }

    //Formulaire d'ajout des films
    public function addFilm()

    {
        //Connexion BDD
        $pdo = Connect::seConnecter();

        //*Afficher les genres
        //Lister id et nom de la table genre (nom_genre: genre_film -> genre)
        $requeteGenresFilm = $pdo->query("
        SELECT DISTINCT
            g.id_genre,
            g.libelle_genre
        FROM
            genre g
        ");

        //*Afficher les realisateurs
        //Lister id_real et nom de la table film (nom et prenom : realisateur -> personne)
        $requeteRealsFilm = $pdo->query("
        SELECT DISTINCT
            r.id_realisateur,
            p.nom_personne,
            p.prenom_personne
        FROM
            realisateur r
            INNER JOIN film f ON f.id_realisateur = r.id_realisateur
            INNER JOIN personne p ON p.id_personne = r.id_personne
        ");

        if (isset($_POST['submitFilm'])) {

            //*Ajouter un film
            //Fitrage des données
            //Les filtre pour eviter les failles XSS
            $titreFilm = filter_input(INPUT_POST, "titreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortieFilm = filter_input(INPUT_POST, "anneeSortieFilm", FILTER_VALIDATE_INT); //convertis tous en int
            $dureeFilm = filter_input(INPUT_POST, "dureeFilm", FILTER_VALIDATE_INT);
            $noteFilm = filter_input(INPUT_POST, "noteFilm", FILTER_VALIDATE_INT);
            $afficheFilm = filter_input(INPUT_POST, "afficheFilm", FILTER_VALIDATE_URL);
            $synopsisFilm = filter_input(INPUT_POST, "synopsisFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //sanitize moins sévère que le validate, filtre mais ne remplace pas
            //Les id récuperer dans le checkbox et les select
            $idRealisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_VALIDATE_INT);

            // var_dump($titreFilm, $anneeSortieFilm, $dureeFilm, $noteFilm, $synopsisFilm, $afficheFilm, $idRealisateur); die;

            //ici prépare les films
            $requeteAddFilm = $pdo->prepare("
                INSERT INTO film (
                    titre_film, 
                    annee_sortie_film, 
                    duree_film,  
                    synopsis_film,
                    note_film, 
                    affiche_film, 
                    id_realisateur
                    ) 
                VALUES (
                    :titreFilm, 
                    :anneeSortieFilm,  
                    :dureeFilm,  
                    :synopsisFilm,
                    :noteFilm, 
                    :afficheFilm, 
                    :idRealisateur
                    )
                ");

            $requeteAddFilm->execute([
                "titreFilm" => $titreFilm,
                "anneeSortieFilm" => $anneeSortieFilm,
                "dureeFilm" => $dureeFilm,
                "synopsisFilm" => $synopsisFilm,
                "noteFilm" => $noteFilm,
                "afficheFilm" => $afficheFilm,
                "idRealisateur" => $idRealisateur
            ]);

            //*recupérer Genre (tableau checkbox)
            //Soucre : https://apcpedagogie.com/recuperer-les-valeurs-des-checkbox-avec-php/

            //Après aver vérifié si les checkbox sont cochée : cf view addFilm
            //Ce filtre convertis les string en int 
            $idGenres = filter_input(INPUT_POST, "idGenres", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            //On récupère le dernier ID film rentré dans la BDD
            $idFilm = $pdo->lastInsertId();
            
            //var_dump($_POST); die;

            $requeteAddGenres = $pdo->prepare("
            INSERT INTO genre_film (id_film, id_genre)
            VALUES (:idFilm, :idGenre)
            ");

            //Ici, je fais une boucle pour envoyé l'idGenre 
            foreach($idGenres as $idGenre) {
                $requeteAddGenres->execute([
                    "idFilm" => $idFilm,
                    "idGenre" => $idGenre
            ]);
            }
        }

        require "view/addFilm.php";
    }
}//fin controller
