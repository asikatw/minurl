<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\View\Recent;

use Formosa\Factory;
use Formosa\View\TwigHtmlView;
use Minurl\Helper\HtmlHelper;
use Windwalker\Registry\Registry;
use Windwalker\Utilities\String\String;

/**
 * The RecentHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RecentHtmlView extends TwigHtmlView
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
		$app = Factory::getApplication();

		foreach ($data->urls as $url)
		{
			$url->shortUrl = $app->get('uri.base.full') . ($url->alias ? : $url->uid);
			$url->params = new Registry($url->params);

			$url->title = String::substr($url->params['meta.title'], 0, 40);
			$url->title = HtmlHelper::escape($url->title);

			$url->desc = String::substr($url->params['meta.desc'], 0, 50);
			$url->desc = HtmlHelper::escape($url->desc);
		}
	}
}
 