<?php
namespace Project\Models;
use \Core\Model;

class Page extends Model
{



	public function getById($id)
	{
		// Защита от SQL-инъекций: приводим к int
		$id = (int) $id;
		return $this->findOne("SELECT * FROM page WHERE id = $id");
	}

	public function getByRange($from, $to)
	{
		$from = (int) $from;
		$to = (int) $to;
		return $this->findMany("SELECT * FROM page WHERE id >= $from AND id <= $to");
	}

	public function getAll()
	{
		return $this->findMany("SELECT id, title FROM pages");
	}



	// public function getById($id)
	// {
	// 	return $this->findOne("SELECT * FROM page WHERE id=$id");
	// }

	// public function getAll()
	// {
	// 	return $this->findMany("SELECT id, title FROM page");
	// }
}
