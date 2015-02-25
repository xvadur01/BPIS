<?php
namespace App\Model;
/**
 * Table Udalost
 */
class EventManager extends BaseManager
{
	const
	TABLE_NAME = 'udalost',
	COLUMN_ID = 'id',
	COLUMN_DATE = 'datum';

		/**
	 * get all data from table
	 * @return void
	 */

	public function get($id)
	{
		return $this->connection->table(self::TABLE_NAME)->get($id);
	}

	public function getTable()
	{
		return $this->connection->table(self::TABLE_NAME);
	}

	public function gets($ids)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $ids);
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

	/**
	 * edit
	 * @param  $item associative array
	 * @return void
	 */
	public function getNewestUserEvent($userId)
	{
		return $this->connection->query('SELECT E.*,T.cas,T.vyhovuje FROM udalost AS E'
				. ' JOIN termin AS T ON E.id = T.udalost_id'
				. ' WHERE T.uzivatel_id = ? GROUP BY E.id  ORDER BY E.id DESC LIMIT 3',$userId);
	}

	public function getFutureEvents()
	{
		return $this->connection->table(self::TABLE_NAME)->where('datum > NOW() OR datum IS NULL');

	}
	public function getClosestUserEvent($userId)
	{
		return $this->connection->query('SELECT E.*,T.cas,T.vyhovuje FROM udalost AS E'
				. ' JOIN termin AS T ON E.id = T.udalost_id'
				. ' WHERE T.uzivatel_id = ? AND E.datum > NOW() GROUP BY E.id ORDER BY E.datum DESC LIMIT 3',$userId);

	}

}
