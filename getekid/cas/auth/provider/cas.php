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

// Load the CAS lib
require_once('CAS/CAS.php');
use \phpCAS;

/**
 * CAS authentication provider for phpBB3
 */
class cas extends \phpbb\auth\provider\base
{
	/**
	 * CAS Authentication Constructor
	 *
	 * @param	\phpbb\db\driver\driver_interface	$db			Database object
	 * @param	\phpbb\config\config				$config		Config object
	 * @param	\phpbb\request\request				$request
	 * @param	\phpbb\user							$user		User object
	 */

	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\request\request $request, \phpbb\user $user)
	{
		$this->db = $db;
		$this->config = $config;
		$this->request = $request;
		$this->user = $user;
		
		// The use of this function has security issues, should be avoided for production use.
		$this->request->enable_super_globals();
		
		if ($this->config['cas_server'] && $this->config['cas_port'] && $this->config['cas_uri'])
		{
			// Uncomment to enable debugging
			phpCAS::setDebug();

			// Initialize phpCAS
			phpCAS::client(CAS_VERSION_2_0, $this->config['cas_server'], (int)$this->config['cas_port'], $this->config['cas_uri']);
			
			// For quick testing you can disable SSL validation of the CAS server.
			// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
			// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
			phpCAS::setNoCasServerValidation();
		}
	}
	
	public function init()
	{		
		return;
	}

	public function login($username, $password)
	{	
		if (!(phpCAS::isAuthenticated()))
		{
			$this->user->session_kill();
			$this->user->session_begin();
		}
		
		phpCAS::forceAuthentication();
		
		return array(
			'status'	=> LOGIN_SUCCESS,
			'error_msg'	=> false,
			'user_row'	=> $this->get_user_row(phpCAS::getUser()),
		);
	}

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
				'AUTH_CAS_PORT'			=> $new_config['cas_port'],
				'AUTH_CAS_URI'			=> $new_config['cas_uri'],
			),
		);
	}
	
	private function get_user_row($username, $default_row = array(), $select_all = true)
	{
		$user_row = $default_row;
    	$sql ='SELECT';
    	if ($select_all)
    	{
			$sql .= ' *';
		}
    	else
    	{
			$sql .= ' user_id, username, user_password, user_passchg, user_email, user_type, user_style, user_rank, user_avatar' /* . ', user_birthday, user_from'*/;
		}
    	$sql .= ' FROM ' . USERS_TABLE . "
        	WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";
    	$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

    	if ($row)
    	{
        	if ( !($row['user_type'] == USER_INACTIVE || $row['user_type'] == USER_IGNORE) )
        	{
            	$user_row = $row;
            }
    	}
    
		return $user_row;
	}	
}
