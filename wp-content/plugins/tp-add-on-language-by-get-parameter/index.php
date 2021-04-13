<?php
/*
Plugin Name: TranslatePress - Language by GET parameter Add-on
Plugin URI: https://translatepress.com/
Description: Extends the functionality of TranslatePress by enabling the language in the URL to be encoded as a GET parameter instead of directory.
Version: 1.0.3
Author: Cozmoslabs, Razvan Mocanu
Author URI: https://translatepress.com/
License: GPL2

== Copyright ==
Copyright 2018 Cozmoslabs (www.cozmoslabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TRP_GP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TRP_GP_PLUGIN_VERSION', '1.0.1' );

function trp_gp_is_tp_active() {
// If TP is not active, do nothing
	if ( class_exists( 'TRP_Translate_Press' ) ) {
		return true;
	}else{
		return false;
	}

}

/**
 * Returns filtered parameter name
 *
 */
function trp_gp_get_parameter_name(){
	return apply_filters( 'trp_gp_lang_parameter', 'lang' );
}


/**
 * Returns language from the given url if it is encoded into GET parameter
 *
 * Returns the url-slug, not the language code
 *
 * @param $lang
 * @param $url
 *
 * @return string
 */
function trp_gp_get_lang_from_get( $lang, $url ){
	$lang_parameter = trp_gp_get_parameter_name();
	parse_str(parse_url( $url, PHP_URL_QUERY), $get );
	if ( isset ( $get[ $lang_parameter ] ) && $get[ $lang_parameter ] != '' ){
		$lang = sanitize_text_field( trim( $get[ $lang_parameter ], '/' ) );
	}else{
		$lang = null;
	}
	return $lang;
}
add_filter( 'trp_get_lang_from_url_string', 'trp_gp_get_lang_from_get', 10, 2 );

/**
 * Add script to set cookie to change language.
 * Only active when TP ADL Add-on is active.
 */
function trp_gp_cookie_adding(){
	if ( ! trp_gp_is_tp_active() ){
		return;
	}

	// dependent on TP Add-on Automatic Detection Language
	wp_enqueue_script( 'trp-gp-language-cookie', TRP_GP_PLUGIN_URL . 'assets/js/trp-gp-language-cookie.js', array( 'jquery', 'trp-language-cookie' ), TRP_GP_PLUGIN_VERSION );
	wp_localize_script( 'trp-gp-language-cookie', 'trp_gp_language_cookie_data', array( 'lang_parameter' => trp_gp_get_parameter_name() ) );
}
add_action( 'wp_enqueue_scripts', 'trp_gp_cookie_adding' );

/**
 * Returns url encoded with the language code given.
 *
 * Used in TRP_Url_Converter method get_url_for_language()
 *
 * @param $new_url
 * @param $url
 * @param $language
 * @param $abs_home
 * @param $current_lang_root
 * @param $new_language_root
 *
 * @return string
 */
function trp_gp_get_url_for_language( $new_url, $url, $language, $abs_home, $current_lang_root, $new_language_root ){
	return trp_gp_add_language_param_to_link( $url, $language );
}
add_filter( 'trp_get_url_for_language', 'trp_gp_get_url_for_language', 10, 6 );

/**
 * Returns url encoded with the language given.
 *
 * Used in TRP_Url_Converter method add_language_to_home_url()
 *
 * @param $new_url
 * @param $abs_home
 * @param $language_code
 * @param $path
 * @param $old_url
 *
 * @return string
 */
function trp_gp_add_custom_query_var( $new_url, $abs_home, $language_code, $path, $old_url ){
	return trp_gp_add_language_param_to_link( $old_url, $language_code );
}
add_filter( 'trp_home_url', 'trp_gp_add_custom_query_var', 10, 5 );

/**
 * Returns url encoded with the current language.
 *
 * @param $permalink
 *
 * @return string
 */
function trp_gp_correct_link( $permalink ){
	return trp_gp_add_language_param_to_link( $permalink );
}
add_filter( 'post_link', 'trp_gp_correct_link', 1, 1 );
add_filter( 'page_link', 'trp_gp_correct_link', 1, 1 );
add_filter( 'post_type_link', 'trp_gp_correct_link', 1, 1 );
add_filter( 'get_canonical_url', 'trp_gp_correct_link', 1, 1 );
add_filter( 'get_comment_link', 'trp_gp_correct_link', 1, 1 );


/**
 * Encode the given url to contain GET parameter for language.
 *
 * If no language code is given, uses default language.
 * The url slug is encoded to the link, not the language code.
 *
 * @param string $link                  Link to encode.
 * @param string $language_code         Refers to the language code, not language url slug.
 *
 * @return string                       Encoded link.
 */
function trp_gp_add_language_param_to_link( $link, $language_code = null ){
	if ( ! trp_gp_is_tp_active() ){
		return $link;
	}

	global $TRP_LANGUAGE;
	if ( $language_code == null ){
		$language_code = $TRP_LANGUAGE;
	}
	$trp = TRP_Translate_Press::get_trp_instance();
	$trp_settings = $trp->get_component( 'settings' );
	$settings = $trp_settings->get_settings();
	$lang_parameter = trp_gp_get_parameter_name();
	if ( isset( $settings['add-subdirectory-to-default-language'] ) && $settings['add-subdirectory-to-default-language'] == 'no' && $language_code == $settings['default-language'] ) {
		return remove_query_arg( $lang_parameter, $link );
	}
	if ( $language_code ) {
		// this could be called inside get_permalink, and $TRP_LANGUAGE temporarily doesn't have value in order to return the default url
		$url_slug = $settings['url-slugs'][ $language_code ];
		$link = add_query_arg( $lang_parameter, $url_slug, $link );
	}
	return $link;
}

/**
 * Adds a hidden input to forms, in order to keep the language GET parameter.
 *
 * @param $html
 * @param $trp_language
 * @param $language_url_slug
 *
 * @return string
 */
function trp_gp_form_inputs( $html, $trp_language, $language_url_slug ){
	$html .= '<input type="hidden" name="' . trp_gp_get_parameter_name() . '" value="'. $language_url_slug .'"/>';
	return $html;
}
add_filter( 'trp_form_inputs', 'trp_gp_form_inputs', 10, 3 );

