{cache-block keys="-Feed ID - static" expiry=1 ignore_content_expiry}  
{def $nodes = fetch( 'content', 'list', hash( 'parent_node_id', 2,
                                              'limit', 10
                                            ))}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <atom:link href="http://my.site.com" rel="self" type="application/rss+xml"/>
    <title>My Title</title>
    <link>http://my.site.com</link>
    <description>My description</description>
    <language>en-US</language>
	{foreach $nodes as $node}
		{node_view_gui content_node=$node view="rss"}
    {/foreach}
  </channel>
</rss>
{/cache-block}