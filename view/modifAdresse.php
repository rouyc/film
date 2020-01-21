<!-- Modifier adresse -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "../www/index.php?controller=utilisateur&action=modifAdresse&id=<?php echo $idUtilisateur; ?>" method="post">
                Nouvelle adresse : <input type = "text" name = "adresse"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Adresse actuelle : </strong> <?php
                    echo $adresse;
                    ?></p>
            </div>
            <br/>
         </div>
    </div>
</div>