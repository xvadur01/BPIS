<?php

/**
 * Provádí operace nad databázovou tabulkou.
 */
namespace App\Model;
use Nette;
use Nette\Database\Connection;
use Nette\Database\Table\ActiveRow;
abstract class BaseManager extends Nette\Object
{
	/** @var Nette\Database\Connection */
	protected $connection;

	public function __construct(Nette\Database\Context $db)
	{
		$this->connection = $db;
	}
}
