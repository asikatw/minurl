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
use Minurl\Model\UrlModel;
use Minurl\View\Gate\PasswordHtmlView;
use Minurl\View\Gate\PreviewHtmlView;
use Windwalker\Application\AbstractWebApplication;
use Windwalker\Controller\AbstractController;
use Windwalker\Data\Data;

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
	 * Property data.
	 *
	 * @var Data
	 */
	protected $data;

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

		$this->data = $data = $model->getUrl($uid);

		// Back to root
		if ($data->isNull())
		{
			$this->app->redirect($this->app->get('uri.base.path'));
		}

		if ($data->password && $view = $this->renderPassword())
		{
			return $view;
		}

		if ($data->preview && $preview = $this->renderPreview())
		{
			return $preview;
		}

		$this->goTarget($data->url);
	}

	/**
	 * renderPassword
	 *
	 * @return  string
	 */
	protected function renderPassword()
	{
		$pass = $this->input->getString('password');

		if ($pass)
		{
			if (PasswordHelper::verify($pass, $this->data->password))
			{
				return false;
			}
			else
			{
				$this->app->addFlash('Password not matched', 'warning');
			}
		}

		$view = new PasswordHtmlView(null, Priority::createQueue(FORMOSA_TEMPLATE . '/minurl/gate'));

		return $view->setLayout('password')->render();
	}

	/**
	 * renderPreview
	 *
	 * @return  string
	 */
	protected function renderPreview()
	{
		$view = new PreviewHtmlView(array('url' => $this->data), Priority::createQueue(FORMOSA_TEMPLATE . '/minurl/gate'));

		return $view->setLayout('preview')->render();
	}

	/**
	 * goTarget
	 *
	 * @param string $url
	 *
	 * @return  void
	 */
	protected function goTarget($url)
	{
		$this->app->redirect($url);
	}
}
 