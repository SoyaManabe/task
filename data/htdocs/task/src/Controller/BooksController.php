<?pp
// src/Controller/BooksController.php

namespace App\Controller;

class BooksController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
	}	

	public function index()
	{
		$userId = $this->Auth->user('id');
		$books = $this->Books->find();
		$this->set(compact('books'));
	}

	public function view($id = null)
	{
		$book = $this->Books->get($id);
		$this->set(compact('book'));
	}

	public function add()
	{
		$book = $this->Books->newEntity();
		if ($this->request->is('post')) {
			// Need to change here due to using Amazon API for getting book img.
			$book = $this->Books->patchEntity($book, $this->request->getData());
			if ($this->Books->save($book)) {
				$this->Flash->success(__('Your new book has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to add your book.'));
		}
		$this->set('book', $book);
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

}
