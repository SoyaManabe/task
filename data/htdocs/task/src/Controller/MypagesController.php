<?php
// src/Controller/MypagesController.php


namespace App\Controller;


class MypagesController extends AppController
{
	public function index()
	{
		if($this->Auth->user()) {
			$userId = $this->Auth->user('id');
			$this->loadModel('Goals');
			$this->loadModel('Profiles');
			$this->loadModel('Results');
			$this->loadModel('Books');
			$goals = $this->Goals->find()
						->where(['user_id' => $userId]);
			$profile = $this->Profiles->find()
						->where(['user_id' => $userId])
						->first();
			$fields['conditions'][]='created=modified';
			$unfinishedStudy = $this->Results->find('all', $fields)
						->where(['user_id' => $userId])
						->first();
			if (isset($unfinishedStudy)) {
				$unfinishedBook = $this->Books->find()
							->where(['id' => $unfinishedStudy->book_id])
							->first();
				$this->set(compact('unfinishedBook'));
			}
			$this->set(compact('profile'));
			$this->set(compact('goals'));
			$this->set('userId', $userId);
			$this->set(compact('unfinishedStudy'));
		}else{
			throw new NotFoundException(__('User not found'));
		}
	}	
}
