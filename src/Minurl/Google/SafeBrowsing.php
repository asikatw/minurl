<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Google;

use Joomla\Http\HttpFactory;
use Windwalker\Uri\Uri;

/**
 * The SafeBrowsing class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SafeBrowsing
{
	/**
	 * checkSafe
	 *
	 * @param string $url
	 *
	 * @return  bool
	 */
	public static function checkSafe($url)
	{
		$uri = new Uri('https://sb-ssl.google.com/safebrowsing/api/lookup');

		$queries = array(
			'client' => 'api',
			'key' => 'AIzaSyC04nF4KXjfR2VQ0jsFm5vEd9LbyiXqbKw',
			'appver' => '1.5.2',
			'pver' => '3.1',
			'url' => urlencode($url)
		);

		$uri->setQuery($queries);

		$http = HttpFactory::getHttp();

		$response = $http->get($uri);

		if (trim($response->body) == 'malware')
		{
			return false;
		}

		return true;
	}
}
 