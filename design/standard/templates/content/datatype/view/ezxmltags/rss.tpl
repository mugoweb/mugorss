{if $url}
	
	{currentdate()|l10n( 'shortdatetime' )}
	
	{def $rss = fetch( 'mugorss', 'get_rss_feed', hash( 'url', $url ))}
	
	{switch match=$widget}
	
		{case match='simple'}
			{include uri="design:mugorss/widgets/simple.tpl" rss=$rss}
		{/case}
		
		{case}
			{include uri="design:mugorss/widgets/simple.tpl" rss=$rss}
		{/case}
	
	{/switch}

{/if}