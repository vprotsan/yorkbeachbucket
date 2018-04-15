<?php
/**
 * Theme tags and utilities
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Arrays manipulations
----------------------------------------------------------------------------------------------------- */

// Merge arrays and lists (preserve number indexes)
// $a = array("one", "k2"=>"two", "three");
// $b = array("four", "k1"=>"five", "k2"=>"six", "seven");
// $c = array_merge($a, $b);			["one", "k2"=>"six", "three", "four", "k1"=>"five", "seven");
// $d = fooddy_array_merge($a, $b);	["four", "k2"=>"six", "seven", "k1"=>"five");
if (!function_exists('fooddy_array_merge')) {
	function fooddy_array_merge($a1, $a2) {
		for ($i = 1; $i < func_num_args(); $i++){
			$arg = func_get_arg($i);
			if (is_array($arg) && count($arg)>0) {
				foreach($arg as $k=>$v) {
					$a1[$k] = $v;
				}
			}
		}
		return $a1;
	}
}

// Inserts any number of scalars or arrays at the point
// in the haystack immediately after the search key ($needle) was found,
// or at the end if the needle is not found or not supplied.
// Modifies $haystack in place.
// @param array &$haystack the associative array to search. This will be modified by the function
// @param string $needle the key to search for
// @param mixed $stuff one or more arrays or scalars to be inserted into $haystack
// @return int the index at which $needle was found
if (!function_exists('fooddy_array_insert')) {
	function fooddy_array_insert_after(&$haystack, $needle, $stuff){
		if (! is_array($haystack) ) return -1;

		$new_array = array();
		for ($i = 2; $i < func_num_args(); ++$i){
			$arg = func_get_arg($i);
			if (is_array($arg)) {
				if ($i==2)
					$new_array = $arg;
				else
					$new_array = fooddy_array_merge($new_array, $arg);
			} else 
				$new_array[] = $arg;
		}

		$i = 0;
		if (is_array($haystack) && count($haystack) > 0) {
			foreach($haystack as $key => $value){
				$i++;
				if ($key == $needle) break;
			}
		}

		$haystack = fooddy_array_merge(array_slice($haystack, 0, $i, true), $new_array, array_slice($haystack, $i, null, true));

		return $i;
    }
}

// Inserts any number of scalars or arrays at the point
// in the haystack immediately before the search key ($needle) was found,
// or at the end if the needle is not found or not supplied.
// Modifies $haystack in place.
// @param array &$haystack the associative array to search. This will be modified by the function
// @param string $needle the key to search for
// @param mixed $stuff one or more arrays or scalars to be inserted into $haystack
// @return int the index at which $needle was found
if (!function_exists('fooddy_array_before')) {
	function fooddy_array_insert_before(&$haystack, $needle, $stuff){
		if (! is_array($haystack) ) return -1;

		$new_array = array();
		for ($i = 2; $i < func_num_args(); ++$i){
			$arg = func_get_arg($i);
			if (is_array($arg)) {
				if ($i==2)
					$new_array = $arg;
				else
					$new_array = fooddy_array_merge($new_array, $arg);
			} else 
				$new_array[] = $arg;
		}

		$i = 0;
		if (is_array($haystack) && count($haystack) > 0) {
			foreach($haystack as $key => $value){
				if ($key === $needle) break;
				$i++;
			}
		}

		$haystack = fooddy_array_merge(array_slice($haystack, 0, $i, true), $new_array, array_slice($haystack, $i, null, true));

		return $i;
    }
}





/* HTML & CSS
----------------------------------------------------------------------------------------------------- */

// Return first tag from text
if (!function_exists('fooddy_get_tag')) {
	function fooddy_get_tag($text, $tag_start, $tag_end) {
		$val = '';
		if (($pos_start = strpos($text, $tag_start))!==false) {
			$pos_end = strpos($text, $tag_end, $pos_start);
			if ($pos_end===false) {
				$tag_end = '>';
				$pos_end = strpos($text, $tag_end, $pos_start);
			}
			$val = substr($text, $pos_start, $pos_end+strlen($tag_end)-$pos_start);
		}
		return $val;
	}
}

