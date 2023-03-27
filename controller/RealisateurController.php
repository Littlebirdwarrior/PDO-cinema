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
            DATE_FORMAT(date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_naissance_personne)), '%Y') + 0 AS age
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
            DATE_FORMAT(date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_naissance_personne)), '%Y') + 0 AS age
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

    public function addRealisateur(){
        
        if (isset($_POST['submitReal'])){

        $pdo = Connect::seConnecter();

        var_dump($_POST);

        //je filtre les données pour éviter les attaques par injection de code malveillant
        $prenom = filter_input(INPUT_POST, "prenomReal", FILTER_SANITIZE_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, "nomReal", FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = $_POST["sexeReal"];
        $dateNaissance = $_POST["dateNaissanceReal"];

        //Je prépare la requete sql en ciblant la bonne table
        $addPersonneRequest = $pdo->prepare("
            INSERT INTO personne ( prenom_personne, nom_personne, sexe_personne, date_naissance_personne )
            VALUES (:prenomReal, :nomReal, :sexeReal, :dateNaissanceReal)
        ");

        //exécuter la requête préparée et insérer les données dans la table personne
        $addPersonneRequest->execute([
            "prenomReal" => $prenom,
            "nomReal" => $nom,
            "sexeReal" => $sexe,
            "dateNaissanceReal" => $dateNaissance,
        ]);

        //fonction pour récupérer le dernier l'identifiant dans personne par auto-incrementation
        $last_insert_id = $pdo->lastInsertId();


        /*une seconde requête SQL est préparée pour insérer l'identifiant de la nouvelle personne dans 
        la table realisateur */
        $addRealRequest = $pdo->prepare("
            INSERT INTO acteur (id_personne) 
            VALUES (:personneId)
        ");
        /** exécuter la requête préparée et insérer l'identifiant. */
        $addRealRequest->execute([
            "personneId" => $last_insert_id,
        ]);

        }

        //je redirige vers le bonne page
        require 'view/addRealisateur.php';
        
    }





}