	<?php if (count($arrErrors) > 0){ ?>
		<div class="alert alert-danger">
		<?php foreach($arrErrors as $strError){ ?>
			<p><?php echo $strError; ?></p>
		<?php } ?>
		</div>
	<?php } ?>
	<!-- formulaire -->
	<form method="post">
	<p>
		<label>Nom d'utilisateur</label>
		<input type="text" name="name" value="<?php echo($objUser->getName()); ?>" >
	</p>
	<p>
		<label>Prénom d'utilisateur</label>
		<input type="text" name="firstname" value="<?php echo($objUser->getFirstname()); ?>" >
	</p>
	<p>
		<label>Mail</label>
		<input id="name" class="form-control <?php if (isset($arrErrors['mail'])) { echo("is-invalid"); } ?>" type="text" name="mail" value="<?php echo($objUser->getMail()); ?>" >
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
