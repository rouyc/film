<!-- Netclix -->
<div class="card">
    <div class="card-content center">
        <div class="row">
        <p> Programmes : </p>
        <?php
        foreach ($tab_programme as $res) {
            $img = $res->getUrlImageProgramme();
            echo "<div class=\"col s12 l6\">
                    <div class=\"card\">
                        <div class=\"card-content center\">
                        <h5>" . $res->getTitreProgramme() . "</h5><br> ";
            if ($img!=""){
                echo "<img alt=\"imageProgramme\" style=\"width: 50%;\" src=\"$img\">" . '<br>';
            }
            echo 'Synopsis :  ' . $res->getDescriptionProgramme() . '<br> Durée du film : ' . $res->getDureeProgramme() . '<br> Pays du film : ' . $res->getPaysProgramme() . '<br> Prix : ' . $res->getPrixProgramme() . '€ <br>';
            echo '<div class="card">
                            <div class="card-content center"> Acteurs : <div>';
            echo ModelActeur::afficherActeur(ModelActeur::getActeurById($res->getIdProgramme()));
            echo "    </div>
                        </div>
                      </div>";
            echo "<div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Producteur(s) :";
            echo ModelProducteur::afficherProducteur(ModelProducteur::getProducteurById($res->getIdProgramme()));
            echo "    </div>
                        </div>
                      </div>";
            echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Realisateur(s) :";
            echo ModelRealisateur::afficherRealisateur(ModelRealisateur::getRealisateurById($res->getIdProgramme()));
            echo "    </div>
                        </div>
                      </div>";
            echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Categorie(s) :";
            echo ModelCategorie::afficherCategorie(ModelCategorie::getCategorieById($res->getIdProgramme()));
            echo "    </div>
                        </div>
                      </div>";
            echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Langues : ";
            echo ModelLangue::afficherLangue(ModelLangue::getLangueById($res->getIdProgramme()));
            echo "    </div>
                        </div>
                      </div>";
            echo "<a class=\"waves-effect waves-light btn-floating yellow\" href=\"index.php?controller=favoris&action=ajouterFavoris&idP=" . $res->getIdProgramme() . "\"><i class=\"material-icons\">star</i></a>";
            echo "
                <a class=\"btn waves-effect waves-light black\" href=\"index.php?controller=panier&action=ajouterPanier&id=" . $res->getIdProgramme() . "\">Ajouter au panier<i class=\"material-icons right\">add_shopping_cart</i></a> 
                </div>
            </div>
            </div>";
        }
        ?>
        </div>       
    </div>
</div>