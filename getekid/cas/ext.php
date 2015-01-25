<?php

namespace getekid\cas;

class ext extends \phpbb\extension\base
{
	// override disable step
	function disable_step($old_state)
	{
		$config = $this->container->get('config');
			
		if ($config['auth_method'] == 'cas')
		{
			$config->set('auth_method', 'db');
		}
		
		return false;
	}
}
