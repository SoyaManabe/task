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
			$goals = $this->Goals->find()
						->where(['user_id' => $userId]);
			$profile = $this->Profiles->find()
						->where(['user_id' => $userId])
						->first();
			$this->set(compact('profile'));
			$this->set(compact('goals'));
			$this->set('userId', $userId);
		}else{
			throw new NotFoundException(__('User not found'));
		}
	}	
}
