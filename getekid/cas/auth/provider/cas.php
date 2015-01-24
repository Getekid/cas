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

if (!defined('IN_PHPBB'))
{
	exit;
}

// Load the CAS lib
include_once('CAS/CAS.php');
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
		
		if ($this->config['cas_host'] && $this->config['cas_port'] && $this->config['cas_uri'])
		{
			// Uncomment to enable debugging
			phpCAS::setDebug();

			// Initialize phpCAS
			phpCAS::client(constant($this->config['cas_version']), $this->config['cas_host'], (int)$this->config['cas_port'], $this->config['cas_uri']);
			
			if ($this->config['cas_cert'])
			{
				// For production use set the CA certificate that is the issuer of the cert
				// on the CAS server and uncomment the line below
				phpCAS::setCasServerCACert($cas_cert);
			}
			else
			{
				// For quick testing you can disable SSL validation of the CAS server.
				// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
				// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
				phpCAS::setNoCasServerValidation();
			}
		}
	}
	
	public function init()
	{
		/*
		 * Check if the input data have the right type.
		 *
		 * This will NOT check for the Client being valid.
		 *
		 * These conditions are to prevent the call of phpCAS:client()
		 * from producing any errors. This way no errors blocking
		 * the user from accessing the board/acp can occure.
		 */
		
		$this->user->add_lang_ext('getekid/cas','cas_acp_errors');
		
		// Check whether the phpCAS library has been successfully loaded.
		if(!class_exists('phpCAS'))
		{
			return $this->user->lang['CAS_ERROR_LIBR'];
		}
		
		// check hostname
		if (empty($this->config['cas_host']) || !preg_match('/[\.\d\-abcdefghijklmnopqrstuvwxyz]*/', $this->config['cas_host']))
		{
		 	return $this->user->lang['CAS_ERROR_HOST'];
		}
		
		// check port
		if (!is_int((int)$this->config['cas_port']) || (int)$this->config['cas_port'] == 0)
		{
		 	return $this->user->lang['CAS_ERROR_PORT'];;
		}
		
		// check URI
		if (!preg_match('/[\.\d\-_abcdefghijklmnopqrstuvwxyz\/]*/', $this->config['cas_uri']))
		{
		 	return $this->user->lang['CAS_ERROR_URI'];;
		}
		
		// If everything is ok, return false for no errors.
		return false;
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
			'cas_version', 'cas_host', 'cas_port', 'cas_uri', 'cas_cert', 'cas_logout',
		);
	}

	public function get_acp_template($new_config)
	{
		$cas_versions = array(
			'CAS_VERSION_1_0' => '1.0',
			'CAS_VERSION_2_0' => '2.0',
			'CAS_VERSION_3_0' => '3.0',
			'SAML_VERSION_1_1'=> 'Sample 1.1',
		);
		
		$cas_version_options = '';
		
		foreach ($cas_versions as $cnst => $version)
		{
			$cas_version_options .= '<option value="' . $cnst . '"' . (($new_config['cas_version']==$cnst) ? ' selected="selected"' : '') . '>' . $version . '</option>';
		}
		
		$this->user->add_lang_ext('getekid/cas','cas_acp');
		return array(
			'TEMPLATE_FILE'	=> '@getekid_cas/auth_provider_cas.html',
			'TEMPLATE_VARS'	=> array(
				'S_AUTH_CAS_LIBR' => (class_exists('phpCAS')) ? true : false,
				'AUTH_CAS_LIBR_VERSION' => (class_exists('phpCAS')) ? 'phpCAS ' . phpCAS::getVersion() : null,
				
				'AUTH_CAS_VERSION_OPTIONS' 	=> $cas_version_options,
				'AUTH_CAS_HOST'			=> $new_config['cas_host'],
				'AUTH_CAS_PORT'			=> $new_config['cas_port'],
				'AUTH_CAS_URI'				=> $new_config['cas_uri'],
				'AUTH_CAS_CERT'			=> $new_config['cas_cert'],
				'S_AUTH_CAS_LOGOUT'	=> ($new_config['cas_logout'] == 0) ? false : true,
			),
		);
	}
	
	public function logout($data, $new_session)
	{
		if ($this->config['cas_logout'] == 1 && phpCAS::isAuthenticated())
		{
			phpCAS::logout();
		}
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
