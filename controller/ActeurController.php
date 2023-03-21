<?php
//gere le traitements des requête acteurs

namespace Controller;
use Model\Connect;

class ActeurController {

    public function listActeurs(){
        $pdo = Connect::seConnecter();

        $requeteListActeurs = $pdo->query('
        SELECT 
            p.prenom_personne,
            p.nom_personne,
            p.sexe_personne,
            p.date_naissance_personne 
        FROM 
            acteur a
            INNER JOIN personne  p ON a.id_personne = p.id_personne
        ');
    
    require "view/listActeurs.php";
    }

}