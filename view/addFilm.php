<?php
ob_start();
?>

<?php
//mes requetes
$fetchGenres = $requeteGenresFilm->fetchAll();
$fetchReals = $requeteRealsFilm->fetchAll();
?>

<form action="index.php?action=addFilm" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
    <p>
        <label>
            Titre :
            <input type="text" set="any" name="titreFilm" placeholder="Titre du film" required/>
        </label>
    </p>
    <p>
        <label>
            Année de sortie :
            <input type="number" set="any" name="anneeSortieFilm" min="1920" max="2030" placeholder="2023" required/>
        </label>
    </p>
    <p>
        <label>
            Durée (en minutes):
            <input type="number" set="any" min="30" max="360" name="dureeFilm" placeholder="120" required/>
        </label>
    </p>
    <p>
        <label>
            Note:
            <input type="number" set="any" min="0" max="5" name="noteFilm" required/>/5
        </label>
    </p>
    <p>
        <label>
            URL de l'Affiche :
            <input type="text" name="afficheFilm" placeholder="Collez votre url" required/>
        </label>
    </p>
    <p>
        <label>
            Synopsys :<br>
            <textarea name="synopsisFilm" rows="5" required></textarea>
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
    <p>
    <fieldset>
        <legend>Genres</legend>
        <?php
        //les [] après le name permettent de mettre les données dans un tableau
        foreach ($fetchGenres as $genre) {
            echo '<input type="checkbox" name="idGenre[]" value="'. $genre['id_genre'].'"/>' . $genre['libelle_genre'] . '<br/>';
        }
        //traitement de la valeur des checkbox
        if(isset($_POST['idGenre']))//si la calse est cochée
            {
            foreach($_POST['idGenre'] as $valeur)//et pour chaque case cochée, je crée une valeur(ici id en value)
            {
                echo $valeur ."<br>";//recupere la valeur dans le post
            }
            }
        ?>

    </fieldset>
    </p>
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
