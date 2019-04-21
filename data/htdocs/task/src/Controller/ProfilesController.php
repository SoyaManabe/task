<?php
// src/Controller/ProfilesController.php

namespace App\Controller;

use App\Controller\AppController;

class ProfilesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash');
	}

	public function add()
	{
		$profile = $this->Profiles->newEntity();
		$userId = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$profile = $this->Profiles->patchEntity($profile, $this->request->getData());
			if ($this->Profiles->save($profile)) {
				$this->Flash->success(__('Your new profile has been saved.'));
				return $this->redirect(['controller' => 'mypages', 'action' => 'index']);
			}
			$this->Flash->error(__('Unable to add your profile.'));
		}
		$this->set('userId', $userId);
		$this->set('profile', $profile);
	}
	
	public function edit($userId)
		{
		$profile = $this->Profiles->find()
			->where(['user_id' => $userId])
			->firstOrFail();
		if ($this->request->is(['post', 'put'])) {
			$this->Profiles->patchEntity($profile, $this->request->getData());
			if ($this->Profiles->save($profile)) {
				$this->Flash->success(__('Your profile has been updated.'));
				return $this->redirect(['controller' => 'mypages', 'action' => 'index']);
			}
			$this->Flash->error(__('Unable to update your profile.'));
		}
		$this->set('profile', $profile);
	}
}
