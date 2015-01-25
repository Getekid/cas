<?php
/**
*
* @package phpBB Extension - CAS Authentication plugin
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace getekid\cas\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class cas_login_listener implements EventSubscriberInterface
{
	/* @var \phpbb\config\config */
	protected $config;
	
	/* @var \phpbb\template\template */
	protected $template;
	
	static public function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title' => 'add_cas_login_text',
		);
	}
	
	/**
	* Constructor
	*
	* @param	\phpbb\config\config		$config		Config object
	* @param	\phpbb\template\template	$template	Template object
	*/
	
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template)
	{
		$this->config = $config;
		$this->template = $template;
	}
	
	public function add_cas_login_text($event)
	{
		$this->template->assign_vars(array(
			'S_AUTH_IS_CAS' => ($this->config['auth_method'] == 'cas') ? true : false,
			'L_CAS_LOGIN'	=> $this->config['cas_login'],
		));
	}
}
