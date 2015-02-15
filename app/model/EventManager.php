<?php
namespace App\Model;
/**
 * Table Udalost
 */
class EventManager extends BaseManager
{
	const
	TABLE_NAME = 'udalost',
	COLUMN_ID = 'id';
		/**
	 * get all data from table
	 * @return void
	 */

	public function get($id)
	{
		return $this->connection->table(self::TABLE_NAME)->get($id);;
	}

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
		return $this->connection->table(self::TABLE_NAME)->insert($item);
	}
	/**
	 * edit
	 * @param  $item associative array
	 * @return void
	 */
	public function edit($item)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $item['id'])->update($item);
	}

	/**
	 * delete
	 * @param  $item associative array
	 * @return void
	 */
	public function delete($id)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->delete();
	}
}
