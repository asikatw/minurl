<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Helper;

/**
 * The HtmlHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class HtmlHelper
{
	public static function escape($text)
	{
		// Escape the output.
		htmlspecialchars($text, ENT_COMPAT, 'UTF-8');

		return str_replace('&amp;', '&', $text);
	}
}
 