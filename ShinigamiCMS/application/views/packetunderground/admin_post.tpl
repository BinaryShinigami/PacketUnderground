{extends file="packetunderground/base.tpl"}
{block content}
<div class="box">
    <h2 align="center">Add/Edit Post</h2>
    <form action="" method="post">
        Title: <input type='text' id='title' name='title' value="{$post.title}" /><br />
        Slug: <input type='text' id='slug' name='slug' value="{$post.slug}" /><br />
        Content: <br />
        <textarea id='content' name='content'>{$post.content}</textarea><br />
        <input type="submit" value="Post!" />
    </form>
</div>
{/block}