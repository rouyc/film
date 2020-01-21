<!-- Modifier pays -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "index.php?controller=adminProgramme&action=modifPays&id=<?php echo $_GET["id"]; ?>" method="post">
                Pays : <input type = "text" name = "pays"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Pays actuelle : <br/> </strong> 
                    <?php
                        echo $pays;
                    ?></p>
            </div>
         </div>
    </div>
</div>