<item>
	<title>{$node.name|wash()}</title>
	<link>{$node.url_alias|ezroot('no', 'full')}</link>
	<guid>{$node.url_alias|ezroot('no', 'full')}</guid>
	<description><![CDATA[{attribute_view_gui attribute=$node.data_map.description}]]></description>
	<pubDate>{$node.object.published|datetime( 'custom', '%D, %d %M %Y %H:%i:%s %O' )}</pubDate>
</item>
