<?php
$tpl = eZTemplate::factory();
$module = $Params[ 'Module' ];

$mugoINI = eZINI::instance( 'mugorss.ini' );

if( $mugoINI->variable( 'MugoRSS', 'MemoryLimit' ) )
{
	ini_set( 'memory_limit', $mugoINI->variable( 'MugoRSS', 'MemoryLimit' ) );
}

// Force full URLs
$http = eZHTTPTool::instance();
$http->UseFullUrl = true;

$rss_nodes = eZFunctionHandler::execute( 'content', 'tree', array(
	'parent_node_id'     => 1,
	'class_filter_array' => array( 'rss_feed' ),
	'limit'              => 1,
	'attribute_filter'   => array( array( 'rss_feed/identifier', '=', $Params[ 'feed_id' ] ) ),
) );

if( count( $rss_nodes ) )
{
	$tpl->setVariable( 'rss_node', $rss_nodes[0] );
	$tpl->setVariable( 'feed_id', $Params[ 'feed_id' ] );

	$output = $tpl->fetch( 'design:mugorss/feeds/view.tpl' );

	if( isset( $_REQUEST[ 'debug' ] ) )
	{
		$Result[ 'content' ] = '<pre>' . htmlentities( $output ) . '</pre>';
		$Result[ 'pagelayout' ] = false;
	}
	else
	{
		// Set RSS specific headers
		$headers = $mugoINI->variable( 'MugoRSS', 'Headers' );

		if( !empty( $headers ) )
		{
			foreach( $headers as $header )
			{
				header( $header );
			}
		}

		echo $output;
		eZExecution::cleanExit();
	}
}
else
{
	http_response_code( 404 );
	eZExecution::cleanExit();
}
