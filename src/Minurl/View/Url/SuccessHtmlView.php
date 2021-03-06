<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\View\Url;

use Formosa\View\TwigHtmlView;

/**
 * The UrlHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SuccessHtmlView extends TwigHtmlView
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
		$data->path = $data->url->alias ? : $data->url->uid;
	}
}
