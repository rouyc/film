<?php
    require_once File::build_path(array('model','Model.php'));
    require_once File::build_path(array('model','ModelProgramme.php'));

    class ModelRecherche extends Model

    {

    	public static function getResultat(){
	        $r_acteur ="SELECT P.idProgramme FROM Programme P";
			$r_categorie ="SELECT P.idProgramme FROM Programme P";
			$r_langue = "SELECT P.idProgramme FROM Programme P";
			$r_producteur = "SELECT P.idProgramme FROM Programme P";
			$r_realisateur = "SELECT P.idProgramme FROM Programme P";

			if (isset($_POST['categorie'])){
			    $categorie = $_POST['categorie'];
			    $r_categorie = "SELECT P.idProgramme FROM Programme P 
			    INNER JOIN CategorieProgramme CP ON CP.idProgramme = P.idProgramme
			    INNER JOIN Categorie C ON CP.idCategorie = C.idCategorie
			    WHERE C.nomCategorie = "."'"."$categorie"."'"." ";
			}
			if(isset ($_POST['langue'])){
			    $langue = $_POST['langue'];
			    $r_langue = "SELECT P.idProgramme FROM Programme P 
			                INNER JOIN LangueProgramme LP ON LP.idProgramme = P.idProgramme
			                INNER JOIN Langue L ON L.idLangue = LP.idLangue
			                WHERE L.nomLangue = "."'"."$langue"."'"." ";
			}
			if(isset($_POST['acteur'])){
			    $acteur = explode(' ', $_POST['acteur']);
			    $r_acteur = "SELECT P.idProgramme FROM Programme P 
			                  INNER JOIN ActeurProgramme AP ON AP.idProgramme = P.idProgramme
			                  INNER JOIN Acteur A ON A.idActeur = AP.idActeur
			                  WHERE A.nomActeur = "."'"."$acteur[1]"."'"."
			                    AND A.prenomActeur = "."'"."$acteur[0]"."'"." ";
			}


			if(isset($_POST['producteur'])){
			    $producteur = explode(' ', $_POST['producteur']);
			    $r_producteur = "SELECT P.idProgramme FROM Programme P 
			                    INNER JOIN ProducteurProgramme PP ON PP.idProgramme = P.idProgramme
			                    INNER JOIN Producteur Pr ON PP.idProducteur = Pr.idProducteur
			                    AND Pr.nomProducteur = "."'"."$producteur[1]"."'"."
			                    AND Pr.prenomProducteur = "."'"."$producteur[0]"."'"." ";
			}
			if (isset($_POST['realisateur'])){
			    $realisateur = explode(' ', $_POST['realisateur']);
			    $r_realisateur = "SELECT P.idProgramme FROM Programme P 
			                    INNER JOIN RealisateurProgramme RP ON P.idProgramme = RP.idProgramme
			                    INNER JOIN Realisateur R ON R.idRealisateur = RP.idRealisateur
			                    AND R.nomRealisateur = "."'"."$realisateur[1]"."'"."
			                    AND R.prenomRealisateur = "."'"."$realisateur[0]"."'"." ";
			}
			try{ $rep = Model::$pdo->query("SELECT * FROM Programme P WHERE P.idProgramme IN ("."$r_categorie".")
			                                AND P.idProgramme IN ("."$r_langue".")
			                                AND P.idProgramme IN ("."$r_acteur".")
			                                AND P.idProgramme IN ("."$r_producteur".")
			                                AND P.idProgramme IN ("."$r_realisateur".")");
			}

			catch (PDOException $e) {
			    if (Conf::getDebug()) { echo $e->getMessage();}
			    else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
			    die();
			}

			$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProgramme');
			$tab_resultat = $rep->fetchAll();
			return $tab_resultat;
		}	
	}
?>