<?php
ob_start();
?>

<?php
//mes requetes
//$fetchGenres = $requeteGenresFilm->fetchAll();
$fetchReals = $requeteRealsFilm->fetchAll();
?>

<form action="index.php?action=addFilm" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
    <p>
        <label>
            Titre :
            <input type="text" name="titreFilm" placeholder="Titre du film">
        </label>
    </p>
    <p>
        <label>
            Année de sortie :
            <input type="number" set="any" name="anneeSortieFilm" min="1920" max="2030" placeholder="2023">
        </label>
    </p>
    <p>
        <label>
            Durée (en minutes):
            <input type="number" set="any" min="0" max="360" name="dureeFilm" placeholder="120">
        </label>
    </p>
    <p>
        <label>
            Note:
            <input type="number" set="any" min="0" max="5" name="noteFilm">/5
        </label>
    </p>
    <p>
        <label>
            URL de l'Affiche :
            <input type="text" name="afficheFilm" placeholder="Collez votre url">
        </label>
    </p>
    <p>
        <label>
            Synopsys :
            <textarea name="synopsysFilm" rows="5"></textarea>
        </label>
    </p>
    <!-------->
    <p>
        <label>
            Réalisateur
            <select name="idRealisateur" required>
                <option selected disabled>Choississez votre réalisateur</option>
                <?php
                //Affichage des films
                foreach ($fetchReals  as $real) {
                    echo "<option value=" . $real['id_realisateur'] . ">" . $real['nom_personne'] . ' ' . $real['prenom_personne'] . "</option>";
                }
                ?>
            </select>
        </label>
    </p>
    <!-------->
    <!---<fieldset>
                <legend>Genres</legend>
                <?php
                //foreach($fetchGenres as $genre){
                //echo '<input type="checkbox" name="nomGenre" value="'.$genre['id_genre'].'"/>';
                //}
                ?>
                
            </fieldset>--->

    <!----attribut "name" qui permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.------>
    <input class="" type="submit" name="submitFilm">

</form>

<div class="control">
    <a href="index.php?action=listFilms">Retour à la liste des films</a>
</div>


<?php
$titre = "Ajouter un film";
$titre_secondaire = "Ajouter un film à votre BDD";
$contenu = ob_get_clean();
require "view/template.php";
