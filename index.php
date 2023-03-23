<?php

//Appel des controller
use Controller\CinemaController;
use Controller\ActeurController;

//chargement automatique de toutes les classes .php
spl_autoload_register(function ($_className){
    require str_replace("\\","/", $_className). ".php";
});

//Récupération de l'id
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

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
            $ctrlCinema ->detailFilm($id); break;
        // case "addFilm" :
        //     $ctrlCinema ->addFilm(); break;
            
        //Acteurs
        case "listActeurs":
             $ctrlActeur-> listActeurs(); break;
        case "detailActeur" :
            $ctrlActeur-> detailActeur($id); 
        break;

        //Realisateurs

        //Roles

        //Casting

        //Genres
    }
}
