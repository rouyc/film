<h6 class="center">Langue</h6>
<div class="s12 l6">
    <form action = "index.php?controller=adminProgramme&action=modifLangue&id=<?php echo $_GET["id"]; ?>" method="post">
        <select name="langue[]" multiple>
            <option value="" disabled>Choisissez la langue</option>
            <?php
            foreach ($tab_langue as $langue) {
                if (in_array($langue,$tab_l)){
                    echo "<option name=" . $langue->getIdLangue() . "selected>" . $langue->getNomLangue() . "</option>";
                }
                else{
                    echo "<option name=" . $langue->getIdLangue() . ">" . $langue->getNomLangue() . "</option>";
                }
            }
                ?>
        </select>
    </form>
    <div class="actuel">
        <p> <strong> Langue actuelle : <br/> </strong>
            <?php
            foreach ($tab_l as $l ){
                echo $l->getNomLangue();
            }
            ?></p>
    </div>
</div>