// Decode html-entities in the shortcode parameters
if (!function_exists('fooddy_html_decode')) {
	function fooddy_html_decode($prm) {
		if (is_array($prm) && count($prm) > 0) {
			foreach ($prm as $k=>$v) {
				if (is_string($v))
					$prm[$k] = htmlspecialchars_decode($v, ENT_QUOTES);
			}
		}
		return $prm;
	}
}

// Return string with position rules for the style attr
if (!function_exists('fooddy_get_css_position_from_values')) {
	function fooddy_get_css_position_from_values($top='',$right='',$bottom='',$left='',$width='',$height='') {
		if (!is_array($top)) {
			$top = compact('top','right','bottom','left','width','height');
		}
		$output = '';
		foreach ($top as $k=>$v) {
			$imp = substr($v, 0, 1);
			if ($imp == '!') $v = substr($v, 1);
			if ($v != '') $output .= ($k=='width' ? 'width' : ($k=='height' ? 'height' : 'margin-'.esc_attr($k))) . ':' . esc_attr(fooddy_prepare_css_value($v)) . ($imp=='!' ? ' !important' : '') . ';';
		}
		return $output;
	}
}

// Return value for the style attr
if (!function_exists('fooddy_prepare_css_value')) {
	function fooddy_prepare_css_value($val) {
		if ($val != '') {
			$ed = substr($val, -1);
			if ('0'<=$ed && $ed<='9') $val .= 'px';
		}
		return $val;
	}
}

// Return array with classes from css-file
if (!function_exists('fooddy_parse_icons_classes')) {
	function fooddy_parse_icons_classes($css) {
		$rez = array();
		if (!file_exists($css)) return $rez;
		$file = fooddy_fga($css);
		if (!is_array($file) || count($file) == 0) return $rez;
		foreach ($file as $row) {
			if (substr($row, 0, 1)!='.') continue;
			$name = '';
			for ($i=1; $i<strlen($row); $i++) {
				$ch = substr($row, $i, 1);
				if (in_array($ch, array(':', '{', '.', ' '))) break;
				$name .= $ch;
			}
			if ($name!='') $rez[] = $name;
		}
		return $rez;
	}
}





/* GET, POST, COOKIE, SESSION manipulations
----------------------------------------------------------------------------------------------------- */

// Get GET, POST value
if (!function_exists('fooddy_get_value_gp')) {
	function fooddy_get_value_gp($name, $defa='') {
		static $magic = 0;
		if ($magic === 0) {
			$magic = version_compare(phpversion(), '5.4', '>=')
					|| (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()==1) 
					|| (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime()==1) 
					|| strtolower(ini_get('magic_quotes_sybase'))=='on';
		}
		$rez = $defa;
		if (isset($_GET[$name])) {
			$rez = $magic ? stripslashes(trim($_GET[$name])) : trim($_GET[$name]);
		} else if (isset($_POST[$name])) {
			$rez = $magic ? stripslashes(trim($_POST[$name])) : trim($_POST[$name]);
		}
		return $rez;
	}
}

// Get GET, POST, COOKIE value and save it (if need)
if (!function_exists('fooddy_get_value_gpc')) {
	function fooddy_get_value_gpc($name, $defa='', $page='', $exp=0) {
		static $magic = 0;
		if ($magic === 0) {
			$magic = version_compare(phpversion(), '5.4', '>=')
					|| (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()==1) 
					|| (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime()==1) 
					|| strtolower(ini_get('magic_quotes_sybase'))=='on';
		}
		$putToCookie = $page!='';
		$rez = $defa;
		if (isset($_GET[$name])) {
			$rez = $magic ? stripslashes(trim($_GET[$name])) : trim($_GET[$name]);
		} else if (isset($_POST[$name])) {
			$rez = $magic ? stripslashes(trim($_POST[$name])) : trim($_POST[$name]);
		} else if (isset($_COOKIE[$name.($page!='' ? sprintf('_%s', $page) : '')])) {
			$rez = $magic ? stripslashes(trim($_COOKIE[$name.($page!='' ? sprintf('_%s', $page) : '')])) 
						  : trim($_COOKIE[$name.($page!='' ? sprintf('_%s', $page) : '')]);
			$putToCookie = false;
		}
		if ($putToCookie)
			setcookie($name.($page!='' ? sprintf('_%s', $page) : ''), $rez, $exp, '/');
		return $rez;
	}
}

