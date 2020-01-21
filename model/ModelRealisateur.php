<?php
require_once File::build_path(array('model','Model.php'));

class ModelRealisateur extends Model
{
    private $idRealisateur;
    private $nomRealisateur;
    private $prenomRealisateur;
    protected static $object='realisateur';
    protected static $primary='idRealisateur';

    public function getIdRealisateur()
    {
        return $this->idRealisateur;
    }

    public function getNomRealisateur()
    {
        return $this->nomRealisateur;
    }

    public function getPrenomRealisateur()
    {
        return $this->prenomRealisateur;
    }

    public static function getRealisateurById($idProgramme){

        try{ $rep = Model::$pdo->query("SELECT * FROM Realisateur R
                                            INNER JOIN RealisateurProgramme RP ON R.idRealisateur = RP.idRealisateur
                                            INNER JOIN Programme P ON P.idProgramme = RP.idProgramme
                                            WHERE P.idProgramme =". $idProgramme ." ");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelRealisateur');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function afficherRealisateur($tab){
        foreach ($tab as $element) {
            echo "<p>" . $element->getPrenomRealisateur() . " " . $element->getNomRealisateur() . " </p>";
        }
    }

    public static function getRealisateurByNom($nomRealisateur){

        try{ $rep = Model::$pdo->prepare("SELECT * FROM Realisateur
                                            WHERE nomRealisateur = :nomRealisateur");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->execute(array('nomRealisateur' => $nomRealisateur));

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelRealisateur');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function addRealisateurProgramme($idProgramme,$realisateur){
        foreach ($realisateur as $r1) {
            $r1=explode(" ", "$r1");
            $realisateur_bis = ModelRealisateur::selectByAttribut("nomRealisateur",$r1[1]);
            $idRealisateur = $realisateur_bis[0]->getIdRealisateur();
            try {
                $stmt = Model::$pdo->prepare("INSERT INTO RealisateurProgramme (idRealisateur,idProgramme) VALUES (:idRealisateur, :idProgramme)");
            } catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $stmt->execute(array('idRealisateur' => $idRealisateur, 'idProgramme' => $idProgramme));
        }

    }
}
?>