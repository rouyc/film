<!-- Modifier duree -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "index.php?controller=adminProgramme&action=modifDuree&id=<?php echo $_GET["id"]; ?>" method="post">
                Duree : <input type = "text" name = "duree"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Durée actuelle : <br/> </strong> 
                    <?php
                        echo $duree;
                    ?></p>
            </div>
         </div>
    </div>
</div>