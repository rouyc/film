<div class="card">
    <div class="card-content ">
        <div class="row">
            <form method="post" action="index.php?controller=recherche&action=build">
                <div class="s12 l6">
                    <h3 class="center">Recherche d'un programme</h3>
                    <h6 class="center">Catégorie</h6>
                    <select name="categorie" class="browser-default">
                        <option value="" disabled selected>Choisissez la catégorie</option>
                        <?php
                        foreach ($tab_categorie as $categorie) {
                            echo "<option id=" . $categorie->getIdCategorie() . "c" . ">" . $categorie->getNomCategorie() . "</option>";
                        }?>
                    </select>
                </div>
                <?php if(isset ($_POST['categorie'])){echo "Catégorie actuellement séléctionnée : " . $_POST['categorie'] . "<br>";}?>
                <h6 class="center">Langue</h6>
                <div class="s12 l6">
                    <select name="langue" class="browser-default">
                        <option value="" disabled selected>Choisissez la langue</option>
                        <?php
                        foreach ($tab_langue as $langue) {
                            echo "<option id=" . $langue->getIdLangue() . "l" . ">" . $langue->getNomLangue() . "</option>";
                        }?>
                    </select>
                </div>
                <?php if(isset ($_POST['langue'])){ echo "Langue actuellement séléctionnée : " . $_POST['langue'] . "<br>";}?>
                <h6 class="center">Acteur</h6>
                <div class="s12 l6">
                    <select name="acteur" class="browser-default">
                        <option value="" disabled selected>Choisissez un acteur</option>
                        <?php
                        foreach ($tab_acteur as $acteur) {
                            echo "<option id=" . $acteur->getIdActeur() . "a" . ">" . $acteur->getPrenomActeur() . " " . $acteur->getNomActeur() . "</option>";
                        }?>
                    </select>
                </div>
                <?php if(isset ($_POST['acteur'])){ echo "Acteur actuellement séléctionnée : " . $_POST['acteur'] . "<br>";}?>
                <h6 class="center">Producteur</h6>
                <div class="s12 l6">
                    <select name="producteur" class="browser-default">
                        <option value="" disabled selected>Choisissez un producteur</option>
                        <?php
                        foreach ($tab_producteur as $producteur) {
                            echo "<option id=" . $producteur->getIdProducteur() . "p" . ">" . $producteur->getPrenomProducteur() . " " . $producteur->getNomProducteur() . "</option>";
                        }?>
                    </select>
                </div>
                <?php
                if(isset ($_POST['producteur'])){echo "Producteur actuellement séléctionnée : " . $_POST['producteur'] . "<br>";}?>
                <h6 class="center">Réalisateur</h6>
                <div class="s12 l6">
                    <select name="realisateur" class="browser-default">
                        <option value="" disabled selected>Choisissez un réalisateur</option>
                        <?php
                        foreach ($tab_realisateur as $realisateur) {
                            echo "<option id=" . $realisateur->getIdRealisateur() . "r". ">" . $realisateur->getPrenomRealisateur() . " " . $realisateur->getNomRealisateur() . "</option>";
                        }?>
                    </select>
                </div>
                <?php if(isset ($_POST['realisateur'])){echo "Réalisateur actuellement séléctionnée : " . $_POST['realisateur'] . "<br><br>";}?>
                <div class="center"> <input type="submit" value="Rechercher"></div>

            </form>
        </div>
    </div>
</div>