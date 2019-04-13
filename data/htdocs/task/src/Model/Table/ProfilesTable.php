<?php
// src/Model/Table/ProfilesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ProfilesTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
}
