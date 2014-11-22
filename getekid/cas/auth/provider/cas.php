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
 */
class cas extends \phpbb\auth\provider\base
{

	/**
	 * CAS Authentication Constructor
	 *
	 * @param	\phpbb\db\driver\driver_interface		$db		Database object
	 * @param	\phpbb\config\config		$config		Config object
	 * @param	\phpbb\user			$user		User object
	 */

	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\user $user)
	{
		$this->db = $db;
		$this->config = $config;
		$this->user = $user;
	}

	public function login($username, $password)
{}

	public function acp()
	{
		// These are fields required in the config table
		return array(
			'cas_server', 'cas_port', 'cas_uri',
		);
	}

	public function get_acp_template($new_config)
	{	
		$this->user->add_lang_ext('getekid/cas','cas_acp');
		return array(
			'TEMPLATE_FILE'	=> '@getekid_cas/auth_provider_cas.html',
			'TEMPLATE_VARS'	=> array(
				'AUTH_CAS_SERVER'		=> $new_config['cas_server'],
				'AUTH_CAS_PORT'		=> $new_config['cas_port'],
				'AUTH_CAS_URI'			=> $new_config['cas_uri'],
			),
		);
	}
}
?>