// Get GET, POST, SESSION value and save it (if need)
if (!function_exists('fooddy_get_value_gps')) {
	function fooddy_get_value_gps($name, $defa='', $page='') {
		static $magic = 0;
		if ($magic === 0) {
			$magic = version_compare(phpversion(), '5.4', '>=')
					|| (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()==1) 
					|| (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime()==1) 
					|| strtolower(ini_get('magic_quotes_sybase'))=='on';
		}
		$putToSession = $page!='';
		$rez = $defa;
		if (isset($_GET[$name])) {
			$rez = $magic ? stripslashes(trim($_GET[$name])) : trim($_GET[$name]);
		} else if (isset($_POST[$name])) {
			$rez = $magic ? stripslashes(trim($_POST[$name])) : trim($_POST[$name]);
		} else if (isset($_SESSION[$name.($page!='' ? sprintf('_%s', $page) : '')])) {
			$rez = $magic ? stripslashes(trim($_SESSION[$name.($page!='' ? sprintf('_%s', $page) : '')])) 
						  : trim($_SESSION[$name.($page!='' ? sprintf('_%s', $page) : '')]);
			$putToSession = false;
		}
		if ($putToSession)
			fooddy_set_session_value($name, $rez, $page);
		return $rez;
	}
}

// Save value into session
if (!function_exists('fooddy_set_session_value')) {
	function fooddy_set_session_value($name, $value, $page='') {
		if (!session_id()) session_start();
		$_SESSION[$name.($page!='' ? sprintf('_%s', $page) : '')] = $value;
	}
}

// Save value into session
if (!function_exists('fooddy_del_session_value')) {
	function fooddy_del_session_value($name, $page='') {
		if (!session_id()) session_start();
		unset($_SESSION[$name.($page!='' ? '_'.($page) : '')]);
	}
}





/* Colors manipulations
----------------------------------------------------------------------------------------------------- */

if (!function_exists('fooddy_hex2rgb')) {
	function fooddy_hex2rgb($hex) {
		$dec = hexdec(substr($hex, 0, 1)== '#' ? substr($hex, 1) : $hex);
		return array('r'=> $dec >> 16, 'g'=> ($dec & 0x00FF00) >> 8, 'b'=> $dec & 0x0000FF);
	}
}

if (!function_exists('fooddy_hex2rgba')) {
	function fooddy_hex2rgba($hex, $alpha) {
		$rgb = fooddy_hex2rgb($hex);
		return 'rgba('.intval($rgb['r']).','.intval($rgb['g']).','.intval($rgb['b']).','.floatval($alpha).')';
	}
}

if (!function_exists('fooddy_hex2hsb')) {
	function fooddy_hex2hsb($hex, $h=0, $s=0, $b=0) {
		$hsb = fooddy_rgb2hsb(fooddy_hex2rgb($hex));
		$hsb['h'] = min(359, $hsb['h'] + $h);
		$hsb['s'] = min(100, $hsb['s'] + $s);
		$hsb['b'] = min(100, $hsb['b'] + $b);
		return $hsb;
	}
}

