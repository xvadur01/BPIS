<?php
namespace App\Model;
/**
 * Table NastaveniSystemu
 */
class ConfigManager extends BaseManager
{
	const
		TABLE_NAME = 'config',
		COLUMN_ID = 'id';

		/**
	 * get all data from table
	 * @return void
	 */

	public function getTable()
	{
		return $this->connection->table(self::TABLE_NAME);
	}

	/**
	 * Add
	 * @param $record associative array
	 * @return void
	 */
	public function add($item)
	{
		$this->connection->table(self::TABLE_NAME)->insert($item);
	}
	/**
	 * edit
	 * @param  $item associative array
	 * @return void
	 */
	public function edit($item)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $item['id'])->update($item);
	}
}
