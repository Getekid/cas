<?php
/**
*
* @package phpBB Extension - phpCAS Authentication plugin
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
		'CAS'					=> 'CAS Settings',
		
		'CAS_LIBR_SUCCESS'		=> 'has loaded successfully!',
		'CAS_LIBR_FAIL'			=> 'phpCAS library has failed to load.',
		
		'CAS_VERSION'			=> 'CAS Version',
		'CAS_HOST'				=> 'CAS Hostname',
		'CAS_HOST_EXPLAIN'		=> 'Hostname or IP Address of the CAS server.',
		'CAS_PORT'				=> 'CAS Port',
		'CAS_PORT_EXPLAIN'		=> '443 is the standard SSL port.',
		'CAS_URI'				=> 'CAS URI',
		'CAS_URI_EXPLAIN'		=> 'If CAS is not at the root of the host, include a URI (e.g., /cas).',
		'CAS_CERT'				=> 'Certificate Authority PEM Certificate',
		'CAS_CERT_EXPLAIN'		=> 'The PEM certificate of the Certificate Authority that issued the certificate of the CAS server. If omitted, the certificate authority will not be verified.',
		'CAS_LOGIN'				=> 'Login button text',
		'CAS_LOGIN_EXPLAIN'		=> 'The text displayed on the CAS login button.',
		'CAS_LOGOUT'			=> 'Logout from CAS',
		'CAS_LOGOUT_EXPLAIN'	=> 'When the CAS user logs out from phpbb, then he/she logs out from CAS as well.',
	)
);
