<?php

class MugoRSSFunctionCollection
{
	function template_fetch_rss_feed( $url )
	{
		return array( 'result' => MugoRSSFunctionCollection::fetch_rss_feed( $url) );
	}
	
	function fetch_rss_feed( $url )
	{
		$content = MugoRSSFunctionCollection::read_feed( $url );
		
		return MugoRSSFunctionCollection::content2data( $content );
	}
	
	function read_feed( $url )
	{
		$return = '';
		
		if( $url )
		{
			// using curl
			$ch = curl_init();
	
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_HEADER, false);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			
			// grab URL and pass it to the browser
			$return = curl_exec( $ch );
			
			// close cURL resource, and free up system resources
			curl_close( $ch );
		}
		
		return $return;
	}

	function content2data( $content )
	{
		$return = array();
		
		if( $content )
		{
			$mapping = array( 'channel', 'textinput', 'image', 'items' );
			
			include_once( 'extension/mugorss/classes/libs/rss_utils.inc' );
			include_once( 'extension/mugorss/classes/libs/rss_parse.inc' );
		
			$parser = new MagpieRSS( $content, 'UTF-8', 'UTF-8' );
			
			// object 2 array
			foreach( $mapping as $tag )
			{
				$return[ $tag ] = $parser->$tag;
			}
		}

		return $return;
	}
}

?>