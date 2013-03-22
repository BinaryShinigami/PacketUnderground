{extends file="packetunderground/base.tpl"}
{block content}
<div class="box">
    <h2 align="center">{$post.title}</h2>
    <div class="entry_details">
        <span class='author small'>Author: {$post.author}</span>
        <span class="datetime small">Created: {$post.timestamp}</span>
        <div class="clear"></div>
    </div>
    {$post.content}
    <hr>
    <!-- Comments will go here.... -->
</div>
{/block}