if (!function_exists('fooddy_rgb2hsb')) {
	function fooddy_rgb2hsb($rgb) {
		$hsb = array();
		$hsb['b'] = max(max($rgb['r'], $rgb['g']), $rgb['b']);
		$hsb['s'] = ($hsb['b'] <= 0) ? 0 : round(100*($hsb['b'] - min(min($rgb['r'], $rgb['g']), $rgb['b'])) / $hsb['b']);
		$hsb['b'] = round(($hsb['b'] /255)*100);
		if (($rgb['r']==$rgb['g']) && ($rgb['g']==$rgb['b'])) $hsb['h'] = 0;
		else if($rgb['r']>=$rgb['g'] && $rgb['g']>=$rgb['b']) $hsb['h'] = 60*($rgb['g']-$rgb['b'])/($rgb['r']-$rgb['b']);
		else if($rgb['g']>=$rgb['r'] && $rgb['r']>=$rgb['b']) $hsb['h'] = 60  + 60*($rgb['g']-$rgb['r'])/($rgb['g']-$rgb['b']);
		else if($rgb['g']>=$rgb['b'] && $rgb['b']>=$rgb['r']) $hsb['h'] = 120 + 60*($rgb['b']-$rgb['r'])/($rgb['g']-$rgb['r']);
		else if($rgb['b']>=$rgb['g'] && $rgb['g']>=$rgb['r']) $hsb['h'] = 180 + 60*($rgb['b']-$rgb['g'])/($rgb['b']-$rgb['r']);
		else if($rgb['b']>=$rgb['r'] && $rgb['r']>=$rgb['g']) $hsb['h'] = 240 + 60*($rgb['r']-$rgb['g'])/($rgb['b']-$rgb['g']);
		else if($rgb['r']>=$rgb['b'] && $rgb['b']>=$rgb['g']) $hsb['h'] = 300 + 60*($rgb['r']-$rgb['b'])/($rgb['r']-$rgb['g']);
		else $hsb['h'] = 0;
		$hsb['h'] = round($hsb['h']);
		return $hsb;
	}
}

if (!function_exists('fooddy_hsb2rgb')) {
	function fooddy_hsb2rgb($hsb) {
		$rgb = array();
		$h = round($hsb['h']);
		$s = round($hsb['s']*255/100);
		$v = round($hsb['b']*255/100);
		if ($s == 0) {
			$rgb['r'] = $rgb['g'] = $rgb['b'] = $v;
		} else {
			$t1 = $v;
			$t2 = (255-$s)*$v/255;
			$t3 = ($t1-$t2)*($h%60)/60;
			if ($h==360) $h = 0;
			if ($h<60) { 		$rgb['r']=$t1; $rgb['b']=$t2; $rgb['g']=$t2+$t3; }
			else if ($h<120) {	$rgb['g']=$t1; $rgb['b']=$t2; $rgb['r']=$t1-$t3; }
			else if ($h<180) {	$rgb['g']=$t1; $rgb['r']=$t2; $rgb['b']=$t2+$t3; }
			else if ($h<240) {	$rgb['b']=$t1; $rgb['r']=$t2; $rgb['g']=$t1-$t3; }
			else if ($h<300) {	$rgb['b']=$t1; $rgb['g']=$t2; $rgb['r']=$t2+$t3; }
			else if ($h<360) {	$rgb['r']=$t1; $rgb['g']=$t2; $rgb['b']=$t1-$t3; }
			else {				$rgb['r']=0;   $rgb['g']=0;   $rgb['b']=0; }
		}
		return array('r'=>round($rgb['r']), 'g'=>round($rgb['g']), 'b'=>round($rgb['b']));
	}
}

if (!function_exists('fooddy_rgb2hex')) {
	function fooddy_rgb2hex($rgb) {
		$hex = array(
			dechex($rgb['r']),
			dechex($rgb['g']),
			dechex($rgb['b'])
		);
		return '#'.(strlen($hex[0])==1 ? '0' : '').($hex[0]).(strlen($hex[1])==1 ? '0' : '').($hex[1]).(strlen($hex[2])==1 ? '0' : '').($hex[2]);
	}
}

if (!function_exists('fooddy_hsb2hex')) {
	function fooddy_hsb2hex($hsb) {
		return fooddy_rgb2hex(fooddy_hsb2rgb($hsb));
	}
}






/* String manipulations
----------------------------------------------------------------------------------------------------- */

// Replace macros in the string
if (!function_exists('fooddy_prepare_macros')) {
	function fooddy_prepare_macros($str) {
		return str_replace(
			array("{{",  "}}",   "[[",  "]]",   "||"),
			array("<i>", "</i>", "<b>", "</b>", "<br>"),
			$str);
	}
}

// Remove macros from the string
if (!function_exists('fooddy_remove_macros')) {
	function fooddy_remove_macros($str) {
		return str_replace(
			array("{{", "}}", "[[", "]]", "||"),
			array("",   "",   "",   "",   " "),
			$str);
	}
}

