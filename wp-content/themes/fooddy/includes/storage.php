<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('fooddy_storage_get')) {
	function fooddy_storage_get($var_name, $default='') {
		global $FOODDY_STORAGE;
		return isset($FOODDY_STORAGE[$var_name]) ? $FOODDY_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('fooddy_storage_set')) {
	function fooddy_storage_set($var_name, $value) {
		global $FOODDY_STORAGE;
		$FOODDY_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('fooddy_storage_empty')) {
	function fooddy_storage_empty($var_name, $key='', $key2='') {
		global $FOODDY_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($FOODDY_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($FOODDY_STORAGE[$var_name][$key]);
		else
			return empty($FOODDY_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('fooddy_storage_isset')) {
	function fooddy_storage_isset($var_name, $key='', $key2='') {
		global $FOODDY_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($FOODDY_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($FOODDY_STORAGE[$var_name][$key]);
		else
			return isset($FOODDY_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('fooddy_storage_inc')) {
	function fooddy_storage_inc($var_name, $value=1) {
		global $FOODDY_STORAGE;
		if (empty($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = 0;
		$FOODDY_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('fooddy_storage_concat')) {
	function fooddy_storage_concat($var_name, $value) {
		global $FOODDY_STORAGE;
		if (empty($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = '';
		$FOODDY_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('fooddy_storage_get_array')) {
	function fooddy_storage_get_array($var_name, $key, $key2='', $default='') {
		global $FOODDY_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($FOODDY_STORAGE[$var_name][$key]) ? $FOODDY_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($FOODDY_STORAGE[$var_name][$key][$key2]) ? $FOODDY_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('fooddy_storage_set_array')) {
	function fooddy_storage_set_array($var_name, $key, $value) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if ($key==='')
			$FOODDY_STORAGE[$var_name][] = $value;
		else
			$FOODDY_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('fooddy_storage_set_array2')) {
	function fooddy_storage_set_array2($var_name, $key, $key2, $value) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if (!isset($FOODDY_STORAGE[$var_name][$key])) $FOODDY_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$FOODDY_STORAGE[$var_name][$key][] = $value;
		else
			$FOODDY_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('fooddy_storage_merge_array')) {
	function fooddy_storage_merge_array($var_name, $key, $value) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if ($key==='')
			$FOODDY_STORAGE[$var_name] = array_merge($FOODDY_STORAGE[$var_name], $value);
		else
			$FOODDY_STORAGE[$var_name][$key] = array_merge($FOODDY_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('fooddy_storage_set_array_after')) {
	function fooddy_storage_set_array_after($var_name, $after, $key, $value='') {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if (is_array($key))
			fooddy_array_insert_after($FOODDY_STORAGE[$var_name], $after, $key);
		else
			fooddy_array_insert_after($FOODDY_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('fooddy_storage_set_array_before')) {
	function fooddy_storage_set_array_before($var_name, $before, $key, $value='') {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if (is_array($key))
			fooddy_array_insert_before($FOODDY_STORAGE[$var_name], $before, $key);
		else
			fooddy_array_insert_before($FOODDY_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('fooddy_storage_push_array')) {
	function fooddy_storage_push_array($var_name, $key, $value) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($FOODDY_STORAGE[$var_name], $value);
		else {
			if (!isset($FOODDY_STORAGE[$var_name][$key])) $FOODDY_STORAGE[$var_name][$key] = array();
			array_push($FOODDY_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('fooddy_storage_pop_array')) {
	function fooddy_storage_pop_array($var_name, $key='', $defa='') {
		global $FOODDY_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($FOODDY_STORAGE[$var_name]) && is_array($FOODDY_STORAGE[$var_name]) && count($FOODDY_STORAGE[$var_name]) > 0) 
				$rez = array_pop($FOODDY_STORAGE[$var_name]);
		} else {
			if (isset($FOODDY_STORAGE[$var_name][$key]) && is_array($FOODDY_STORAGE[$var_name][$key]) && count($FOODDY_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($FOODDY_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('fooddy_storage_inc_array')) {
	function fooddy_storage_inc_array($var_name, $key, $value=1) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if (empty($FOODDY_STORAGE[$var_name][$key])) $FOODDY_STORAGE[$var_name][$key] = 0;
		$FOODDY_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('fooddy_storage_concat_array')) {
	function fooddy_storage_concat_array($var_name, $key, $value) {
		global $FOODDY_STORAGE;
		if (!isset($FOODDY_STORAGE[$var_name])) $FOODDY_STORAGE[$var_name] = array();
		if (empty($FOODDY_STORAGE[$var_name][$key])) $FOODDY_STORAGE[$var_name][$key] = '';
		$FOODDY_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('fooddy_storage_call_obj_method')) {
	function fooddy_storage_call_obj_method($var_name, $method, $param=null) {
		global $FOODDY_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($FOODDY_STORAGE[$var_name]) ? $FOODDY_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($FOODDY_STORAGE[$var_name]) ? $FOODDY_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('fooddy_storage_get_obj_property')) {
	function fooddy_storage_get_obj_property($var_name, $prop, $default='') {
		global $FOODDY_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($FOODDY_STORAGE[$var_name]->$prop) ? $FOODDY_STORAGE[$var_name]->$prop : $default;
	}
}
?>