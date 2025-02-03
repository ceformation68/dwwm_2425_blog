	<nav class="nav nav-underline justify-content-between">
		<a class="nav-item nav-link link-body-emphasis {if ($strPage == 'index') } active {/if}" href="index.php">Accueil</a>
		<a class="nav-item nav-link link-body-emphasis {if ($strPage == 'about') } active {/if}" href="index.php?ctrl=page&action=about">A propos</a>
		<a class="nav-item nav-link link-body-emphasis {if ($strPage == 'blog') } active {/if}" href="index.php?ctrl=article&action=blog">Blog</a>
		<a class="nav-item nav-link link-body-emphasis {if ($strPage == 'contact') } active {/if}" href="index.php?ctrl=page&action=contact">Contact</a>
	</nav>
