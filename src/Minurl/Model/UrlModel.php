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
use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Date\DateTime;
use Windwalker\Registry\Registry;

/**
 * The UrlModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UrlModel extends Model
{
	/**
	 * Property mapper.
	 *
	 * @var  \Windwalker\DataMapper\DataMapper
	 */
	protected $mapper;

	/**
	 * Class init.
	 *
	 * @param Registry       $state
	 * @param DatabaseDriver $db
	 */
	public function __construct(Registry $state = null, DatabaseDriver $db = null)
	{
		parent::__construct($state, $db);

		$this->mapper = new DataMapper('urls');
	}

	/**
	 * save
	 *
	 * @param string $data
	 *
	 * @return  boolean
	 */
	public function save($data)
	{
		$data = $this->mapper->createOne($data);

		if ($data->id)
		{
			$data->uid = Base62Helper::encode($data->id);

			$this->mapper->updateOne($data, 'id');
		}

		return true;
	}

	/**
	 * checkAlias
	 *
	 * @param Data $data
	 *
	 * @return  mixed
	 */
	public function aliasExists(Data $data)
	{
		if (!$data->alias)
		{
			return false;
		}

		return !$this->mapper->findOne(array('alias' => trim($data->alias)))->isNull();
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
		if ($data->password || $data->alias || $data->expired || $data->preview)
		{
			return false;
		}

		$conds = array(
			'url' => $data->url,
			'(expired >= ' . $this->db->q((string) new DateTime) . ' OR expired = "0000-00-00 00:00:00")',
			'alias = NULL'
		);

		return $this->mapper->findOne($conds, 'id DESC')->uid;
	}
}
 