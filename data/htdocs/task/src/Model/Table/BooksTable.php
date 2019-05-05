<?php
// src/Model/Table/BooksTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
class BooksTable extends Table
{
	public function initialize(array $config)
	{
		//$this->addBehavior('Timestamp');
	}
	public function validationDefault(Validator $validator)
         {
                 $validator
                         ->allowEmptyString('book', false)
                         ->minLength('isbn',13);
                 return $validator;
         }

}
