<?php
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
		//$url = $this->amazon();
		//$this->set(compact('url'));
		$this->set(compact('userId'));
	}

	public function view($id = null, $userId)
	{
		$book = $this->Books->get($id);
		$this->set(compact('book'));
		$this->set(compact('userId'));
	}

	public function add($userId)
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
		$this->set('userId', $userId);
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

	public function amazon()
	{
		define("ACCESS_KEY_ID"     , 'AKIAIEZDEG7DCVJYRL2A');
		define("SECRET_ACCESS_KEY" , 'uPOVK873l5nFKPWgAouwLEB2bubDrPN9TnTlAcgj');
		define("ASSOCIATE_TAG"     , 'rikean-22');
		define("ACCESS_URL"        , 'http://ecs.amazonaws.jp/onca/xml');

		$base_param = 'AWSAccessKeyId='.ACCESS_KEY_ID;

		$params = array();
		$params['Service']       = 'AWSECommerceService';
		$params['Operation']     = 'ItemSearch';
		$params['SearchIndex']   = "Books";
		$params['Version']        = '2011-08-02';
		$params['Title']         = 'レーダブルコード';
		$params['AssociateTag']  = ASSOCIATE_TAG;
		$params['ResponseGroup'] = 'ItemAttributes,Images';
		$params['Timestamp']     = gmdate('Y-m-d\TH:i:s\Z');

		ksort($params);
/*
		$canonical_string = $base_param;
		foreach ($params as $k => $v) {
    		    $canonical_string .= '&'.$this->urlencode_RFC3986($k).'='.$this->urlencode_RFC3986($v);
		}

		$parsed_url = parse_url(ACCESS_URL);
		$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";

		$signature = base64_encode(
    	    	        hash_hmac('sha256', $string_to_sign, SECRET_ACCESS_KEY, true)
    		    );

		$url = ACCESS_URL.'?'.$canonical_string.'&Signature='.$this->urlencode_RFC3986($signature);

		return $url;
	}
	
	public function urlencode_RFC3986($str)
	{
		return str_replace('%7E', '~', rawurlencode($str));
	}
*/
		$parameter = '';
		foreach ($params as $key => $value) {
			$parameter .= $key . '=' . rawurlencode($value) . '&';
		}
		$parameter = rtrim($parameter, '&');
		$signature = "GET\necs.amazonaws.jp\n/onca/xml\n" . $base_param . '&' . $parameter;
		$signature = hash_hmac('sha256', $signature, SECRET_ACCESS_KEY, true);
		$signature = rawurlencode(base64_encode($signature));

		$request_url = 'http://ecs.amazonaws.jp/onca/xml?'.$base_param . '&' . $parameter. '&Signature=' . $signature;
		$xml = simplexml_load_file($request_url);
		return $request_url;
	}
}
