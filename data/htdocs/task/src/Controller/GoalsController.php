<?php
// src/Controller/GoalsController.php

namespace App\Controller;

use App\Controller\AppController;

class GoalsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash');
	}
	
	public function index($userId)
	{
		if (empty($userId)){
			$userId = $this->Auth->user('id');
		}
		$goals = $this->Paginator->paginate($this->Goals->find()->where(['user_id' => $userId]));
		$this->set(compact('goals'));
		$this->set(compact('userId'));
	}

	public function add($userId)
	{
		$goal = $this->Goals->newEntity();
		if ($this->request->is('post')) {
			$goal = $this->Goals->patchEntity($goal, $this->request->getData());
			$goal->user_id = $userId;
			if ($this->Goals->save($goal)){
				$this->Flash->success(__('Your new goal has been saved.'));
				return $this->redirect(['action' => 'index', $userId]);
			}
			$this->Flash->error(__('Unable to add your new goal.'));
		}
		$this->set('userId', $userId);
		$this->set('goal', $goal);
	}

	public function edit($id, $userId)
	{
		$goal = $this->Goals->findById($id)->firstOrFail();
		if ($this->request->is(['post', 'put'])) {
			$this->Goals->patchEntity($goal, $this->request->getData());
			if ($this->Goals->save($goal)) {
				$this->Flash->success(__('Your goal has been updated.'));
				return $this->redirect(['action' => 'index', $userId]);
			}
			$this->Flash->error(__('Unable to update your goal.'));
		}
		$this->set('goal', $goal);
	}

	public function delete($id, $userId)
	{
		$this->request->allowMethod(['post', 'delete']);

		$goal = $this->Goals->findById($id)->firstOrFail();
		if ($this->Goals->delete($goal)) {
			$this->Flash->success(__('{0} has been deleted.', $goal->goal));
			return $this->redirect(['action' => 'index', $userId]);
		}
	}
}
