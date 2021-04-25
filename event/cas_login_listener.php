<?php
/**
*
* CAS Authentication plugin extension for the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace getekid\cas\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class cas_login_listener implements EventSubscriberInterface
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\request\request */
	protected $request;

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\auth\auth */
	protected $auth;

	/* @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config				Config object
	* @param \phpbb\request\request		$request			Request object
	* @param \phpbb\user				$user				User object
	* @param \phpbb\auth\auth			$auth				Auth object
	* @param \phpbb\template\template	$template			Template object
	* @param string						$phpbb_root_path	Path to phpBB's root
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\request\request $request, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\template\template $template, $phpbb_root_path)
	{
		$this->config = $config;
		$this->request = $request;
		$this->auth = $auth;
		$this->user = $user;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
	}

	/**
	* {@inheritdoc}
	*/
	public static function getSubscribedEvents()
	{
		return array(
			'core.session_create_after' => 'login_after_cas_redirect',
			'core.update_session_after' => 'login_after_cas_redirect',
			'core.index_modify_page_title' => 'add_cas_login_text',
		);
	}

	/**
	* Login the user after the CAS redirect.
	*
	* After the CAS login and authentication takes place, the CAS server
	* 	redirects the user back to the forum with a ticket. Then we need
	* 	to rerun the login function for the user to actually login in.
	*
	* @param \phpbb\event\data $event The event object
	*/
	public function login_after_cas_redirect($event)
	{
		// Get the ticket from the URL and login in order to validate it
		$cas_ticket = $this->request->variable('ticket', '', true, \phpbb\request\request_interface::GET);
		if ($cas_ticket)
		{
			// Set a $_SESSION variable true so that we know the ticket is being validated
			$_SESSION['phpBBCAS'] = true;
			$result = $this->auth->login('', '');
		}

		// Login the user if it's a redirection after the ticket was validated
		if (isset($_SESSION['phpBBCAS']))
		{
			unset($_SESSION['phpBBCAS']);
			$result = $this->auth->login('', '');

			if ($result['status'] = LOGIN_SUCCESS)
			{
				$current_page = $this->user->extract_current_page($this->phpbb_root_path);
				redirect($current_page['page']);
			}
			else
			{
				trigger_error($result['error_msg']);
			}
		}
	}

	/**
	* Add CAS login text and booleans for the index.
	*
	* @param \phpbb\event\data $event The event object
	*/
	public function add_cas_login_text($event)
	{
		$this->template->assign_vars(array(
			'S_AUTH_CAS'		=> ($this->config['auth_method'] == 'cas') ? true : false,
			'L_CAS_LOGIN'		=> $this->config['cas_login'],
			'S_AUTH_CAS_DB'		=> ($this->config['cas_db'] == 0) ? false : true,
			'L_CAS_DB_LOGIN'	=> $this->config['cas_db_login'],
		));
	}
}
