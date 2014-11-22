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
	'L_CAS_SERVER'			=> 'CAS Server',
	'L_CAS_SERVER_EXPLAIN'		=> 'CAS Server explain.',
	'L_CAS_PORT'		=> 'CAS Port',

	'L_CAS_PORT_EXPLAIN'			=> 'CAS Port explain',
	'L_CAS_URL'					=> 'CAS URL',
	'L_CAS_URL_EXPLAIN'			=> 'CAS URL explain',
	'ACP_CAS_SETTING_SAVED'	=> 'Settings have been saved successfully!',
));
