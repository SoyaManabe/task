<?php
// src/Controller/ResultsController.php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ResultsController extends AppController
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
		$this->loadModel('Books');	
		$results = $this->Paginator->paginate($this->Results->find()
					->where(['user_id' => $userId]));
		foreach ($results as $result){
			$result->date = $result->created->format('m/d');
			$result->startTime = $result->created->format('H:i');
			$result->endTime = $result->modified->format('H:i');
			//$result->timeDiff = $this->date_diff($result->created,$result->modified);
			$result->timeDiff = $result->created->diff($result->modified)->format('%H:%I');
			$book = $this->Books->find()
						->where(['id' => $result->book_id])
						->first();
			$bookInfo = $this->getBookInformation($book->isbn);
			$result->bookTitle = $bookInfo['items'][0]['volumeInfo']['title'];
			$result->imageLink = "http://images-jp.amazon.com/images/P/".$book->isbn.".09.THUMBZZZ";
		}		
		$this->set(compact('results'));
		$this->set(compact('userId'));
	}

	public function view($id = null, $userId)
	{
		$book = $this->Books->get($id);
		$this->set(compact('book'));
		$this->set(compact('userId'));
	}

	public function start($bookId, $userId)
	{
		$result = $this->Results->newEntity();
		if ($this->request->is('post')) {
			$result = $this->Results->patchEntity($result, $this->request->getData());
			$result->book_id = $bookId;
			$result->user_id = $userId;
			if ($this->Results->save($result)) {
				$this->Flash->success(__('Your study started.'));
				return $this->redirect(['controller' => 'mypages', 'action' => 'index']);
			}
			$this->Flash->error(__('Unable to start.'));
			return $this->redirect(['controller' => 'books', 'action' => 'index']);
		}
	}

	public function finish($id = null)
	{
                $result = $this->Results->findById($id)->firstOrFail();
                if ($this->request->is(['post', 'put'])) {
                        $this->Results->patchEntity($result, $this->request->getData());
                        if ($this->Results->save($result)) {
                                $this->Flash->success(__('Your study has been finished.'));
                                return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('Unable to update your result.'));
                }
                $this->set('result', $result);
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

	public function time_diff($time_from, $time_to){
		$dif = $time_to - $time_from;
		$dif_time = date("H:i");
		return $dif_time;
	}

	public function getBookInformation($isbn){
		$url = "https://www.googleapis.com/books/v1/volumes?q=".$isbn;
		$json = file_get_contents($url);
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		$arr = json_decode($json,true);
		return $arr;
	}
}
