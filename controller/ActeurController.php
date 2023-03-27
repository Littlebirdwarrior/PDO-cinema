<?php
//gere le traitements des requête acteurs

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteListActeurs = $pdo->query("
        SELECT
        a.id_acteur,
        CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
        p.sexe_personne,
        DATE_FORMAT(date_naissance_personne, '%d/%m/%Y') AS date_naissance,
        DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_naissance_personne)), '%Y') + 0 AS age
    FROM
        acteur a
        INNER JOIN personne p ON p.id_personne = a.id_personne
    GROUP BY
        a.id_acteur
    ORDER BY
        p.nom_personne,
        date_naissance_personne
        ");

        require "view/listActeurs.php";
    }

    //Détail Acteurs
    public function detailActeur($id){
    //Identité et filmographie, 2 requetes différentes pour plus de clareté
        // Identité
        $pdo = Connect::seConnecter();
        $requeteDetailActeur = $pdo->prepare("
        SELECT
            a.id_acteur,
            CONCAT(p.prenom_personne, ' ', p.nom_personne) AS nomAct,
            DATE_FORMAT(p.date_naissance_personne, '%d/%m/%Y') AS date_naissance,
            DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_naissance_personne)), '%Y') + 0 AS age,
            p.sexe_personne
        FROM
            personne p
            INNER JOIN acteur a ON p.id_personne = a.id_personne
        WHERE
        a.id_acteur = :id
        ");
        $requeteDetailActeur->execute(['id' => $id]);

        // Filmographie (le film et le role de l'acteur)
        $requeteFilmographie = $pdo->prepare("
        SELECT
            film.id_film,
            film.titre_film,
            role.nom_role,
            film.annee_sortie_film
        FROM
            casting
            INNER JOIN film ON casting.id_film = film.id_film
            INNER JOIN ROLE ON casting.id_role = role.id_role
        WHERE
            casting.id_acteur = :id
        ORDER BY
            film.annee_sortie_film DESC
        ");
        $requeteFilmographie->execute(["id" => $id]);
        
        require "view/detailActeur.php";

    }



    public function addActeur(){
        
        if (isset($_POST['submitActeur'])){

        // //test des données créées
        // var_dump($_POST);
        // die;

        //se connecte à la base de données à l'aide d'un objet PDO.
        $pdo = Connect::seConnecter();

        //je filtre les données pour éviter les attaques par injection de code malveillant
        $prenom = filter_input(INPUT_POST, "prenomAct", FILTER_SANITIZE_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, "nomAct", FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = $_POST["sexeAct"];
        $dateNaissance = $_POST["dateNaissanceAct"];

        //récupérer l'identifiant auto-incrémenté généré pour la nouvelle ligne insérée dans la table personne
        //nb (un acteur a 2 id, l'id_acteur et l'id_personne)
        $last_insert_id = $pdo->lastInsertId();

        //Je prépare la requete sql en ciblant la bonne table
        /*la requête SQL est préparée pour insérer les données filtrées 
        dans la table personne. La requête utilise les marqueurs de paramètres (:prenom, :nom, :sexe, :dateNaissance et :type) 
        pour éviter les attaques par injection SQL. 
        La valeur :type est toujours définie sur "acteur". Mais je l'enlève car cela ne marche pas* */
        $addPersonneRequest = $pdo->prepare("
            INSERT INTO personne (id_personne, prenom_personne, nom_personne, sexe_personne, date_naissance_personne )
            VALUES (:personneID, :prenomAct, :nomAct, :sexeAct, :dateNaissanceAct)
        ");

        // var_dump($_POST); die;

        //exécuter la requête préparée et insérer les données dans la table personne
        $addPersonneRequest->execute([
            "personneID" => $last_insert_id,
            "prenomAct" => $prenom,
            "nomAct" => $nom,
            "sexeAct" => $sexe,
            "dateNaissanceAct" => $dateNaissance,
        ]);

        //récupérer l'identifiant auto-incrémenté généré pour la nouvelle ligne insérée dans la table acteur
        $last_insert_id = $pdo->lastInsertId();

        /*une seconde requête SQL est préparée pour insérer l'identifiant de la nouvelle personne dans 
        la table actor. Cette requête utilise un marqueur de paramètre (:acteurID) pour éviter les attaques par injection SQL.*/
        $addActeurRequest = $pdo->prepare("
            INSERT INTO acteur (id_acteur, id_personne) 
            VALUES (:acteurID, :personneID)
        ");
        /**La méthode execute() est utilisée pour exécuter la requête préparée et insérer l'identifiant de la personne nouvellement créée dans la table actor. */
        $addActeurRequest->execute([
            "personneID" => $last_insert_id,
            "acteurID" => $last_insert_id,
        ]);

        }

        //je redirige vers le bonne page
        require 'view/addActeur.php';
        
    }


}