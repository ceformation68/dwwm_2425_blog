<?php
	// Variables d'affichage
	$strTitle	= "Accueil";
	$strDesc	= "Page affichant les 4 derniers articles";

	// Variables fonctionnelles
	$strPage	= "index";

	include_once("header.php");
	
	require_once("connexion.php");

	$strQuery		= "SELECT articles.*, CONCAT(user_name, \" \", user_firstname) 
						AS \"user_name\"
						FROM articles
							INNER JOIN users ON article_creator = user_id
						ORDER BY article_createdate DESC
						LIMIT 4 OFFSET 0;";
	$arrArticles	= $db->query($strQuery)->fetchAll();
	
	//var_dump($arrArticles);
?>

	<div class="row mb-2">
	<?php
		foreach($arrArticles as $arrDetArticle){
	?>
		<article class="col-md-6">
			<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
				<div class="col p-4 d-flex flex-column position-static">
					<h3 class="mb-0"><?php echo($arrDetArticle['article_title']); ?></h3>
					<div class="mb-1 text-body-secondary">
						<?php echo($arrDetArticle['article_createdate']); ?> 
						(<?php echo($arrDetArticle['user_name']); ?>)
					</div>
					<p class="mb-auto"><?php echo($arrDetArticle['article_content']); ?></p>
					<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">Lire la suite</a>
				</div>
				<div class="col-auto d-none d-lg-block">
					<img class="bd-placeholder-img" width="200" height="250" alt="<?php echo($arrDetArticle['article_title']); ?>" src="assets/images/<?php echo($arrDetArticle['article_img']); ?>">
				</div>
			</div>
		</article>
	<?php
		}
	?>
	</div>
<?php

	include_once("footer.php");
?>
