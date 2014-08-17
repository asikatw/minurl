<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Model;

use Formosa\Model\Model;
use Minurl\Helper\Base62Helper;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Date\DateTime;

/**
 * The UrlModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UrlModel extends Model
{
	/**
	 * save
	 *
	 * @param string $data
	 *
	 * @return  boolean
	 */
	public function save($data)
	{
		$mapper = new DataMapper('urls');

		$data = $mapper->createOne($data);

		if ($data->id)
		{
			$data->uid = Base62Helper::encode($data->id);

			$mapper->updateOne($data, 'id');
		}

		return true;
	}

	/**
	 * getMatchedUrl
	 *
	 * @param Data $data
	 *
	 * @return  mixed
	 */
	public function getMatchedUrl(Data $data)
	{
		$mapper = new DataMapper('urls');

		$conds = array(
			'url' => $data->url,
			'expired > ' . $this->db->q((string) new DateTime) . ' OR expired = "0000-00-00 00:00:00"'
		);

		return $mapper->findOne($conds, 'id DESC')->uid;
	}
}
 