<?php
namespace App\Model;
/**
 * Table Zaznam
 */
class RecordManager extends BaseManager
{
	const
		TABLE_NAME = 'zaznam',
		COLUMN_ID = 'id',
		COLUMN_USER_ID = 'uzivatel_id',
		COLUMN_DATE = 'datum';
		/**
	 * get all data from table
	 * @return void
	 */

	public function getTable()
	{
		return $this->connection->table(self::TABLE_NAME);
	}
	public function get($id)
	{
		return $this->connection->table(self::TABLE_NAME)->get($id);;
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
	/**
	 * getUserRecord
	 * @param $userId
	 * @return all user records
	 */
	public function getUserRecord($userId)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER_ID, $userId);
	}
}
