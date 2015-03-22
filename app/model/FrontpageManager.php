<?php
namespace App\Model;
/**
 * Table NastaveniSystemu
 */
class FrontpageManager extends BaseManager
{
	const
		TABLE_NAME = 'front_page',
		COLUMN_ID = 'id',
		COLUMN_ACTIVE = 'active',
		COLUMN_WEIGHT = 'weight',
		COLUMN_URL = 'url';


	/**
	 * get active pages
	 * @return void
	 */

	public function getByUrl($url)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_URL,$url)->limit(1);
	}

	/**
	 * get active pages
	 * @return void
	 */

	public function getFirstAtiveFronPage()
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ACTIVE)->limit(1);
	}

	/**
	 * get active pages
	 * @return void
	 */

	public function getAtiveFronPage()
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ACTIVE)->order(self::COLUMN_WEIGHT . " DESC");
	}
		/**
	 * get all data from table
	 * @return void
	 */

	public function getTable()
	{
		return $this->connection->table(self::TABLE_NAME)->order(self::COLUMN_WEIGHT . " DESC");
	}

	public function get($id)
	{
		return $this->connection->table(self::TABLE_NAME)->get($id);
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
	 * delete
	 * @param  $item associative array
	 * @return void
	 */
	public function delete($id)
	{
		$this->connection->table(self::TABLE_NAME)->where(self::COLUMN_ID, $id)->delete();
	}
}