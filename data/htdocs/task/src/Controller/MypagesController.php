<?php
// src/Controller/MypagesController.php


namespace App\Controller;


class MypagesController extends AppController
{
	public function index()
	{
		$this->loadModel('Goals');;
		$this->loadModel('Profiles');
		$goals = $this->Goals->find('all');
		$profiles = $this->Profiles->find('all');
		$this->set(compact('profiles'));
		$this->set(compact('goals'));
	}	
}
