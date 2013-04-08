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
			$this->header('HTTP/1.1 404 Not Found');
			$this->render('empty');
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
			$this->header('HTTP/1.1 400 Bad Request');
			$this->set('output', '存在しないID');
			$this->render('message');
			return;
		}
		$this->Sample->id = $id;
		$this->_save();
	}

	private function _save() {
		if ($this->Sample->save($this->params['form'])) {
			$output = 'Saved';
		} else {
			$this->header('HTTP/1.1 400 Bad Request');
			$errors = $this->Sample->invalidFields();
			$output = $errors['text1'];
		}
		$this->set('output', $output);
		$this->render('message');
	}
}
