<?php
$tpl = eZTemplate::factory();
$module = $Params['Module'];

$mugoINI = eZINI::instance( 'mugorss.ini' );
$feed_tpl_mapping = $mugoINI->variable( 'MugoRSS', 'FeedTplMapping' );

$tplFile = $feed_tpl_mapping[ $Params['feed_id'] ];

if( $tplFile )
{
	
	// Force full URLs
	$http = eZHTTPTool::instance();
	$http->UseFullUrl = true;
	
	$tpl->setVariable( 'param1', $Params['param1'] );
	$tpl->setVariable( 'param2', $Params['param2'] );
	
	$output = $tpl->fetch( 'design:mugorss/feeds/' . $tplFile );
	
	if( $_REQUEST[ 'debug' ] )
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
	die( 'not found' );
}

?>