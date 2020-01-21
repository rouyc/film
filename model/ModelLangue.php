<?php
require_once File::build_path(array('model','Model.php'));

class ModelLangue extends Model
{
    private $idLangue;
    private $nomLangue;
    protected static $object='langue';
    protected static $primary='idLangue';

    public function getIdLangue()
    {
        return $this->idLangue;
    }

    public function getNomLangue()
    {
        return $this->nomLangue;
    }

    public static function getLangueById($idProgramme){

        try{ $rep = Model::$pdo->prepare("SELECT * FROM Langue L
                                            INNER JOIN LangueProgramme LP ON L.idLangue = LP.idLangue
                                            INNER JOIN Programme P ON P.idProgramme = LP.idProgramme
                                            WHERE P.idProgramme =:idProgramme");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->execute(array('idProgramme' => $idProgramme));

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelLangue');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }


    public static function afficherLangue($tab){
        foreach ($tab as $element) {
            echo "<p>" . $element->getNomLangue() . " </p>";
        }
    }

    public static function addLangueProgramme($idProgramme,$langue){
        foreach ($langue as $l1) {
            $langue_bis = ModelLangue::selectByAttribut("nomLangue",$l1);
            $idLangue = $langue_bis[0]->getIdLangue();
            try {
                $stmt = Model::$pdo->prepare("INSERT INTO LangueProgramme (idProgramme,idLangue) VALUES (:idProgramme, :idLangue)");
            } catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $stmt->execute(array('idProgramme' => $idProgramme, 'idLangue' => $idLangue));
        }

    }
}
?>