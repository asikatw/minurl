<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Helper;

/**
 * The Base62Helper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Base62Helper
{
	/**
	 * Property hash.
	 *
	 * @var  array
	 */
	protected static $hash = array(9, 5, 1, 3, 7, 4, 6, 2, 8, 0);

	/**
	 * Property offset.
	 *
	 * @var  int
	 */
	protected static $offset = 12345;

	/**
	 * encode
	 *
	 * @param int $int
	 *
	 * @return  string
	 */
	public static function encode($int)
	{
		// return Base62::convert(static::obfuscate($int), 10, 62);

		return base_convert(static::obfuscate($int), 10, 36);
	}

	/**
	 * encode
	 *
	 * @param int $int
	 *
	 * @return  int
	 */
	public static function decode($int)
	{
		// return static::unObfuscate(Base62::convert($int, 62, 10));

		return static::unObfuscate(base_convert($int, 36, 10));
	}

	/**
	 * obfuscate
	 *
	 * @param string $int
	 *
	 * @return  int
	 */
	public static function obfuscate($int)
	{
		$ints = str_split((string) (int) $int);

		foreach ($ints as &$int)
		{
			$int = static::$hash[$int];
		}

		return (int) implode('', $ints) + static::$offset;
	}

	/**
	 * unObfuscate
	 *
	 * @param string $int
	 *
	 * @return  int
	 */
	public static function unObfuscate($int)
	{
		$int = ((int) $int) - static::$offset;

		$ints = str_split((string) $int);

		foreach ($ints as &$int)
		{
			$int = array_search($int, static::$hash);
		}

		return (int) implode('', $ints);
	}
}
 