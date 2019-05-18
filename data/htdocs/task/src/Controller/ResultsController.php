<?php
// src/Controller/ResultsController.php

namespace App\Controller;

class ResultsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
	}	

	public function index()
	{
		$userId = $this->Auth->user('id');
		$results = $this->Results->find();
		$this->set(compact('results'));
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
