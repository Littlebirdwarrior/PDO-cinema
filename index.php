<?php

//Appel des controller
use Controller\CinemaController;
use Controller\ActeurController;
use Controller\RealisateurController;

//chargement automatique de toutes les classes .php
spl_autoload_register(function ($_className){
    require str_replace("\\","/", $_className). ".php";
});

//Récupération de l'id
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

//Définitions des instances
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();

//Traitements des différents retours de l'action (nb, chaque detail a besoin de l'id en param)

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        //film
        case "listFilms" : 
            $ctrlCinema ->listFilms(); break;
        case "detailFilm" :
            $ctrlCinema ->detailFilm($id); break;
        // case "addFilm" 
        //     $ctrlCinema ->addFilm(); break;
            
        //Acteurs
        case "listActeurs":
             $ctrlActeur-> listActeurs(); break;
        case "detailActeur" :
            $ctrlActeur->detailActeur($id); break;
        //Realisateurs
        case "listRealisateurs":
            $ctrlRealisateur-> listRealisateurs(); break;
        case "detailRealisateur":
            $ctrlRealisateur-> detailRealisateur($id); break;
        

        //Roles

        //Casting

        //Genres
    }
}
