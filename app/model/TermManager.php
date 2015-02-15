<?php

namespace App\Model;
/**
 * Table Termin
 */
class TermManager extends BaseManager
{
	const
		TABLE_NAME = 'termin',
		COLUMN_ID = 'id',
		COLUMN_USER = '	uzivatel_id',
		COLUMN_EVENT= 'udalost_id';


	public function get($id)
	{
		return $this->connection->table(self::TABLE_NAME)->get($id);;
	}

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
		return $this->connection->table(self::TABLE_NAME)->insert($item);
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
	 * delete
	 * @param  $item associative array
	 * @return void
	 */
	public function delete($id)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->delete();
	}

	/**
	 * delete
	 * @param  $item associative array
	 * @return void
	 */
	public function deleteByEvent($id)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT, $id)->delete();
	}

	/**
	 * delete
	 * @param  $item associative array
	 * @return void
	 */
	public function deleteUserEvent($idEven, $idUser)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT, $idEven)->where(self::COLUMN_USER, $idUser)->delete();
	}

	/**
	 * get active pages
	 * @return void
	 */
	public function getUserEvent($idUser)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser);
	}
	/**
	 * get active pages
	 * @return void
	 */
	public function getTermOfEvent($idUser, $idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser)->where(self::COLUMN_EVENT,$idEvent);
	}

	/**
	 * get active pages
	 * @return void
	 */
	public function getUsersOfEvent($idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT,$idEvent)->group(self::COLUMN_USER);
	}


}
