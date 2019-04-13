<?php
// src/Controller/BooksController.php

namespace App\Controller;

class BooksController extends AppController
{
	public function index()
	{
		$books = $this->Books->find();
		$this->set(compact('books'));
	}
}
