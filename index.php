<?php

//Appel des controller
use Controller\CinemaController;

//chargement automatique de toutes les classes .php
spl_autoload_register(function ($classname){

    include $classname . '.php';
});

//Récupération de l'id
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

//Définitions des instances
$ctrlCinema = new CinemaController();

//Traitements des différents retours de l'action

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        //film
        case "listFilms" : 
            $ctrlCinema ->listFilms(); break;
        case "detailFilm" :
            $ctrlCinema ->detailFilm($id); break;
    }
}


// public function getActeur($id){
//     $pdo = Connect::seConnecter();
//     $requete = $pdo -> prepare("SELECT * FROM acteur WHERE id_acteur = :id");
//     $requete -> execute(["id" => $id]);
//     require "view/acteur/detailActeur.php";
// }