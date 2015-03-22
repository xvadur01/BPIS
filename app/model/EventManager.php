<?php
namespace App\Model;
/**
 * Table Udalost
 */
class EventManager extends BaseManager
{
	const
	TABLE_NAME = 'event',
	COLUMN_ID = 'id',
	COLUMN_DATE = 'date',
	COLUMN_COUNT_ALERT = 'number_alert';

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
	public function getNewestUserEvent($userId,$limit = 3)
	{
		return $this->connection->query('SELECT E.*,T.time,T.confirm,U.name as uname,U.surname FROM event AS E'
				. ' JOIN term AS T ON E.id = T.event_id'
				. ' JOIN user AS U ON E.user_id = U.id'
				. ' WHERE T.user_id = ? GROUP BY E.id  ORDER BY E.id DESC LIMIT ?',$userId,$limit);
	}

	public function getFutureEvents()
	{
		return $this->connection->table(self::TABLE_NAME)->where('date > NOW() OR date IS NULL');

	}
	public function getEventsInSevenDays()
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_COUNT_ALERT,2)
								->where(self::COLUMN_DATE . ' IS NOT NULL')
								->where(self::COLUMN_DATE . ' > NOW() + INTERVAL 1 DAY')
								->where(self::COLUMN_DATE . ' < NOW() + INTERVAL 7 DAY');
	}
	public function getEventsInOneDays()
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_COUNT_ALERT .'> 0')
								->where(self::COLUMN_DATE . ' IS NOT NULL')
								->where(self::COLUMN_DATE . ' < NOW() + INTERVAL 1 DAY');
	}
	public function getClosestUserEvent($userId)
	{
		return $this->connection->query('SELECT E.*,T.time,T.confirm,U.name as uname,U.surname FROM event AS E'
				. ' JOIN term AS T ON E.id = T.event_id'
				. ' JOIN user AS U ON E.user_id = U.id'
				. ' WHERE T.user_id = ? AND E.date > NOW() GROUP BY E.id ORDER BY E.date DESC LIMIT 3',$userId);

	}

}
