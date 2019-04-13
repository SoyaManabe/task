<?php
// src/Model/Table/GoalsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class GoalsTable extends Table
{

	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}

	public function validationDefault(Validator $validator)
         {
                 $validator
                         ->allowEmptyString('goal', false)
                         ->minLength('goal', 5);
                 return $validator;
         }
}

