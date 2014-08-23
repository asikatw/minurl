<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Model;

use Formosa\Model\Model;
use Joomla\Http\HttpFactory;
use Minurl\Helper\Base62Helper;
use PHPHtmlParser\Dom;
use Windwalker\Data\Data;
use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Date\DateTime;
use Windwalker\Registry\Registry;
use Windwalker\Utilities\String\String;

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
		// Get meta
		$meta = $this->getMeta($data->url);

		$data->params = new Registry;

		$data->params['meta'] = $meta;

		$data->params = (string) $data->params;

		// Do store
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

	/**
	 * getMeta
	 *
	 * @param string $url
	 *
	 * @return  array
	 */
	public function getMeta($url)
	{
		$meta = array();

		$http = HttpFactory::getHttp(null, 'Curl');

		$page = $http->get($url)->body;

		$dom = new Dom;

		$dom->load($page);

		$title = $dom->find('title');

		if (!empty($title[0]))
		{
			$meta['title'] = $title[0]->text;
		}

		$desc = $dom->find('meta[property=og:description]');

		if (empty($desc[0]))
		{
			$desc = $dom->find('meta[name=description]');
		}

		if (!empty($desc[0]))
		{
			$meta['desc'] = $desc[0]->getAttribute('content');

			String::substr($meta['desc'], 0, 150);
		}

		return $meta;
	}
}
 