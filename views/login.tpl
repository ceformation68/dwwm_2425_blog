{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
	{*
	<?php if (count($arrErrors) > 0){ ?>
		<div class="alert alert-danger">
		<?php foreach($arrErrors as $strError){ ?>
			<p><?php echo $strError; ?></p>
		<?php } ?>
		</div>
	<?php } ?>
	*}			
	<form method="post">
		<p>
			<label for="mail" class="form-label">Mail</label>
			<input type="text" class="form-control" id="mail" name="mail" value="{$strMail}" >
		</p>
		<p>
			<label for="password" class="form-label">Mot de passe</label>
			<input type="password" class="form-control" id="password" name="password" >
		</p>
		<p>
			<input type="submit" >
		</p>
	</form>
	<a href="index.php?ctrl=user&action=forgot_pwd">Mot de passe oublié</a>
{/block}