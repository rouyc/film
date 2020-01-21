<?php 

require_once File::build_path(array('model','Model.php'));
require_once File::build_path(array('lib','Security.php'));
    
    class ModelCompte extends Model
    {
        private $idUtilisateur;
        private $nomUtilisateur;
        private $prenomUtilisateur;
        private $dateNaissanceUtilisateur;
        private $emailUtilisateur;
        private $mdp;
        private $adresseUtilisateur;
        private $telephoneUtilisateur;
        private $admin;
        private $nonce;
        private $Valide;
        protected static $object='utilisateur';
        protected static $primary='idUtilisateur';

        public function getIdUtilisateur()
        {
            return $this->idUtilisateur;
        }

        public function getNomUtilisateur()
        {
            return $this->nomUtilisateur;
        }
        public function getPrenomUtilisateur()
        {
            return $this->prenomUtilisateur;
        }
        public function getDateNaissanceUtilisateur()
        {
            return $this->dateNaissanceUtilisateur;
        }
        public function getEmailUtilisateur()
        {
            return $this->emailUtilisateur;
        }
        public function getMdp()
        {
            return $this->mdp;
        }
        public function getAdresseUtilisateur()
        {
            return $this->adresseUtilisateur;
        }
        public function getTelephoneUtilisateur()
        {
            return $this->telephoneUtilisateur;
        }
        public function getBoolAdmin()
        {
            return $this->admin;
        }
        public function getNonce(){
            return $this->nonce;
        }
        public function getValide(){
            return $this->Valide;
        }

        public static function getAllCompteByID($idCompte) {
            try{ $rep = Model::$pdo->query("SELECT * FROM Utilisateur U WHERE idUtilisateur = $idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) { echo $e->getMessage();}
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
            $tab_UByID = $rep->fetchAll();
            return $tab_UByID[0];
        }

        public static function estDansLaBDD($email) {
            $tab_U = self::getAllCompte();
            $t = true;
            foreach ($tab_U as $utilisateur) {
                if (strcmp($utilisateur->getEmailUtilisateur(),$email)==0) {
                    $t = false;
                }
            }
            return $t;
        }

        public static function getCompteByEmail($email){
            try {
                $rep = Model::$pdo->query("SELECT * FROM Utilisateur
                                                WHERE emailUtilisateur= \"" . $email . "\" ");
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
            $tab_article = $rep->fetchAll();
            return $tab_article[0];
        }
        public static function getBoolByEmail($email){
            try{ $rep = Model::$pdo->query("SELECT admin FROM Utilisateur U
                                            WHERE U.emailUtilisateur = \" " . $email . "\""  );}

            catch (PDOException $e) {
                if (Conf::getDebug()) { echo $e->getMessage();}
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
            $tab_article = $rep->fetchAll();

            return $tab_article;
        }




        public static function addCompte($nomUtilisateur, $prenomUtilisateur, $dateNaissanceUtilisateur, $emailUtilisateur, $mdp, $mdp1, $adresseUtilisateur, $telephoneUtilisateur, $bool_admin)
        {


            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueurMax = strlen($caracteres);
            $chaineAleatoire = '';
            for ($i = 0; $i < 10; $i++) {
                $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
            }




            if (self::estDansLaBDD($emailUtilisateur)) {
                if (strcmp($mdp, $mdp1) == 0) {
                    $mdp_chiffre = Security::chiffrer($mdp);
                    try {
                        $stmt = Model::$pdo->prepare("INSERT INTO Utilisateur (nomUtilisateur,prenomUtilisateur,dateNaissanceUtilisateur,emailUtilisateur,mdp,adresseUtilisateur,telephoneUtilisateur, admin, nonce) VALUES ('$nomUtilisateur','$prenomUtilisateur','$dateNaissanceUtilisateur','$emailUtilisateur','$mdp_chiffre','$adresseUtilisateur','$telephoneUtilisateur','$bool_admin','$chaineAleatoire')");

                    } catch (PDOException $e) {
                        echo $e->getMessage(); // affiche un message d'erreur
                        die();
                    }

                    $stmt->execute(array(
                        "nom" => $nomUtilisateur,
                        "prenom" => $prenomUtilisateur,
                        "datedenaissance" => $dateNaissanceUtilisateur,
                        "email" => $emailUtilisateur,
                        "mdp" => $mdp_chiffre,
                        "adresse" => $adresseUtilisateur,
                        "telephone" => $telephoneUtilisateur));

                    // Envoi du Mail de confirmation

                    $retour=false;
                    $position_arobase = strpos($_POST['email'], '@');
                    $message = 'Bienvenue ' . $_POST['email'] . ' sur Netclix.
                 Votre code de confirmation est  : ' . $chaineAleatoire . ' 
                 Veuillez vous rendre sur ce lien afin de valider votre compte : http://webinfo.iutmontp.univ-montp2.fr/~rouyc/ProjetPHP/www/index.php?action=validationMail ';
                    if ($position_arobase === false)
                        echo '<p>Votre email doit comporter un arobase.</p>';
                    else {
                        $retour = mail('Netclix@yopmail.com', 'Envoi depuis la page Contact', $message, 'From: pierre.bec@gmail.com');
                    }
                    // Envoi code OK
                    return 1;
                } else {
                    // Envoi Erreur mdp
                    return 0;
                }
            } else {
                // Envoi Erreur mail déja prise
                return -1;
            }



        }
        public static function checkPassword($login,$mot_de_passe_chiffre){

                try {
                    $rep = Model::$pdo->query("SELECT mdp FROM Utilisateur
                                                WHERE emailUtilisateur= \"" . $login . "\" ");
                } catch (PDOException $e) {
                    if (Conf::getDebug()) {
                        echo $e->getMessage();
                    } else {
                        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                    }
                    die();
                }

                $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
                $tab_article = $rep->fetchAll();
                $mdp_chiffre = Security::chiffrer($mot_de_passe_chiffre);
                if (isset($tab_article[0])){
                    if($tab_article[0]->getMdp() == $mdp_chiffre){
                        return 1;
                    }
                    else {
                        return 0;
                    }
                }
                else {
                    return 0;
                }


        }

        public static function estValide($login) {
            try {
                $rep = Model::$pdo->query("SELECT Valide FROM Utilisateur
                                                WHERE emailUtilisateur= \"" . $login . "\" ");
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
            $tab_article = $rep->fetchAll();
            return $tab_article[0]->getValide();


        }

        public static function estAdmin($login) {
            try {
                $rep = Model::$pdo->query("SELECT admin FROM Utilisateur
                                                WHERE emailUtilisateur= \"" . $login . "\" ");
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCompte');
            $tab_article = $rep->fetchAll();
            return $tab_article[0]->getBoolAdmin();


        }

        public static function validationCompte($login,$mdp) {
            $U = self::getCompteByEmail($login);
            $mdp = str_replace(" ","",$mdp);

                if (strcmp($U->getNonce(),$mdp)==0) {
                try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `valide`=1 WHERE emailUtilisateur=\"$login\"");}

                catch (PDOException $e) {
                    if (Conf::getDebug()) {echo $e->getMessage();}
                    else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                    die();
                }

                $stmt->execute(array('login' => $login));
                return 1;
            } else {
                return 0;
            }
        }

        // Modification du nom //
        public static function modifNom($nom,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `nomUtilisateur`=:nom WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('nom' => $nom,
                                 'idCompte' => $idCompte));
        }

        // Modification du prenom //
        public static function modifPrenom($prenom,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `prenomUtilisateur`=:prenom WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('prenom' => $prenom,
                                 'idCompte' => $idCompte));
        }

        // Modification de la date //
        public static function modifDate($date,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `dateNaissanceUtilisateur`=:date WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('date' => $date,
                                 'idCompte' => $idCompte));
        }

        // Modification de la date //
        public static function modifAdresse($adresse,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `adresseUtilisateur`=:adresse WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('adresse' => $adresse,
                                 'idCompte' => $idCompte));
        }

        // Modification de l'email //
        public static function modifEmail($email,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `emailUtilisateur`=:email WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('email' => $email,
                                 'idCompte' => $idCompte));
        }

        // Modification du téléphone //
        public static function modifTelephone($telephone,$idCompte){

            try {$stmt = Model::$pdo->prepare("UPDATE `Utilisateur` SET `telephoneUtilisateur`=:telephone WHERE idUtilisateur=:idCompte");}

            catch (PDOException $e) {
                if (Conf::getDebug()) {echo $e->getMessage();} 
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $stmt->execute(array('telephone' => $telephone,
                                 'idCompte' => $idCompte));
        }
    }


?>