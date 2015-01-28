<?php

namespace App\Model;
/**
 * Table Termin
 */
class TermManager extends BaseManager
{
	const
		TABLE_NAME = 'udalost',
		COLUMN_ID = 'id',
		COLUMN_USER = 'id_uzivatel';
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
	/**
	 * get active pages
	 * @return void
	 */
	public function getUserEvent($idUser)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser);
	}
}
