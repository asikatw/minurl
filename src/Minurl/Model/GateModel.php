<?php
/**
 * Part of minurl project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Minurl\Model;

use Formosa\Model\Model;
use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Registry\Registry;

/**
 * The GateModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GateModel extends Model
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
	 * getUrl
	 *
	 * @param string $pk
	 *
	 * @return  mixed
	 */
	public function getUrl($pk)
	{
		$query = $this->db->getQuery(true);

		return $this->mapper->findOne(array($query->format('uid = %q OR alias = %q', $pk, $pk)));
	}
}
 