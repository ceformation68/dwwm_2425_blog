{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
	<!-- uniquement si pas de session -->
	<p> Vous pouvez vous connecter en cliquant sur le lien suivant : 
	<a href="login.php">Se connecter</a>
	</p>
{/block}