<?php
namespace App\Model;
/**
 * Table NastaveniSystemu
 */
class ConfigManager extends BaseManager
{
	const
		TABLE_NAME = 'nastaveni_systemu',
		COLUMN_ID = 'id';

		/**
	 * get all data from table
	 * @return void
	 */

	public function getTable()
	{
		return $this->connection->table(self::TABLE_NAME)->fetch();
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
