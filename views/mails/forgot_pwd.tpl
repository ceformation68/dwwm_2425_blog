{nocache}
	Bonjour {$objUser->getCreatorName()},
	<p>
		<a href="http://localhost/blog_html/index.php?ctrl=user&action=reset_pwd&token={$token}">
			Réinitialiser mon mot de passe
		</a>
	</p>
{/nocache}