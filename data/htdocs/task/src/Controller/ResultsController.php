<?php
// src/Controller/ResultsController.php

namespace App\Controller;

class ResultsController extends AppController
{
	public function index()
	{
		$results = $this->Results->find();
		$this->set(compact('results'));
	}
}
