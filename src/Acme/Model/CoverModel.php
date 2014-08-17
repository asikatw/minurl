<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Acme\Model;

use Formosa\Model\Model;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * Class CoverModel
 *
 * @since 1.0
 */
class CoverModel extends Model
{
	/**
	 * getContent
	 *
	 * @throws  \Exception
	 * @return  \Windwalker\Data\Data
	 */
	public function getContent()
	{
		try
		{
			return (new DataMapper('acme_cover'))->findOne(array('id' => 1));
		}
		catch (\Exception $e)
		{
			return new Data;
		}
	}
}
 