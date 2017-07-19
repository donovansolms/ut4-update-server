<?php

/**
 * General helper functions
 */
class GeneralHelper
{

	/**
	 * pre_print_r wraps a print_r call in <pre> tags
	 * @param mixed $data
	 */
	public static function pre_print_r($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	/**
	 * Generate cryptographically secure random strings.
	 *
	 * @param string $type The type of token to generate
	 * @param number $length The length of the token to generate
	 * @return unknown|number|string The token
	 */
	public static function CryptToken( $type = 'alnum', $length = 8 )
	{
		switch ( $type ) {
			case 'alnum':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'alnumspecial':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_|';
				break;
			case 'alpha':
				$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'hexdec':
				$pool = '0123456789abcdef';
				break;
			case 'numeric':
				$pool = '0123456789';
				break;
			case 'nozero':
				$pool = '123456789';
				break;
			case 'distinct':
				$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
				break;
			default:
				$pool = (string) $type;
				break;
		}


		$crypto_rand_secure = function ( $min, $max ) {
			$range = $max - $min;
			if ( $range < 0 ) return $min; // not so random...
			$log    = log( $range, 2 );
			$bytes  = (int) ( $log / 8 ) + 1; // length in bytes
			$bits   = (int) $log + 1; // length in bits
			$filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
			do {
				$rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
				$rnd = $rnd & $filter; // discard irrelevant bits
			} while ( $rnd >= $range );
			return $min + $rnd;
		};

		$token = "";
		$max   = strlen( $pool );
		for ( $i = 0; $i < $length; $i++ ) {
			$token .= $pool[$crypto_rand_secure( 0, $max )];
		}
		return $token;
	}

	/**
	* Blowfish hashes the password
	* @param string $password The password to hash
	*/
	public static function hashPassword($password)
	{
		$options = array(
			'cost' => Yii::app()->params['BCRYPT_COST'],
		);
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}
}
