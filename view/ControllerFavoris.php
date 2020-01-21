<?php
require_once (File::build_path(array('model','ModelProgramme.php')));
require_once (File::build_path(array('model','ModelPanier.php')));
require_once (File::build_path(array('model','ModelFavoris.php')));
require_once (File::build_path(array('model','ModelUtilisateur.php')));
require_once (File::build_path(array('controller','ControllerAccueil.php')));


class ControllerFavoris
{
    public static function afficherFavoris() {
        $idCompte = ModelUtilisateur::getUtilisateurByEmail($_SESSION['login'])->getIdUtilisateur();
        $tabFav = ModelFavoris::getFavoris($idCompte);
        if (isset($_SESSION['login'])){
            if (ModelUtilisateur::estAdmin($_SESSION['login'])==1) {
                require File::build_path(array('view', 'head.html'));
                require File::build_path(array('view', 'menuConnecteAdmin.html'));
                require File::build_path(array('view', 'afficherFavoris.php'));
                require File::build_path(array('view', 'footer.html'));
            } else {
                require File::build_path(array('view','head.html'));
                require File::build_path(array('view','menuConnecte.html'));
                require File::build_path(array('view','afficherFavoris.php'));
                require File::build_path(array('view','footer.html'));
            }
        }
        else {
            ControllerAccueil::build();
        }
    }

    public static function ajouterFavoris() {
        $idCompte = ModelUtilisateur::getUtilisateurByEmail($_SESSION['login'])->getIdUtilisateur();
        $idProgramme = $_GET['idP'];
        $fav = ModelFavoris::estDansLaBDD($idProgramme,$idCompte);
        if ($fav == 0) {
            ModelFavoris::addFavoris($idProgramme,$idCompte);
            ControllerAccueil::build();
        } else {
            ControllerAccueil::build();
        }
    }

    public static function retirerFavoris() {
        $idCompte = ModelUtilisateur::getUtilisateurByEmail($_SESSION['login'])->getIdUtilisateur();
        $idProgramme = $_GET['id'];
        ModelFavoris::delFavoris($idProgramme,$idCompte);
        ControllerFavoris::afficherFavoris();
    }

}

