{extends file="packetunderground/base.tpl"}
{block content}
{foreach $posts as $post}
{include file="packetunderground/blogpost.tpl"}
{/foreach}
{/block}