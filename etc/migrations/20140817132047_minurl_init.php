<?php

use Phinx\Migration\AbstractMigration;

class MinurlInit extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    	$this->table('urls')
			->addColumn('uid', 'string')
			->addColumn('url', 'string')
			->addColumn('alias', 'string')
			->addColumn('password', 'string')
			->addColumn('safe_entry', 'string')
			->addColumn('preview', 'boolean')
			->addColumn('created', 'datetime')
			->addColumn('expired', 'datetime')
			->addColumn('state', 'integer')
			->addColumn('safe', 'boolean')
			->addColumn('safe_checked', 'datetime')
			->addColumn('params', 'text')
			->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
		$this->dropTable('urls');
    }
}