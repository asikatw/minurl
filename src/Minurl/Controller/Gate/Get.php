<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Gate;

use Formosa\Utilities\Queue\Priority;
use Minurl\Helper\PasswordHelper;
use Minurl\Model\GateModel;
use Minurl\View\Gate\PasswordHtmlView;
use Windwalker\Application\AbstractWebApplication;
use Windwalker\Controller\AbstractController;

/**
 * The Get class.
 *
 * @property AbstractWebApplication $app
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

		$model = new GateModel;

		$data = $model->getUrl($uid);

		// Back to root
		if ($data->isNull())
		{
			$this->app->redirect($this->app->get('uri.base.path'));
		}

		if ($data->password)
		{
			$pass = $this->input->getString('password');

			if ($pass)
			{
				if (PasswordHelper::verify($pass, $data->password))
				{
					$this->goTarget($data->url);
				}
				else
				{
					$this->app->addFlash('Password not matched', 'warning');
				}
			}

			$view = new PasswordHtmlView(null, Priority::createQueue(FORMOSA_TEMPLATE . '/minurl/gate'));

			return $view->setLayout('password')->render();
		}

		if ($data->preview)
		{

		}

		$this->goTarget($data->url);
	}

	protected function goTarget($url)
	{
		$this->app->redirect($url);
	}
}
 