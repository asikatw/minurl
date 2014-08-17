<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload))
{
	exit('Please run <code>$ composer install</code> First.');
}

define('FORMOSA_ROOT', realpath(__DIR__ . '/..'));

include_once __DIR__ . '/../vendor/asika/formosa-core/src/init.php';

include_once $autoload;

(new \Formosa\Application\Application)->execute();
