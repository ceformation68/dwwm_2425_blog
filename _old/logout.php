<?php 
	// J'utilise la session
	session_start();
	// Je détruit la session
	session_destroy();
	// Je redirige
	header("Location:login.php");
	