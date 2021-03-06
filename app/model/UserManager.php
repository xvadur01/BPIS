<?php

namespace App\Model;

use \Nette,
	\Nette\Utils\Strings,
	\Nette\Security\Passwords;


/**
 * Users management.
 */
class UserManager extends BaseManager implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'user',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'login',
		COLUMN_PASSWORD_HASH = 'pass',
		COLUMN_USER_NAME = 'name',
		COLUMN_USER_SURNAME = 'surname',
		COLUMN_ROLE = 'role';


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
			
		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update(array(
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			));
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], array($row[self::COLUMN_ROLE]), $arr);
	}

	/**
	 * get users by login
	 * @return void
	 */

	public function getByLogin($login)
	{
		return $this->connection->table(self::TABLE_NAME)->where(self::COLUMN_NAME,$login);
	}

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
		return $this->connection->table(self::TABLE_NAME)->get($id);
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

}
