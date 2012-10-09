<?php
require_once( "kernel/common/template.php" );

$tpl = templateInit();
$module = $Params['Module'];

$mugoINI = eZINI::instance( 'mugorss.ini' );
$feed_tpl_mapping = $mugoINI->variable( 'MugoRSS', 'FeedTplMapping' );

$tplFile = $feed_tpl_mapping[ $Params['feed_id'] ];

if( $tplFile )
{
	
	// Force full URLs
	$http = eZHTTPTool::instance();
	$http->UseFullUrl = true;
	
	// Set headers
	$headers = $mugoINI->variable( 'MugoRSS', 'Headers' );
	
	if( !empty( $headers ) )
	{
		foreach( $headers as $header )
		{
			header( $header );
		}
	}
	
	$httpCharset = eZTextCodec::httpCharset();
	header( 'Content-Type: text/xml; charset=' . $httpCharset );
	
	$tpl->setVariable( 'param1', $Params['param1'] );
	$tpl->setVariable( 'param2', $Params['param2'] );
	
	echo $tpl->fetch( 'design:mugorss/feeds/' . $tplFile );
	
	eZExecution::cleanExit();
}
else
{
	die( 'not found' );
}
?>