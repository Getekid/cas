<?php
/**
*
* CAS Authentication plugin extension for the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
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
	'CAS'						=> 'CAS Settings',

	'CAS_LIBR_SUCCESS'			=> 'has loaded successfully!',
	'CAS_LIBR_FAIL'				=> 'phpCAS library has failed to load.',

	'CAS_VERSION'				=> 'CAS Version',
	'CAS_HOST'					=> 'CAS Hostname',
	'CAS_HOST_EXPLAIN'			=> 'Hostname or IP Address of the CAS server.',
	'CAS_PORT'					=> 'CAS Port',
	'CAS_PORT_EXPLAIN'			=> '443 is the standard SSL port.',
	'CAS_URI'					=> 'CAS URI',
	'CAS_URI_EXPLAIN'			=> 'If CAS is not at the root of the host, include a URI (e.g., /cas).',
	'CAS_CERT'					=> 'Certificate Authority PEM Certificate',
	'CAS_CERT_EXPLAIN'			=> 'The PEM certificate of the Certificate Authority that issued the certificate of the CAS server. If omitted, the certificate authority will not be verified.',
	'CAS_LOGIN'					=> 'CAS Login button text',
	'CAS_LOGIN_EXPLAIN'			=> 'The text displayed on the CAS login button.',
	'CAS_DB'					=> 'DB Login',
	'CAS_DB_EXPLAIN'			=> 'Enable the option for loggin in using database authentication.',
	'CAS_DB_LOGIN'				=> 'DB Login button text',
	'CAS_DB_LOGIN_EXPLAIN'		=> 'The text displayed on the DB login button. This button will appear ONLY if the "DB Login" is enabled',
	'CAS_LOGOUT'				=> 'Logout from CAS',
	'CAS_LOGOUT_EXPLAIN'		=> 'When the CAS user logs out from phpbb, then he/she logs out from CAS as well.',
	'CAS_REGISTER'				=> 'Register new users',
	'CAS_REGISTER_EXPLAIN'		=> 'Register a CAS authenticated user that doesn\'t exist in the database.',
	'CAS_REGISTER_MAIL'			=> 'Email mapping',
	'CAS_REGISTER_MAIL_EXPLAIN'	=> 'The email that the new user will have taken from the CAS attributes. If left blank "mail" will be used.',
));
