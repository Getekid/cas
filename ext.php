<?php
/**
*
* CAS Authentication plugin extension for the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace getekid\cas;

/**
* Extension class for custom enable/disable/purge actions.
*/
class ext extends \phpbb\extension\base
{
	/**
	* {@inheritdoc}
	*/
	public function disable_step($old_state)
	{
		// Revert the Auth method to 'db' if set to 'cas'.
		$config = $this->container->get('config');
		if ($config['auth_method'] == 'cas')
		{
			$config->set('auth_method', 'db');
		}

		return false;
	}
}
