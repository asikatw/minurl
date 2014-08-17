<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Url;

use Minurl\Helper\PasswordHelper;
use Minurl\Model\UrlModel;
use Windwalker\Controller\AbstractController;
use Windwalker\Data\Data;

/**
 * The Get class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Create extends AbstractController
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
		$data = $this->input->getVar('entry', array());

		$data = new Data($data);

		$model = new UrlModel;

		try
		{
			if (!$data->url)
			{
				throw new \RuntimeException('No URL');
			}

			if ($model->aliasExists($data))
			{
				throw new \RuntimeException('This custom URL has been used.');
			}

			if ($uid = $model->getMatchedUrl($data))
			{
				$this->toResult($uid);
			}

			if ($data->password)
			{
				$data->password = PasswordHelper::create($data->password);
			}

			$model->save($data);
		}
		catch (\Exception $e)
		{
			if (FORMOSA_DEBUG)
			{
				throw $e;
			}

			$this->app->addFlash($e->getMessage(), 'warning');

			$this->app->redirect($this->app->get('uri.base.path'));
		}

		$this->toResult($data->uid);
	}

	/**
	 * toResult
	 *
	 * @param string $uid
	 *
	 * @return  void
	 */
	protected function toResult($uid)
	{
		$this->app->redirect($this->app->get('uri.base.path') . 'success/' . $uid);
	}
}
 