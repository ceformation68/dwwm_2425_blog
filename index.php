<?php
	// Variables d'affichage
	$strTitle	= "Accueil";
	$strDesc	= "Page affichant les 4 derniers articles";

	// Variables fonctionnelles
	$strPage	= "index";

	include_once("header.php");
	
	// inclure le fichier modèle
	require("models/article_model.php");
	// instancier
	$objArticleModel	= new ArticleModel();
	// Utiliser
	$arrArticles		= $objArticleModel->findAll(4);
	
	/*require_once("connexion.php");

	$strQuery		= "SELECT articles.*, CONCAT(user_name, \" \", user_firstname) 
						AS \"user_name\"
						FROM articles
							INNER JOIN users ON article_creator = user_id
						ORDER BY article_createdate DESC
						LIMIT 4 OFFSET 0;";
	$arrArticles	= $db->query($strQuery)->fetchAll();*/
	
	//var_dump($arrArticles);
?>

	<div class="row mb-2">
	<?php
		foreach($arrArticles as $arrDetArticle){
			include("article.php");
		}
	?>
	</div>
<?php

	include_once("footer.php");
?>
