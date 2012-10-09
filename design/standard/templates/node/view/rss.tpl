<item>
	<title>{$node.name|wash()}</title>
	<link>{$node.url_alias|ezroot('no', 'full')}</link>
	<guid>{$node.url_alias|ezroot('no', 'full')}</guid>
	<description><![CDATA[Missing template override - please override -{$node.class_identifier}-]]></description>
	<pubDate>{$node.object.published|datetime( 'custom', '%D, %d %M %Y %H:%i:%s %O' )}</pubDate>
</item>
