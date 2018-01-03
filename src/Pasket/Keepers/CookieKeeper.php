<?php

namespace Pasket\Keepers;

use Pasket\Keepers\CookieManipulator;
use Pasket\Keepers\Keeper;
use Pasket\Security\Encryption;

class CookieKeeper extends Keeper {

	protected $name;
	
	protected $manipulator;
	
	protected $encryptor;

	public	function __construct($name, $cookie_manipulator = null)
	{
		$this->name = $name;

		$this->encryptor = new Encryption('qweasd12334341d');

		$this->manipulator = $cookie_manipulator ? $cookie_manipulator : new CookieManipulator();
	}

	public function get()
	{
		$data = $this->manipulator->get($this->name);

		if(!$data)
			return false;

		if( ($data = base64_decode($data)) === false )
			throw new \Exception('Could not get the data.');

		$data = json_decode( $data, true );

		if (json_last_error() !== JSON_ERROR_NONE)
		    throw new \Exception('Could not get the data.');

		return $this->encryptor->decrypt($data);
	}

	public function save($data)
	{
		$data = base64_encode( json_encode( $this->encryptor->encrypt($data) ) );

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Could not save the data.');
        }

		$this->manipulator->set(
			$this->name,
			$data,
			time()+3600
		);
	}

	public function delete()
	{
		$this->manipulator->unset($this->name);
	}
}