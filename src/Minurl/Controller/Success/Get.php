<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Success;

use Formosa\Utilities\Queue\Priority;
use Formosa\View\TwigHtmlView;
use Windwalker\Controller\AbstractController;
use Windwalker\DataMapper\DataMapper;

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
		$uid = $this->input->get('uid');

		$data = (new DataMapper('urls'))->findOne(array('uid' => $uid));

		$view = new TwigHtmlView(array('url' => $data), Priority::createQueue(FORMOSA_TEMPLATE . '/minurl'));

		return $view->setLayout('success')->render();
	}
}
 