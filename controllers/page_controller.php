<?php
	/* Définir les fichiers à utiliser */
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	/**
	* Controleur des pages 
	* @author Christel
	* @date 27/01/2025
	*/

	class PageCtrl extends MotherCtrl{
	
		/**
		* Constructeur
		*/
		public function __construct(){
			parent::__construct();
		}
		/**
		* Page A propos
		*/
		public function about(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "A propos";
			$this->_arrData['strDesc']	= "Page de contenu";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "about";
			
			$this->display("about");
			
		}
		
		/**
		* Page mentions légales
		*/
		public function mentions(){
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Mentions légales";
			$this->_arrData['strDesc']	= "Page de contenu";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "mentions";

			/*include_once("views/_partial/header.php");
			include_once("views/mentions.php");
			include_once("views/_partial/footer.php");*/
			$this->display("mentions");
		}
		
		/**
		* Page contact
		*/
		public function contact(){
			
			if (count($_POST) > 0){
				// Envoi de mail 
				$objMail = new PHPMailer(); // Nouvel objet Mail
				$objMail->IsSMTP();
				$objMail->Mailer 		= "smtp";
				$objMail->CharSet 		= PHPMailer::CHARSET_UTF8;
				
				// Si on veut afficher les messages de debug
				$objMail->SMTPDebug  	= 0;  
				
				// Connection au serveur de mail 
				$objMail->SMTPAuth   	= TRUE;
				$objMail->SMTPSecure 	= "tls";
				$objMail->Port       	= 587;
				$objMail->Host       	= "smtp.gmail.com";
				$objMail->Username 		= 'christel.ceformation@gmail.com';
				$objMail->Password 		= 'cdbk mrjr aiqo tndi';

				// Comment envoyer le mail				
				$objMail->IsHTML(true); // en HTML
				$objMail->setFrom('no-reply@blog.fr', 'Mon BLOG'); // Expéditeur
				// Destinataire(s)
				$objMail->addAddress('contact@ce-formation.com', 'Christel');
				//$objMail->addAddress('autre@adesse-mail.com', 'Autre destinataire');
				//$objMail->addCC('cc@example.com'); // en copie
				//$objMail->addBCC('bcc@example.com'); // en copie cachée
				
				$this->_arrData['nom']		= $_POST['name']??'';
				$this->_arrData['prenom']	= $_POST['firstname']??'';
				$this->_arrData['contenu']	= $_POST['content']??'';
				// Contenu du mail
				$objMail->Subject 	= 'Demande de contact';
				$objMail->Body 		= $this->display("mails/contact", false);	
				//$mail->addAttachment('test.txt');

				if (!$objMail->send()) {
					echo 'Erreur de Mailer : ' . $objMail->ErrorInfo;
				} else {
					$_SESSION['success'] 	= 'Le message a été envoyé.';
					// Rediriger vers l'accueil
					header("Location:index.php");
					exit;
				}
			}
			// Variables d'affichage
			$this->_arrData['strTitle']	= "Contact";
			$this->_arrData['strDesc']	= "Page de contact";

			// Variables fonctionnelles
			$this->_arrData['strPage']	= "contact";

			$this->display("contact");			
		}			
	}