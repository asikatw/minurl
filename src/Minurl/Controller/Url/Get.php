<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Url;

use Formosa\Utilities\Queue\Priority;
use Minurl\View\Url\UrlHtmlView;
use Windwalker\Controller\AbstractController;

/**
 * The Get class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Get extends AbstractController
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$view = new UrlHtmlView(null, Priority::createQueue(FORMOSA_TEMPLATE . '/minurl'));

		return $view->setLayout('index')->render();
	}
}
 