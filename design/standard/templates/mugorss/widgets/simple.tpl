{if count( $rss.items )}
	<ul>
		{foreach $rss.items as $item}
			<li>
				<h3><a href="{$item.link|wash()}">{$item.title|wash()}</a></h3>
				<p>{$item.summary|wash()}</p>
			</li>
		{/foreach}
	</ul>
{/if}
