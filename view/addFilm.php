<?php
ob_start();

//mes requetes
$fetchGenres = $requeteGenresFilm->fetchAll();
echo 'test3'; die;
?>

<form action="index.php?action=addFilm" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->

            <label>
                Titre :
                <input type="text" name="titreFilm">
            </label>

            <label>
                Année de sortie :
                <input type="number" set="any" name="anneeSortieFilm">
            </label>

            <label>
                Durée :
                <input type="number" set="any" name="dureeFilm">
            </label>
            <label>
                Note :
                <input type="number" set="any" name="noteFilm">
            </label>
            <label>
                URL de l'Affiche :
                <input type="text" name="afficheFilm">
            </label>

            <label>
                Synopsys :
                <textarea name="synopsysFilm" rows="5"></textarea>
            </label>
            <fieldset>
                <legend>Genres</legend>
                <?php 
                foreach($fetchGenres as $genre){
                        echo '<input type="checkbox" name="nomGenre" value="'.$genre['id_genre'].'"/>';
                    }
                ?>
                <input type="checkbox" name="nomGenre" value=""/>
            </fieldset>

            <!----attribut "name" qui permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.------>
            <input class="" type="submit" name="submitFilm">

    </form>
    
    <div class="control">
    <a href="index.php?action=listFilms">Retour à la liste des films</a>
    </div>


<?php
$titre = "Ajouter un film";
$titre_secondaire= "Ajouter un film à votre BDD";
$contenu = ob_get_clean();
require "view/template.php";