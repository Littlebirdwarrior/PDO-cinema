<?php
ob_start();
?>

    <!---Compte des films-->
    <p>Il y a <?=$requeteListActeurs-> rowCount()?> acteurs</p>

    <section>
        
        <div>

        <?php
        //Boucle  sur chaque acteur
        foreach ($requeteListActeurs->result() as $acteur) {
            echo '
            
            
            
            
            ';
        }
        ?>
        </div>

    </section>