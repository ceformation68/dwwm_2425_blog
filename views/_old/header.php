<?php
	/* Christel!!!!!!55 */
	//require_once('entities/user_entity.php');
	//var_dump($_SESSION);
	//session_destroy();
?>
<!doctype html>
<html lang="fr" data-bs-theme="auto">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Exercice de blog">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.118.2">
		<title>Blog</title>
		<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
		
		<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    
	
		<!-- Custom styles for this template -->
		<link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/blog.css" rel="stylesheet">
		<link href="assets/css/custom.css" rel="stylesheet">
		
		<?php if ($strPage == 'blog'){ ?>
		<script src="assets/js/period.js"></script>
		<?php } ?>
	</head>
	<body>
		<div class="container">
			<header class="border-bottom lh-1 py-3">
				<div class="row flex-nowrap justify-content-between align-items-center">
					<div class="col-4 pt-1">
					</div>
					<div class="col-4 text-center">
						<a class="blog-header-logo text-body-emphasis text-decoration-none" href="#">Mon blog</a>
					</div>
					<div id="user" class="col-4 d-flex justify-content-end align-items-center">
						<!-- Si connecté -->
						<?php if (count($_SESSION) > 0 
								&& isset($_SESSION['user']) 
								&& $_SESSION['user']->getId() != "") { ?>
						<a class="btn btn-sm" 
							href="index.php?ctrl=user&action=edit_account"
							title="Modifier mon compte">
							<i class="fas fa-user"></i> 
							<?php echo($_SESSION['user']->getCreatorName()); ?> 
						</a>
						| 
						<a class="btn btn-sm" href="index.php?ctrl=user&action=logout" title="Se déconnecter">
							<i class="fas fa-sign-out-alt"></i>
						</a> 
						<?php }else{ ?>
						<!-- Si non connecté -->
						<a class="btn btn-sm" href="index.php?ctrl=user&action=create_account" title="Créer un compte">
							<i class="fas fa-user"></i>
						</a>
						| 
						<a class="btn btn-sm" href="index.php?ctrl=user&action=login" title="Se connecter">
							<i class="fas fa-sign-in-alt"></i>
						</a> 
						<?php } ?>
					</div>
				</div>
			</header>

			<div class="nav-scroller py-1 mb-3 border-bottom">
				<?php include_once("views/_partial/nav.php"); ?>
			</div>
		</div>

		<main class="container">
			<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
				<div class="col-lg-6 px-0">
					<h1 class="display-4 fst-italic"><?php echo($strTitle); ?></h1>
					<p class="my-3"><?php echo($strDesc); ?></p>
				</div>
			</div>