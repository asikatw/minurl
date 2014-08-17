<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Controller\Url;

use Joomla\Uri\Uri;
use Minurl\Helper\PasswordHelper;
use Minurl\Model\UrlModel;
use Windwalker\Controller\AbstractController;
use Windwalker\Data\Data;
use Windwalker\IO\Input;

/**
 * The Get class.
 *
 * @property Input input
 * 
 * @since  {DEPLOY_VERSION}
 */
class Create extends AbstractController
{
	/**
	 * Execute the controller.
	 *
	 * @throws \Exception
	 * @return  mixed Return executed result.
	 */
	public function execute()
	{
		$data = $this->input->getVar('entry', array());

		$data = new Data($data);

		$model = new UrlModel;

		try
		{
			if (!trim($data->url))
			{
				throw new \RuntimeException('No URL');
			}

			// Normalise
			$data->url = $this->normalise($data->url);

			// Check Alias
			if ($model->aliasExists($data))
			{
				throw new \RuntimeException('This custom URL has been used.');
			}

			// Find exists URL
			if ($uid = $model->getMatchedUrl($data))
			{
				$this->toResult($uid);
			}

			// Encode password
			if ($data->password)
			{
				$data->password = PasswordHelper::create($data->password);
			}

			// Do save
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

	/**
	 * normalise
	 *
	 * @param string $url
	 *
	 * @throws \RuntimeException
	 * @return  string
	 */
	protected function normalise($url)
	{
		$uri = new Uri($url);

		if (!$uri->getScheme())
		{
			$uri->setScheme('http');
		}

		if (!$uri->getHost())
		{
			throw new \RuntimeException('Not a valid URL');
		}

		return (string) $uri;
	}
}
 