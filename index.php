<?php

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        //film
        case "listFilms" : $ctrlCinema ->listFilms(); break;
        case "detailFilm" : $ctrlCinema ->detailFilm($id); break;
    }
}


public function getActeur($id){
    $pdo = Connect::seConnecter();
    $requete = $pdo -> prepare("SELECT * FROM acteur WHERE id_acteur = :id");
    $requete -> execute(["id" => $id]);
    require "view/acteur/detailActeur.php";
}