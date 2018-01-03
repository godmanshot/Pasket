<?php

namespace Pasket\Security;

class Encryption {

	public $key;
	public $cipher;

	public function __construct($key, $cipher = 'AES-128-CBC') {
		$this->key = $key;
		$this->cipher = $cipher;
	}

	public function encrypt($data) {

		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));

		$value = openssl_encrypt(serialize($data), $this->cipher, $this->key, 0, $iv);

		if($value === false)
			throw new \Exception('Encryption failed');

		$iv = base64_encode($iv);

		return ['value' => $value, 'iv' => $iv];
	}

	public function decrypt($data) {

		return unserialize(openssl_decrypt(
            $data['value'], $this->cipher, $this->key, 0, base64_decode($data['iv'])
        ));
	}
}