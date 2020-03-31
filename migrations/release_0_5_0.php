<?php
/**
*
* CAS Authentication plugin extension for the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace getekid\cas\migrations;

/**
* Migration class to set default values for the CAS configuration.
*/
class release_0_5_0 extends \phpbb\db\migration\migration
{
	/**
	* {@inheritdoc}
	*/
	public function effectively_installed()
	{
		return (isset($this->config['cas_server']) && isset($this->config['cas_port']) && isset($this->config['cas_uri'])) ? true : false;
	}

	/**
	* {@inheritdoc}
	*/
	public function update_data()
	{
		return array(
			array('config.add',
				array('cas_version', 'CAS_VERSION_1_0')),
			array('config.add',
				array('cas_host', '')),
			array('config.add',
				array('cas_port', '')),
			array('config.add',
				array('cas_uri', '')),
			array('config.add',
				array('cas_cert', '')),
			array('config.add',
				array('cas_login', 'Login with CAS')),
			array('config.add',
				array('cas_db', 0)),
			array('config.add',
				array('cas_db_login', 'Login without CAS')),
			array('config.add',
				array('cas_logout', 0)),
			array('config.add',
				array('cas_register', 0)),
			array('config.add',
				array('cas_register_mail', '')),
		);
	}
}
