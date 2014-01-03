<?php

class ActionsFilters{
	public $actions	= array();
	public $filters	= array();
}


$AF = new ActionsFilters();


/*
 *	FILTERS : call attached functions passing a value, return a value
*/

function add_filter( $tag, $function_to_call ) {
	global $AF;
	if ( isset( $AF->filters[$tag] ) && in_array( $function_to_call, $AF->filters[$tag] ) ) return;
	$AF->filters[$tag][] = $function_to_call;
}

function remove_filter( $tag, $function_to_remove ) {
	global $AF;
	$key = array_search( $function_to_remove, $AF->filters[$tag] );
	if ( $key ) unset( $AF->filters[$tag][$key] );
}

function apply_filters( $tag, $value = null ) {
	global $AF;
	if ( isset( $AF->filters[$tag] ) )
		foreach ( $AF->filters[$tag] as $function_to_call )
			$value = call_user_func( $function_to_call, $value );
	return $value;
}

/*
 *	ACTIONS : call attached functions
*/

function add_action( $tag, $function_to_call ) {
	global $AF;
	if ( isset( $AF->actions[$tag] ) && in_array( $function_to_call, $AF->actions[$tag] ) ) return;
	$AF->actions[$tag][] = $function_to_call;
}

function remove_action( $tag, $function_to_remove ) {
	global $AF;
	$key = array_search( $function_to_remove, $AF->actions[$tag] );
	if ( $key ) unset( $AF->actions[$tag][$key] );
}

function do_action( $tag ){
	global $AF;
	if ( isset( $AF->actions[$tag] ) )
		foreach ( $AF->actions[$tag] as $function_to_call )
			call_user_func( $function_to_call );
}
