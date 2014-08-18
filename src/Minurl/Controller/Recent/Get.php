<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Recent;

use Formosa\Application\WebApplication;
use Formosa\Utilities\Queue\Priority;
use Formosa\View\TwigHtmlView;
use Minurl\Helper\PasswordHelper;
use Minurl\Model\GateModel;
use Minurl\View\Gate\PasswordHtmlView;
use Minurl\View\Gate\PreviewHtmlView;
use Minurl\View\Recent\RecentHtmlView;
use Windwalker\Controller\AbstractController;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * The Get class.
 *
 * @property WebApplication app
 *
 * @since  {DEPLOY_VERSION}
 */
class Get extends AbstractController
{
	/**
	 * Property data.
	 *
	 * @var Data
	 */
	protected $data;

	/**
	 * Property model.
	 *
	 * @var GateModel
	 */
	protected $model;

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
		$urls = (new DataMapper('urls'))->findAll('id DESC', 0, 100);

		$view = new RecentHtmlView(array('urls' => $urls), Priority::createQueue(FORMOSA_TEMPLATE . '/minurl'));

		return $view->setLayout('recent')->render();
	}
}
 