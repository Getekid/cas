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
	'CAS_ERROR_LIBR'	=> 'phpCAS library hasn\'t been loaded.<br>Check whether auth/provider/CAS/CAS.php exists.',
	'CAS_ERROR_HOST'	=> 'Invalid CAS hostname.<br>Must be a nonempty link.',
	'CAS_ERROR_PORT'	=> 'Invalid input type for CAS port.<br>Must be a nonzero integer.',
	'CAS_ERROR_URI'		=> 'Invalid CAS URI.<br>Must be a path.',
));
