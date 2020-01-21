<!-- Modifier titre -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "index.php?controller=adminProgramme&action=modifTitre&id=<?php echo $_GET["id"]; ?>" method="post">
                Votre titre : <input type = "text" name = "titre"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Titre actuelle : <br/> </strong> 
                    <?php
                        echo $titre;
                    ?></p>
            </div>
         </div>
    </div>
</div>