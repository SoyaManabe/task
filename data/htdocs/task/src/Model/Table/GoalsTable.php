<?php
// src/Model/Table/GoalsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class GoalsTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
}