// Check value for "on" | "off" | "inherit" values
if (!function_exists('fooddy_is_on')) {
	function fooddy_is_on($prm) {
		return $prm>0 || in_array(strtolower($prm), array('true', 'on', 'yes', 'show'));
	}
}
if (!function_exists('fooddy_is_off')) {
	function fooddy_is_off($prm) {
		return empty($prm) || $prm===0 || in_array(strtolower($prm), array('false', 'off', 'no', 'none', 'hide'));
	}
}
if (!function_exists('fooddy_is_inherit')) {
	function fooddy_is_inherit($prm) {
		return in_array(strtolower($prm), array('inherit'));		//array('inherit', 'default')
	}
}

// Return truncated string
if (!function_exists('fooddy_strshort')) {
	function fooddy_strshort($str, $maxlength, $add='...') {
	//	if ($add && substr($add, 0, 1) != ' ')
	//		$add .= ' ';
		if ($maxlength < 0) 
			return '';
		if ($maxlength == 0)
			return '';
		if ($maxlength >= strlen($str)) 
			return strip_tags($str);
		$str = substr(strip_tags($str), 0, $maxlength - strlen($add));
		$ch = substr($str, $maxlength - strlen($add), 1);
		if ($ch != ' ') {
			for ($i = strlen($str) - 1; $i > 0; $i--)
				if (substr($str, $i, 1) == ' ') break;
			$str = trim(substr($str, 0, $i));
		}
		if (!empty($str) && strpos(',.:;-', substr($str, -1))!==false) $str = substr($str, 0, -1);
		return ($str) . ($add);
	}
}

// Unserialize string (try replace \n with \r\n)
if (!function_exists('fooddy_unserialize')) {
	function fooddy_unserialize($str) {
		if ( is_serialized($str) ) {
			try {
				$data = @unserialize($str);
			} catch (Exception $e) {
				dcl($e->getMessage());
				$data = false;
			}
			if ($data===false) {
				try {
					$data = @unserialize(str_replace("\n", "\r\n", $str));
				} catch (Exception $e) {
					dcl($e->getMessage());
					$data = false;
				}
			}
			//if ($data===false) $data = @unserialize(str_replace(array("\n", "\r"), array('\\n','\\r'), $str));
			return $data;
		} else
			return $str;
	}
}




/* Media: images, galleries, audio, video
----------------------------------------------------------------------------------------------------- */

// Get image sizes from image url (if image in the uploads folder)
if (!function_exists('fooddy_getimagesize')) {
	function fooddy_getimagesize($url) {
	
		// Get upload path & dir
		$upload_info = wp_upload_dir();

		// Where check file
		$locations = array(
			'uploads' => array(
				'dir' => $upload_info['basedir'],
				'url' => $upload_info['baseurl']
				),
			'child' => array(
				'dir' => get_stylesheet_directory(),
				'url' => get_stylesheet_directory_uri()
				),
			'theme' => array(
				'dir' => get_template_directory(),
				'url' => get_template_directory_uri()
				)
			);
		
		$img_size = false;

		$url = fooddy_remove_protocol_from_url($url);
		
		foreach ($locations as $key=>$loc) {

			$loc['url'] = fooddy_remove_protocol_from_url($loc['url']);
			
			// Check if $img_url is local.
			if ( false === strpos($url, $loc['url']) ) continue;
			
			// Get path of image.
			$img_path = $loc['dir'] . str_replace($loc['url'], '', $url);
		
			// Check if img path exists, and is an image indeed.
			if ( !file_exists($img_path)) continue;
	
			// Get image size
			$img_size = getimagesize($img_path);
			break;
		}
		
		return $img_size;
	}
}

// Clear thumb sizes from image name
if (!function_exists('fooddy_clear_thumb_size')) {
	function fooddy_clear_thumb_size($url) {
		$pi = pathinfo($url);
		$parts = explode('-', $pi['filename']);
		$suff = explode('x', $parts[count($parts)-1]);
		if (count($suff)==2 && (int) $suff[0] > 0 && (int) $suff[1] > 0) {
			array_pop($parts);
			$url = $pi['dirname'] . '/' . join('-', $parts) . '.' . $pi['extension'];
		}
		return $url;
	}
}

