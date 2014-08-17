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
	 * encode
	 *
	 * @param int $int
	 *
	 * @return  string
	 */
	public static function encode($int)
	{
		return Base62::convert($int, 10, 62);
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
		return Base62::convert($int, 62, 10);
	}
}
 