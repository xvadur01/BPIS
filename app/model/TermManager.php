<?php

namespace App\Model;
/**
 * Table Termin
 */
class TermManager extends BaseManager
{
	const
		TABLE_NAME = 'term',
		COLUMN_ID = 'id',
		COLUMN_USER = 'user_id',
		COLUMN_EVENT = 'event_id',
		COLUMN_ALLOW = 'confirm';


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

	public function getTermsOfEvent($idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT,$idEvent);
	}

	/**
	 * get active pages
	 * @return void
	 */
	public function getUsersOfEvent($idEvent)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_EVENT,$idEvent)->group(self::COLUMN_USER);
	}

	/**
	 * get active pages
	 * @return void
	 */
	public function getNewestEvent($idUser)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser)->group(self::COLUMN_EVENT)
				->order(self::COLUMN_EVENT.' DESC')->limit(3);

	}

	public function getUserEvents($idUser)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_USER,$idUser)->group(self::COLUMN_EVENT);


	}

}
