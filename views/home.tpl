{extends file="views/layout.tpl"}

{block name="title_head" append}
 - {$strTitle}
{/block}

{block name="contenu"}
	<div class="row mb-2">
		{foreach from=$arrArticles item=objArticle}
			{include file="views/_partial/article.tpl"}
		{/foreach}
	</div>
{/block}