// Add thumb sizes to image name
if (!function_exists('fooddy_add_thumb_size')) {
	function fooddy_add_thumb_size($url, $thumb_size, $check_exists=true) {
		$pi = pathinfo($url);
		$parts = explode('-', $pi['filename']);
		// Remove image sizes from filename
		$suff = explode('x', $parts[count($parts)-1]);
		if (count($suff)==2 && (int) $suff[0] > 0 && (int) $suff[1] > 0) {
			array_pop($parts);
		}
		// Add new image sizes
		global $_wp_additional_image_sizes;
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) && in_array( $thumb_size, array_keys( $_wp_additional_image_sizes ) ) ) {
			if (intval( $_wp_additional_image_sizes[$thumb_size]['width'] ) > 0 && intval( $_wp_additional_image_sizes[$thumb_size]['height'] ) > 0)
				$parts[] = intval( $_wp_additional_image_sizes[$thumb_size]['width'] ) . 'x' . intval( $_wp_additional_image_sizes[$thumb_size]['height'] );
		}
		$pi['filename'] = join('-', $parts);
		$new_url = $pi['dirname'] . '/' . $pi['filename'] . '.' . $pi['extension'];
		if ($check_exists) {
			$uploads_info = wp_upload_dir();
			$uploads_url = $uploads_info['baseurl'];
			$uploads_dir = $uploads_info['basedir'];
			if (strpos($new_url, $uploads_url)!==false) {
				if (!file_exists(str_replace($uploads_url, $uploads_dir, $new_url)))
					$new_url = $url;
			}
		}
		return $new_url;
	}
}

// Return image size multiplier
if (!function_exists('fooddy_get_thumb_size')) {
	function fooddy_get_thumb_size($ts) {
		static $retina = '-';
		if ($retina=='-') $retina = fooddy_get_retina_multiplier() > 1 ? '-@retina' : '';
		return ($ts=='post-thumbnail' ? '' : 'fooddy-thumb-') . $ts . $retina;
	}
}


// Return url from first <img> tag inserted in post
if (!function_exists('fooddy_get_post_image')) {
	function fooddy_get_post_image($post_text='', $src=true) {
		global $post;
		$img = '';
		if (empty($post_text)) $post_text = $post->post_content;
		if (preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $post_text, $matches)) {
			$img = $matches[$src ? 1 : 0][0];
		}
		return $img;
	}
}


