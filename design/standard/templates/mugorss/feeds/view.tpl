<?xml version="1.0" encoding="UTF-8"?>
{cache-block keys=array( $feed_id, ezhttp_hasvariable( 'credit', 'get' ) ) expiry=300 ignore_content_expiry}

{def
	$sort_by         = hash( 'published', 'desc' )
	$limit           = 50
	$http_get_string = ''
}

{if and( $rss_node.data_map.sort_attribute.has_content, $rss_node.data_map.sort_direction.has_content ) }
	{set $sort_by = hash( $rss_node.data_map.sort_attribute.content|wash(), $rss_node.data_map.sort_direction.content|wash() )}
{/if}
{if $rss_node.data_map.limit.has_content}
	{set $limit = $rss_node.data_map.limit.content|wash()}
{/if}

{def
	$result = fetch( 'ezfind', 'search', hash(
		'sort_by', $sort_by,
		'limit', $limit,
		'filter', array( $rss_node.data_map.query.content|wash() )
	) )
}

{def $title = $rss_node.data_map.title.content|wash()}

<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:gml="http://www.opengis.net/gml" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" xmlns:georss="http://www.georss.org/georss" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>{$title}</title>
		<link>https://www.csmonitor.com</link>
			{if $rss_node.data_map.description.has_content}
				<description>{$rss_node.data_map.description.content|wash()}</description>
			{else}
				<description>The Christian Science Monitor is an international news organization that delivers thoughtful, global coverage via its website, weekly magazine, online daily edition, and email newsletters.</description>
			{/if}
		<language>en-us</language>
		<copyright>Christian Science Monitor. All rights reserved.</copyright>

		<lastBuildDate>{currentdate()|datetime( 'rss' )}</lastBuildDate>
		{* not sure if we have it <docs>http://www.guardian.co.uk/webfeeds</docs> *}
		<ttl>300</ttl>
		<image>
			<title>{$title}</title>
			<url>https://www.csmonitor.com/extension/csm_base/design/csm_design/images/csmlogo_250x30.png</url>
			<link>https://www.csmonitor.com</link>
		</image>

		<atom:link rel="self" type="application/rss+xml" href="https://rss.csmonitor.com/feeds/{$feed_id|wash()}" />

		{if $rss_node.data_map.show_images.content}
			{def $include_image = true()}
		{else}
			{def $include_image = false()}
		{/if}

		{foreach $result.SearchResult as $node}
			{if $node.data_map.icid.has_content}
				{set $http_get_string = concat( '?icid=', $node.data_map.icis.content|wash() )}
			{else}
				{set $http_get_string = '?icid=rss'}
			{/if}

			{node_view_gui
				content_node=$node
				include_image = $include_image
				view=$rss_node.data_map.view.content|wash()
				with_promotions=true()
				append_credit=ezhttp_hasvariable( 'credit', 'get' )
				http_get_string=$http_get_string
			}
		{/foreach}
	</channel>
</rss>
{/cache-block}