{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}

	<!-- formulaire -->
	<form method="post">
	<p>
		<label>Nom d'utilisateur</label>
		<input type="text" name="name" value="{$objUser->getName()}" >
	</p>
	<p>
		<label>Prénom d'utilisateur</label>
		<input type="text" name="firstname" value="{$objUser->getFirstname()}" >
	</p>
	<p>
		<label>Mail</label>
		<input id="name" class="form-control {if (isset($arrErrors['mail'])) } is-invalid {/if}" type="text" name="mail" value="{$objUser->getMail()}" >
		<div id="nameFeedback" class="invalid-feedback">
		<?php echo($arrErrors['mail']); ?>
		</div>
	</p>
	<p>
		<label>Mot de passe</label>
		<input type="text" name="pwd" >
		<span>Le mot de passe doit contenir une minuscule, une majuscule, un caractère spéciaux et doit faire plus de 16 caractères</span>
		<label>Confirmation du mot de passe</label>
		<input type="text" name="confirm_pwd" >
	</p>
	<input type="submit">
	</form>
{/block}