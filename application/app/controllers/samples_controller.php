<?php
class SamplesController extends AppController {
	var $name = 'Samples';
	var $uses = array('Sample');
	var $components = array('RequestHandler');

	function index() {
		$this->_outputJson(array(
				'key1' => 'value1',
				'list' => $this->Sample->find('all', array(
						'fields' => array('id', 'text1', 'modified'),
						'order' => array('modified DESC')))
		));
	}

	function view($id) {
		$result = $this->Sample->findById($id);
		if ($result) {
			$this->_outputJson($result['Sample']);
		} else {
			$this->_errorNotFound();
		}
	}

	private function _outputJson($output) {
		$this->set('output', $output);
		$this->render('json');
	}

	function add() {
		$this->_save();
	}

	function edit($id) {
		if (!$this->Sample->findById($id)) {
			$this->_errorBadRequest('ID is not exists');
			return;
		}
		$this->Sample->id = $id;
		$this->_save();
	}

	private function _save() {
		$success = $this->Sample->save($this->params['form']);
		if (!$success) {
			$errors = $this->Sample->invalidFields();
			$this->_errorBadRequest($errors['text1']);
			return;
		}
		$this->set('output', 'Saved');
		$this->render('message');
	}

	private function _errorBadRequest($message) {
		$this->header('HTTP/1.1 400 Bad Request');
		$this->set('output', $message);
		$this->render('message');
	}

	private function _errorNotFound() {
		$this->header('HTTP/1.1 404 Not Found');
		$this->render('empty');
	}
}
