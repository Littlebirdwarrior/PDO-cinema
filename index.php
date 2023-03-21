<?php

//Appel des controller
use Controller\CinemaController;
use Controller\ActeurController;

//chargement automatique de toutes les classes .php
spl_autoload_register(function ($classname){

    include $classname . '.php';
});

//Récupération de l'id
$id = (isset($_GET["id"])) ? $_GET["id"] : null;//ici, quelque chose ne marche pas

//Définitions des instances
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();

//Traitements des différents retours de l'action

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        //film
        case "listFilms" : 
            $ctrlCinema ->listFilms(); break;
        case "detailFilm" :
            $ctrlCinema ->detailFilm($id); break;//ici quelque chose ne marche pas
            
        //Acteurs
        case "listActeurs":
             $ctrlActeurs-> listActeurs(); break;

        //Realisateurs

        //Roles

        //Casting

        //Genres
    }
}


// public function getActeur($id){
//     $pdo = Connect::seConnecter();
//     $requete = $pdo -> prepare("SELECT * FROM acteur WHERE id_acteur = :id");
//     $requete -> execute(["id" => $id]);
//     require "view/acteur/detailActeur.php";
// }