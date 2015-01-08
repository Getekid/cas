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
		'CAS_ERROR_HOST' => 'Invalid CAS hostname.<br>Must be a nonempty link.',
		'CAS_ERROR_PORT' => 'Invalid input type for CAS port.<br>Must be a nonzero integer.',
		'CAS_ERROR_URI' => 'Invalid CAS URI.<br>Must be a path.',
	)
);
