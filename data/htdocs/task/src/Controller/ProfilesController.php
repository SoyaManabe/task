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
	
	public function edit($id)
		{
		$profile = $this->Profiles->findById($id)->firstOrFail();
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
