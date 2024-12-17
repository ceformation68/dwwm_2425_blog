<?php
	// Variables d'affichage
	$strTitle	= "Blog";
	$strDesc	= "Page affichant tous les articles, avec une zone de recherche sur les articles";
	
	// Variables fonctionnelles
	$strPage	= "blog";
	
	include_once("header.php");
	
	require_once("connexion.php");
?>

	<div class="row mb-2">
		<form name="formSearch" method="post" action="#">
			<fieldset>
				<legend>Rechercher des articles</legend>
				<p><label for="keywords">Mots clés</label><input id="keywords" type="text" name="keywords" /></p>
				<p>	<input type="radio" name="period" checked value="0" onclick="changePeriod()" /> Par date exacte
					<input type="radio" name="period" value="1" onclick="changePeriod()" /> Par période
				</p>
				<p id="uniquedate">
					<label for="date">Date</label><input id="date" type="date" name="date" />
				</p>
				<p id="period">
					<label for="startdate">Date de début</label><input id="startdate" type="date" name="startdate" />
					<label for="enddate">Date de fin</label><input id="enddate" type="date" name="enddate" />
				</p>
				<p>
					<label for="author">Auteur</label>
					<select id="author">
						<option>christel</option>
						<option>test</option>
					</select>
				</p>
				<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" />
			</fieldset>
		</form>
	
		<article class="col-md-6">
			<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
				<div class="col p-4 d-flex flex-column position-static">
					<h3 class="mb-0">LE devenir du Javascript </h3>
					<div class="mb-1 text-body-secondary">11/05/2017 (test)</div>
					<p class="mb-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit... </p>
					<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">Lire la suite</a>
				</div>
				<div class="col-auto d-none d-lg-block">
					<img class="bd-placeholder-img" width="200" height="250" alt="js" src="assets/images/js.png">
				</div>
			</div>
		</article>
		
		<article class="col-md-6">
			<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
				<div class="col p-4 d-flex flex-column position-static">
					<h3 class="mb-0">Qu'est-ce que le HTML?</h3>
					<div class="mb-1 text-body-secondary">04/04/2017 (christel)</div>
					<p class="mb-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit... </p>
					<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">Lire la suite</a>
				</div>
				<div class="col-auto d-none d-lg-block">
					<img class="bd-placeholder-img" width="200" height="250" alt="html" src="assets/images/html.png">
				</div>
			</div>
		</article>

		<article class="col-md-6">
			<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
				<div class="col p-4 d-flex flex-column position-static">
					<h3 class="mb-0">Utiliser le CSS correctement</h3>
					<div class="mb-1 text-body-secondary">08/05/2017 (christel)</div>
					<p class="mb-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit... </p>
					<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">Lire la suite</a>
				</div>
				<div class="col-auto d-none d-lg-block">
					<img class="bd-placeholder-img" width="200" height="250" alt="css" src="assets/images/CSS.png">
				</div>
			</div>
		</article>

		<article class="col-md-6">
			<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
				<div class="col p-4 d-flex flex-column position-static">
					<h3 class="mb-0">Utiliser PhpMyAdmin</h3>
					<div class="mb-1 text-body-secondary">21/05/2017 (christel)</div>
					<p class="mb-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit... </p>
					<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">Lire la suite</a>
				</div>
				<div class="col-auto d-none d-lg-block">
					<img class="bd-placeholder-img" width="200" height="250" alt="mysql" src="assets/images/mysql.png">
				</div>
			</div>
		</article>				
	</div>
<?php
	include_once("footer.php");
?>