// Return url from first <audio> tag inserted in post
if (!function_exists('fooddy_get_post_audio')) {
	function fooddy_get_post_audio($post_text='', $src=true) {
		global $post;
		$img = '';
		if (empty($post_text)) $post_text = $post->post_content;
		if ($src) {
			if (preg_match_all('/<audio.+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $post_text, $matches)) {
				$img = $matches[1][0];
			}
		} else {
			$img = fooddy_get_tag($post_text, '<audio', '</audio>');
			if (empty($mg)) {
				$img = do_shortcode(fooddy_get_tag($post_text, '[audio', '[/audio]'));
			}
		}
		return $img;
	}
}


// Return url from first <video> tag inserted in post
if (!function_exists('fooddy_get_post_video')) {
	function fooddy_get_post_video($post_text='', $src=true) {
		global $post;
		$img = '';
		if (empty($post_text)) $post_text = $post->post_content;
		if ($src) {
			if (preg_match_all('/<video.+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $post_text, $matches)) {
				$img = $matches[1][0];
			}
		} else {
			$img = fooddy_get_tag($post_text, '<video', '</video>');
			if (empty($mg)) {
				$img = do_shortcode(fooddy_get_tag($post_text, '[video', '[/video]'));
			}
		}
		return $img;
	}
}


// Return url from first <iframe> tag inserted in post
if (!function_exists('fooddy_get_post_iframe')) {
	function fooddy_get_post_iframe($post_text='', $src=true) {
		global $post;
		$img = '';
		if (empty($post_text)) $post_text = $post->post_content;
		if ($src) {
			if (preg_match_all('/<iframe.+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $post_text, $matches)) {
				$img = $matches[1][0];
			}
		} else
			$img = fooddy_get_tag($post_text, '<iframe', '</iframe>');
		return $img;
	}
}


// Add 'autoplay' feature in the video
if (!function_exists('fooddy_make_video_autoplay')) {
	function fooddy_make_video_autoplay($video) {
		if (($pos = strpos($video, '<video'))!==false) {
			$video = str_replace('<video', '<video autoplay="autoplay"', $video);
		} else if (($pos = strpos($video, '<iframe'))!==false) {
			if (preg_match('/(<iframe.+src=[\'"])([^\'"]+)([\'"][^>]*>)(.*)/i', $video, $matches)) {
				$video = $matches[1] . $matches[2] . (strpos($matches[2], '?')!==false ? '&' : '?') . 'autoplay=1' . $matches[3] . $matches[4];
			}
		}
		return $video;
	}
}

// Check if image in the uploads folder
if (!function_exists('fooddy_is_from_uploads')) {
	function fooddy_is_from_uploads($url) {
		$local = false;
		$uploads_info = wp_upload_dir();
		$uploads_url = $uploads_info['baseurl'];
		$uploads_dir = $uploads_info['basedir'];
		return $local = strpos($url, $uploads_url)!==false && file_exists(str_replace($uploads_url, $uploads_dir, $url));
	}
}


/* Init WP Filesystem before theme init
------------------------------------------------------------------- */
if (!function_exists('fooddy_init_filesystem')) {
	add_action( 'after_setup_theme', 'fooddy_init_filesystem', 0);
	function fooddy_init_filesystem() {
        if( !function_exists('WP_Filesystem') ) {
            require_once  trailingslashit(ABSPATH) .'wp-admin/includes/file.php';
        }
		if (is_admin()) {
			$url = admin_url();
			$creds = false;
			// First attempt to get credentials.
			if ( function_exists('request_filesystem_credentials') && false === ( $creds = request_filesystem_credentials( $url, '', false, false, array() ) ) ) {
				// If we comes here - we don't have credentials
				// so the request for them is displaying no need for further processing
				return false;
			}
	
			// Now we got some credentials - try to use them.
			if ( !WP_Filesystem( $creds ) ) {
				// Incorrect connection data - ask for credentials again, now with error message.
				if ( function_exists('request_filesystem_credentials') ) request_filesystem_credentials( $url, '', true, false );
				return false;
			}
			
			return true; // Filesystem object successfully initiated.
		} else {
            WP_Filesystem();
		}
		return true;
	}
}


// Put data into specified file
if (!function_exists('fooddy_fpc')) {	
	function fooddy_fpc($file, $data, $flag=0) {
		global $wp_filesystem;
		if (!empty($file)) {
			if (isset($wp_filesystem) && is_object($wp_filesystem)) {
				$file = str_replace(ABSPATH, $wp_filesystem->abspath(), $file);
				// Attention! WP_Filesystem can't append the content to the file!
				// That's why we have to read the contents of the file into a string,
				// add new content to this string and re-write it to the file if parameter $flag == FILE_APPEND!
				return $wp_filesystem->put_contents($file, ($flag==FILE_APPEND && $wp_filesystem->exists($file) ? $wp_filesystem->get_contents($file) : '') . $data, false);
			} else {
				if (fooddy_is_on(fooddy_get_theme_option('debug_mode')))
					throw new Exception(sprintf(esc_html__('WP Filesystem is not initialized! Put contents to the file "%s" failed', 'fooddy'), $file));
			}
		}
		return false;
	}
}

// Get text from specified file
if (!function_exists('fooddy_fgc')) {	
	function fooddy_fgc($file) {
		global $wp_filesystem;
		if (!empty($file)) {
			if (isset($wp_filesystem) && is_object($wp_filesystem)) {
				$file = str_replace(ABSPATH, $wp_filesystem->abspath(), $file);
				return $wp_filesystem->get_contents($file);
			} else {
				if (fooddy_is_on(fooddy_get_theme_option('debug_mode')))
					throw new Exception(sprintf(esc_html__('WP Filesystem is not initialized! Get contents from the file "%s" failed', 'fooddy'), $file));
			}
		}
		return '';
	}
}

// Get array with rows from specified file
if (!function_exists('fooddy_fga')) {	
	function fooddy_fga($file) {
		global $wp_filesystem;
		if (!empty($file)) {
			if (isset($wp_filesystem) && is_object($wp_filesystem)) {
				$file = str_replace(ABSPATH, $wp_filesystem->abspath(), $file);
				return $wp_filesystem->get_contents_array($file);
			} else {
				if (fooddy_is_on(fooddy_get_theme_option('debug_mode')))
					throw new Exception(sprintf(esc_html__('WP Filesystem is not initialized! Get rows from the file "%s" failed', 'fooddy'), $file));
			}
		}
		return array();
	}
}

// Remove unsafe characters from file/folder path
if (!function_exists('fooddy_esc')) {	
	function fooddy_esc($file) {
		return str_replace(array('\\', '~', '$', ':', ';', '+', '>', '<', '|', '"', "'", '`', "\xFF", "\x0A", "\x0D", '*', '?', '^'), '/', trim($file));
	}
}


// Return .min version (if exists and filetime .min > filetime original) instead original
if (!function_exists('fooddy_check_min_file')) {	
	function fooddy_check_min_file($file, $dir) {
		if (substr($file, -3)=='.js') {
			if (substr($file, -7)!='.min.js' && fooddy_is_off(fooddy_get_theme_option('debug_mode'))) {
				$dir = trailingslashit($dir);
				$file_min = substr($file, 0, strlen($file)-3).'.min.js';
				if (file_exists($dir . $file_min) && filemtime($dir . $file) <= filemtime($dir . $file_min)) $file = $file_min;
			}
		} else if (substr($file, -4)=='.css') {
			if (substr($file, -8)!='.min.css'  && fooddy_is_off(fooddy_get_theme_option('debug_mode'))) {
				$dir = trailingslashit($dir);
				$file_min = substr($file, 0, strlen($file)-3).'.min.css';
				if (file_exists($dir . $file_min) && filemtime($dir . $file) <= filemtime($dir . $file_min)) $file = $file_min;
			}
		}
		return $file;
	}
}


// Check if file/folder present in the child theme and return path (url) to it. 
// Else - path (url) to file in the main theme dir
if (!function_exists('fooddy_get_file_dir')) {	
	function fooddy_get_file_dir($file, $return_url=false) {
		if ($file[0]=='/') $file = substr($file, 1);
		$theme_dir = get_template_directory();
		$theme_url = get_template_directory_uri();
		$child_dir = get_stylesheet_directory();
		$child_url = get_stylesheet_directory_uri();
		$dir = '';
		if (file_exists(($child_dir).'/'.($file)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.fooddy_check_min_file($file, $child_dir);
		else if (file_exists(($theme_dir).'/'.($file)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.fooddy_check_min_file($file, $theme_dir);
		return $dir;
	}
}

if (!function_exists('fooddy_get_file_url')) {	
	function fooddy_get_file_url($file) {
		return fooddy_get_file_dir($file, true);
	}
}

// Detect folder location with same algorithm as file (see above)
if (!function_exists('fooddy_get_folder_dir')) {	
	function fooddy_get_folder_dir($folder, $return_url=false) {
		if ($folder[0]=='/') $folder = substr($folder, 1);
		$theme_dir = get_template_directory();
		$theme_url = get_template_directory_uri();
		$child_dir = get_stylesheet_directory();
		$child_url = get_stylesheet_directory_uri();
		$dir = '';
		if (is_dir(($child_dir).'/'.($folder)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.($folder);
		else if (file_exists(($theme_dir).'/'.($folder)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.($folder);
		return $dir;
	}
}

if (!function_exists('fooddy_get_folder_url')) {	
	function fooddy_get_folder_url($folder) {
		return fooddy_get_folder_dir($folder, true);
	}
}


// Remove protocol part from URL
if (!function_exists('fooddy_remove_protocol_from_url')) {
	function fooddy_remove_protocol_from_url($url) {
		if (($pos=strpos($url, '://'))!==false) $url = substr($url, $pos+3);
		return $url;
	}
}

// Add parameters to URL
if (!function_exists('fooddy_add_to_url')) {
	function fooddy_add_to_url($url, $prm) {
		if (is_array($prm) && count($prm) > 0) {
			$separator = strpos($url, '?')===false ? '?' : '&';
			foreach ($prm as $k=>$v) {
				$url .= $separator . urlencode($k) . '=' . urlencode($v);
				$separator = '&';
			}
		}
		return $url;
	}
}
?>