<?php
$FunctionList = array();

$FunctionList[ 'get_rss_feed' ] = array(
                           'name' => 'get_rss_feed',
                           'call_method' => array( 
                                                  'include_file' => 'extension/mugorss/classes/MugoRSSFunctionCollection.php',
                                                  'class' => 'MugoRSSFunctionCollection',
                                                  'method' => 'template_fetch_rss_feed' ),
                           'parameter_type' => 'standard',
                           'parameters' => array(
                                                 array(  'name'     => 'url',
                                                         'type'     => 'string',
                                                         'required' => true
                                                 ))
                                     );


?>