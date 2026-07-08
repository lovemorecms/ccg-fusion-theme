<?php
/**
 * Homepage pattern helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme asset URL for homepage images.
 *
 * @param string $relative Path under theme root.
 */
function ccg_home_asset( $relative ) {
	return trailingslashit( get_template_directory_uri() ) . ltrim( $relative, '/' );
}

/**
 * Site URL for prototype-style paths.
 *
 * @param string $path Path or hash link.
 */
function ccg_home_url( $path = '#' ) {
	if ( '#' === $path || '' === $path ) {
		return '#';
	}
	if ( 0 === strpos( $path, 'http' ) ) {
		return $path;
	}
	$hash = '';
	if ( false !== strpos( $path, '#' ) ) {
		list( $path, $hash ) = explode( '#', $path, 2 );
	}
	$url = home_url( user_trailingslashit( $path ) );
	return $hash ? $url . '#' . $hash : $url;
}
