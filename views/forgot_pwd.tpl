{extends file="views/layout.tpl"}

{block name="title_head" append}
    - {$strTitle}
{/block}

{block name="contenu"}
    <form method="post">
        <p>
            <label for="mail" class="form-label">Mail</label>
            <input type="text" class="form-control" id="mail" name="mail" value="{$strMail}" >
        </p>
        <p>
            <input type="submit" >
        </p>
    </form>
{/block}