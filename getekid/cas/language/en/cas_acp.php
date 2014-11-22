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
		'CAS'						=> 'CAS Authentication plugin data',
		'CAS_SERVER'				=> 'CAS Server',
		'CAS_SERVER_EXPLAIN'		=> 'Hostname or IP Address of the CAS server.',
		'CAS_PORT'				=> 'CAS Port',

		'CAS_PORT_EXPLAIN'		=> '443 is the standard SSL port.',
		'CAS_URI'					=> 'CAS URI',
		'CAS_URI_EXPLAIN'			=> 'If CAS is not at the root of the host, include a URI (e.g., /cas).',
	)
);