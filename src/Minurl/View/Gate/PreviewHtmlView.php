<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\View\Gate;

use Formosa\View\TwigHtmlView;
use Windwalker\Registry\Registry;

/**
 * The PreviewHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PreviewHtmlView extends TwigHtmlView
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
		$data->params = new Registry($data->url->params);

		$data->meta = $data->params['meta'];
	}
}
 