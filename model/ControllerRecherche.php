<?php

    require_once (File::build_path(array('model','ModelCategorie.php')));
    require_once (File::build_path(array('model','ModelLangue.php')));
    require_once (File::build_path(array('model','ModelRealisateur.php')));
    require_once (File::build_path(array('model','ModelProducteur.php')));
    require_once (File::build_path(array('model','ModelActeur.php')));
    require_once (File::build_path(array('model','ModelProgramme.php')));
    require_once (File::build_path(array('model','ModelRecherche.php')));



class ControllerRecherche{

        public static function build() {
            $tab_categorie = ModelCategorie::getAll();
            $tab_realisateur = ModelRealisateur::getAll();
            $tab_acteur = ModelActeur::getAll();
            $tab_producteur = ModelProducteur::getAll();
            $tab_langue = ModelLangue::getAll();
            $tab_programme = ModelProgramme::getAll();
            $tab_res = ModelRecherche::getResultat();

            if (isset($_SESSION['login'])){
                require File::build_path(array('view','head.html'));
                require File::build_path(array('view','menuConnecte.html'));
                require File::build_path(array('view','recherche.php'));
                require File::build_path(array('view','resultat.php'));
                require File::build_path(array('view','footer.html'));
            }
            else {
                require File::build_path(array('view','head.html'));
                require File::build_path(array('view','menu.html'));
                require File::build_path(array('view','recherche.php'));
                require File::build_path(array('view','resultat.php'));
                require File::build_path(array('view','footer.html'));
            }

        }
    }
?>