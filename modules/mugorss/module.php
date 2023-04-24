<?php

$Module  = array( 'name' => 'Mugo RSS',
                  'variable_params' => true );

$ViewList = array();

$ViewList[ 'feed' ] = array(
    'functions' => array( 'feed' ),
    'script' => 'feed.php',
    'params' => array( 'feed_id', 'param1', 'param2' )
);

$ViewList[ 'view' ] = array(
	'functions' => array( 'feed' ),
	'script' => 'view.php',
	'params' => array( 'feed_id' )
);

$ViewList['sandbox'] = array(
    'functions' => array( 'feed' ),
	'script' => 'sandbox.php'
);

$FunctionList = array();
$FunctionList['feed'] = array();
