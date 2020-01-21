<!-- Modifier date de naissance -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "../www/index.php?controller=utilisateur&action=modifDate&id=<?php echo $idUtilisateur; ?>" method="post">
                Nouvelle date de naissance : <input type = "date" name = "date"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Date actuel : </strong> <?php
                    echo $date;
                    ?></p>
            </div>
            <br/>
         </div>
    </div>
</div>