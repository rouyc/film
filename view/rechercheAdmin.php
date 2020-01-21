<div class="card">
    <div class="card-content ">
        <div class="row">
            <form method="post" action="index.php?controller=recherche&action=build">
                <div class="s12 l6">
                    <h3 class="center">Recherche d'un programme</h3>
                    <h6 class="center">Programme</h6>
                    <select name="categorie" class="browser-default">
                        <option value="" disabled selected>Choisissez le programme</option>
                        <?php
                        foreach ($tab_programme as $programme) {
                            echo "<option name=" . $programme->getIdProgramme() . ">" . $programme->getTitreProgramme() . "</option>";
                        }?>
                    </select>
                </div>
                
                <?php 
                    if(isset ($_POST['programme'])){echo "Programme actuellement séléctionnée : " . $_POST['programme'] . "<br>";}
                ?>

                <div class="center"> <input type="submit" value="Rechercher"></br></div>
            </form>
        </div>
    </div>
</div>