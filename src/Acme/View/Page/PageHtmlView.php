<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Acme\View\Page;

use Formosa\View\HtmlView;
use Formosa\View\TwigHtmlView;

/**
 * Class PageHtmlView
 *
 * @since 1.0
 */
class PageHtmlView extends HtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data->page = '123123123';
	}
}
 