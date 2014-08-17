<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Helper;

use Windwalker\Crypt\Password;

/**
 * The PasswordHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PasswordHelper
{
	/**
	 * getPasswordObject
	 *
	 * @return  Password
	 */
	public static function getPasswordObject()
	{
		return new Password;
	}

	/**
	 * create
	 *
	 * @param string $pass
	 *
	 * @return  string
	 */
	public static function create($pass)
	{
		return static::getPasswordObject()->create($pass);
	}

	/**
	 * verify
	 *
	 * @param string $pass
	 * @param string $hash
	 *
	 * @return  bool
	 */
	public static function verify($pass, $hash)
	{
		return static::getPasswordObject()->verify($pass, $hash);
	}
}
 