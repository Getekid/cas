<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

namespace getekid\cas\auth\provider;

/**
 * phpCAS authentication provider for phpBB3
 * This is for authentication via the integrated user table
 */
class cas extends \phpbb\auth\provider\base
{

	public function login($username, $password)
{}

	public function get_acp_template($new_config)
	{
		return array(
			'TEMPLATE_FILE'	=> 'auth_provider_cas.html',
			'TEMPLATE_VARS'	=> array(
				'AUTH_CAS_PORT'		=> $new_config['cas_port'],
				'AUTH_CAS_SERVER'		=> $new_config['cas_server'],
				'AUTH_CAS_URL'			=> $new_config['cas_url'],
			),
		);
	}
}
