<?php  
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/* Transform string to slug
=============================================*/
if(!function_exists('proradio_slugify')){
function proradio_slugify($string = 'proradioslug', $replace = array(), $delimiter = '-') {
  // https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
  if (!extension_loaded('iconv')) {
	throw new Exception('iconv module not loaded');
  }
  // Save the old locale and set the new locale to UTF-8
  $oldLocale = setlocale(LC_ALL, '0');
  setlocale(LC_ALL, 'en_US.UTF-8');
  $string = str_replace(' ','',$string);


  $clean = iconv(
    'UTF-8',
   'ASCII//IGNORE'
   , $string
  );

 
  if (!empty($replace)) {
	$clean = str_replace((array) $replace, ' ', $clean);
  }
  $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
  $clean = strtolower($clean);
  $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
  $clean = trim($clean, $delimiter);
  // Revert back to the old locale
  setlocale(LC_ALL, $oldLocale);
  return $clean;
}}
