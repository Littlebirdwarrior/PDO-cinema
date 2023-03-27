<?php

namespace Controller;
use Model\Connect;

class CastingController {
    public function addCasting(){

        if (isset($_POST['submitCasting'])){

            //Connexion BDD
            $pdo = Connect::seConnecter();

            //filtre
            $roleId = filter_input(INPUT_POST, "roleId", FILTER_VALIDATE_INT);
            $acteurId = filter_input(INPUT_POST, "acteurId", FILTER_VALIDATE_INT);
            $filmId = filter_input(INPUT_POST, "filmId", FILTER_VALIDATE_INT);

            //Preparation requete en ciblant casting
            $addCastingRequest = $pdo ->prepare("
            INSERT INTO casting (id_film, id_role, id_acteur) 
            VALUES(:filmId, :roleId, :acteurId)
            ");

            $addCastingRequest->execute([
                "roleId" => $roleId,
                "acteurId" => $acteurId,
                "filmId" => $filmId,
            ]);
        }  

        //j'affiche vers le bonne page
        require 'view/addCasting.php';

    }

}