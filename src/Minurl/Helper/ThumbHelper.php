<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Helper;

use Windwalker\Uri\Uri;

/**
 * The ThumbHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ThumbHelper
{
	/**
	 * get
	 *
	 * @param string $url
	 *
	 * @return  string
	 */
	public static function get($url)
	{
		$uri = new Uri('http://webthumb.bluga.net/easythumb.php');

		$uri->setVar('user', 12681);
		$uri->setVar('url', urlencode($url));
		$uri->setVar('size', 'large');
		$uri->setVar('cache', 15);

		$hash = gmdate('Ymd') . urldecode($url) . 'ad73670b39bce221a561943e0db1024c';

		$uri->setVar('hash', md5($hash));

		return (string) $uri;
	}
}
 