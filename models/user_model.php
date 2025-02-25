<?php
	/**
	* Classe de gestion de la base de données pour les utilisateurs
	* @author Christel Ehrhart
	* @version 1.0
	* @date 14/01/2025
	*/

	require_once("mother_model.php");

	class UserModel extends MotherModel{
		
		/**
		* Constructeur de la classe
		*/
		public function __construct(){
			parent::__construct();
		}
		
		/**
		* Récupération de tous les utilisateurs
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findAll():array{
			$strUserQuery	= "SELECT user_id, user_name, user_firstname
								FROM users";
			return $this->_db->query($strUserQuery)->fetchAll();
		}
		
		/**
		* Récupération de tous les utilisateurs qui ont posté un article
		* @return array Tableau des utilisateurs de la bdd
		*/
		public function findAllCreator():array{
			$strUserQuery	= "SELECT user_id, user_name, user_firstname
								FROM users
								WHERE user_id IN (SELECT article_creator FROM articles)";
			return $this->_db->query($strUserQuery)->fetchAll();
		}	

		public function findUser(string $strMail, string $strPassword):array|bool{
			$strUserQuery	= "SELECT user_id, user_name, user_firstname, user_pwd
								FROM users
								WHERE user_mail = '".$strMail."'";
								//	AND user_pwd = '".$strPassword."'
			$arrUser 		= $this->_db->query($strUserQuery)->fetch();

			// Vérifier le mot de passe à part => Eviter SQL Injection
			if (($arrUser !== false) 
				//&& ($strPassword === $arrUser['user_pwd'])){
				&& (password_verify($strPassword, $arrUser['user_pwd']))){
				unset($arrUser['user_pwd']);
				return $arrUser;
			}
			return false;
			/*if ($arrUser === false){
				return false;
			}else{
				if ($strPassword === $arrUser['user_pwd']){
					return $arrUser;
				}else{
					return false;
				}
			}*/
		}
		
		/**
		* Fonction permettant de vérifier la présence d'une adresse mail en bdd
		* @param string $strMail Adresse mail à Vérifier
		* @return bool Si trouvé ou non
		*/
		public function verifMail(string $strMail):bool{
			$strUserQuery	= "SELECT user_mail
								FROM users
								WHERE user_mail = '".$strMail."'";
			$arrUser 		= $this->_db->query($strUserQuery)->fetch();
			return is_array($arrUser);
		}
		
		/**
		* Insertion en BDD d'un nouvel utilisateur
		* @param object $objUser Utilisateur à ajouter
		* @return bool L'insertion s'est bien passé ou pas
		*/
		public function insert(object $objUser):bool{
			try {
				/* Version en direct => A éviter insert */
				/*$strQuery = "INSERT INTO users 
								(user_name, user_firstname, user_mail, user_pwd)
							VALUES ('".$objUser->getName()."', '".$objUser->getFirstname()."', 
									'".$objUser->getMail()."', '".$objUser->getPwd()."');";*/
				/* Version requête préparée */
				$strQuery 	= "INSERT INTO users 
										(user_name, user_firstname, user_mail, user_pwd)
								VALUES  (:name, :firstname,	:mail, :pwd);";
									
				$rqPrep		= $this->_db->prepare($strQuery);
				$rqPrep->bindValue(":mail", $objUser->getMail(), PDO::PARAM_STR);
				$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
				$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);
				$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
				$rqPrep->execute();
			}catch(PDOException $e) { 
				return false;
			} 
			return true;
		}

        /**
         * Récupération d'un utilisateur avec son id
         * @param $id si précisé,sinon celui en session
         * @return array|bool Tableau de l'utilisateur ou false si non trouvé
         */
		public function get($id = null):array|bool{
			// si pas d'id précisé je récupère l'utilisateur en session
			if (is_null($id)){
				$id = $_SESSION['user']->getId();
			}
			
			$strUserQuery	= "SELECT user_id, user_name, user_firstname, user_mail
								FROM users
								WHERE user_id = ".$id.";";
			$arrUser 		= $this->_db->query($strUserQuery)->fetch();
			return $arrUser;
		}

        /**
         * Récupération d'un utilisateur en fonction de son mail
         * @param string $strMail
         * @return array|bool Tableau de l'utilisateur ou false si non trouvé
         */
        public function findByMail(string $strMail):array|bool{
            $strUserQuery	= "SELECT user_id, user_name, user_firstname, user_mail
								FROM users
								WHERE user_mail = '".$strMail."'";
            $arrUser 		= $this->_db->query($strUserQuery)->fetch();

            return $arrUser;
        }

        /**
         * Récupération d'un utilisateur en fonction du token
         * @param string $strToken token à rechercher
         * @return array|bool Tableau de l'utilisateur ou false si non trouvé
         */
        public function findByToken(string $strToken):array|bool{
            $strUserQuery	= "SELECT user_id, user_name, user_firstname, user_mail
								FROM users
								WHERE user_reset_token = '".$strToken."'
								    AND user_reset_exp_date > NOW()";
            $arrUser 		= $this->_db->query($strUserQuery)->fetch();

            return $arrUser;
        }

        /**
         * Mise à jour des informations de mot de passe oublié de l'utilisateur
         * @param string $token Token pour récupérer l'utilisateur
         * @param int $user_id Identifiant de l'utilisateur concerné
         * @return bool
         */
        public function forgot_pwd(string $token, int $user_id) :bool{
            $strQuery 	= "UPDATE users
                            SET  user_reset_token = :token, 
                                 user_reset_date = NOW(),
                                 user_reset_exp_date = DATE_ADD(NOW(), INTERVAL 15 MINUTE)
                            WHERE user_id = :id ;";
            $rqPrep     = $this->_db->prepare($strQuery);
            $rqPrep->bindValue(":token", $token, PDO::PARAM_STR);
            $rqPrep->bindValue(":id", $user_id, PDO::PARAM_INT);
            return $rqPrep->execute();
        }

        /**
         * Mise à jour du mot de passe de l'utilisateur
         * @param object $objUser Utilisateur concerné
         * @return bool
         */
        public function updatePwd(object $objUser):bool{
            $strQuery 	= "UPDATE users
                            SET  user_pwd = :pwd
                            WHERE user_id = :id ;";
            $rqPrep     = $this->_db->prepare($strQuery);
            $rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);
            $rqPrep->bindValue(":id", $objUser->getId(), PDO::PARAM_INT);
            return $rqPrep->execute();
        }
    }
			