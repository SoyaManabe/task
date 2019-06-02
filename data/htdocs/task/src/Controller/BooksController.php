<?php
// src/Controller/BooksController.php

namespace App\Controller;

class BooksController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('Paginator');
	}	

	public function index()
	{
		$userId = $this->Auth->user('id');
		$books = $this->Paginator->paginate($this->Books->find()->where(['user_id' => $userId]));
		$this->set(compact('books'));
		$this->set(compact('userId'));
	}

	public function view($id = null)
	{
		$userId = $this->Auth->user('id');
		$isStudyContinuing = false;
		$this->loadModel('Results');
		$fields['conditions'][]='created=modified';
		$unfinishedStudy = $this->Results->find('all', $fields)
							->where(['user_id' => $userId])
							->first();
		$book = $this->Books->get($id);
		$this->set(compact('book'));
		$this->set(compact('userId'));
		$this->set(compact('unfinishedStudy'));
	}

	public function search()
	{
		$userId = $this->Auth->user('id');
	    $book = $this->Books->newEntity();	
        if ($this->request->is('post')){
			$book = $this->Books->patchEntity($book, $this->request->getData());
			$searchResults = $this->getBookInformation($book->bookTitle);
			$cnt = count($searchResults['items']);
			foreach($searchResults['items'] as $searchResult){
				$isbn = $searchResult['volumeInfo']['industryIdentifiers']['0']['identifier'];
				$searchResult['volumeInfo']['imageLink'] = "http://images-jp.amazon.com/images/P/".$isbn.".09.THUMBZZZ";	
			}
			$this->set(compact('searchResults'));
		}
		$this->set('userId', $userId);
		$this->set('book', $book);
	}

	public function add($isbn,$userId)
	{
		$book = $this->Books->newEntity();
		if ($this->request->is('post')) {
			$book = $this->Books->patchEntity($book, $this->request->getData());
			$searchResults = $this->getBookInformation($isbn);
			$addingBook = $searchResults['items']['0']['volumeInfo'];
			$book->user_id = $userId;
			$book->isbn = $addingBook['industryIdentifiers']['0']['identifier'];
			$book->bookTitle = @$addingBook['title'];
			$book->author = @$addingBook['authors']['0'];
			$book->description = @$addingBook['description'];
			$book->imageLink = "http://images-jp.amazon.com/images/P/".$book->isbn.".09.";
			$book->subtitle = @$addingBook['subtitle'];
			if ($this->Books->save($book)) {
				$this->Flash->success(__('Your new book has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to add your book.'));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function edit($id = null)
	{
	}

	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);
		$book = $this->Books->get($id);
		if ($this->Books->delete($book)) {
			$this->Flash->success(__('The book has been deleted from your library.'));
			return $this->redirect(['action' => 'index']);
		}
	}

    public function getBookInformation($bookTitle){
    	$url = "https://www.googleapis.com/books/v1/volumes?q=".$bookTitle;
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $arr = json_decode($json,true);
        return $arr;
    }


}
