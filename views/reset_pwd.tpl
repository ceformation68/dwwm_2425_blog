{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
	{if (!isset($arrErrors['expire']))}
	<!-- formulaire -->
	<form method="post">
		<p>
			<label>Mot de passe</label>
			<input type="text" name="pwd" >
			<span>Le mot de passe doit contenir une minuscule, une majuscule, un caractère spéciaux et doit faire plus de 16 caractères</span>
			<label>Confirmation du mot de passe</label>
			<input type="text" name="confirm_pwd" >
		</p>
		<input type="submit">
	</form>
	{/if}
{/block}