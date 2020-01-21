<?php


class ModelFavoris extends Model
{

    private $idProgramme;
    private $idUtilisateur;
    protected static $object='favori';
    protected static $primary='idFavori';

    public function getIdProgramme(){return $this->idProgramme;}
    public function getIdUtilisateur(){return $this->idUtilisateur;}

    public static function getFavoris($id){
        try{ $rep = Model::$pdo->prepare("SELECT * FROM Favori WHERE idUtilisateur=:id ");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->execute(array('id' => $id));

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelFavoris');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function estDansLaBDD($idP,$idU) {
        try{ $rep = Model::$pdo->prepare("SELECT * FROM Favori WHERE idUtilisateur=:idU AND idProgramme =:idP ");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }
        $rep->execute(array('idU' => $idU,
                            'idP' => $idP));

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelFavoris');
        $tab_fav = $rep->fetchAll();


        if(sizeof($tab_fav)==0) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function addFavoris($idP,$idU) {
        try {
            $stmt = Model::$pdo->prepare("INSERT INTO Favori (idProgramme,idUtilisateur) VALUES (:idP, :idU)");
        }
        catch (PDOException $e) {
            echo "oui";
        }



        $stmt->execute(array("idP" => $idP,
                             "idU" => $idU));
    }

    public static function delFavoris($idP,$idU) {
        try {
            $stmt = Model::$pdo->prepare("DELETE FROM Favori WHERE idUtilisateur=$idU AND idProgramme =$idP");
        }
        catch (PDOException $e) {
            echo "oui";
        }



        $stmt->execute(array("idP" => $idP,
            "idU" => $idU));
    }

}