<?php
namespace App\Model;
use Nette;
/**
 * Table Vypujcka
 */
class BorrowingManager extends BaseManager
{
	const
		TABLE_NAME = 'vypujcka',
		COLUMN_ID = 'id',
		COLUMN_USER_ID = 'uzivatel_id';

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
	 * edit
	 * @param  $item associative array
	 * @return void
	 */
	public function giveBack($id)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->update(array("vraceno" => 1));
	}
	/**
	 * getUserBorrow
	 * @param $userId
	 * @return all user borrows
	 */
	public function getUserBorrow($userId)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER_ID, $userId);
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
